$(function(){

let character = document.querySelector(".character");
let username = document.querySelector(".username");
let map = document.querySelector(".map");

//start in the left corner of the map
let x = 5;
let y = 10;
let held_directions = []; //State of which arrow keys we are holding down
let speed = 1; //How fast the character moves in pixels per frame


//Serverconnection


const placeCharacter = () => {
   //To prevent the page from scrolling by pressing the arrowkeys
   window.addEventListener("keydown", function(e) {
      if(["Space","ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(e.code) > -1) {
          e.preventDefault();
      }
   }, false);

   var pixelSize = parseInt(
      getComputedStyle(document.documentElement).getPropertyValue('--pixel-size')
   );
   
   const held_direction = held_directions[0];
   if (held_direction) {
      if (held_direction === directions.right) {x += speed;}
      if (held_direction === directions.left) {x -= speed;}
      if (held_direction === directions.down) {y += speed;}
      if (held_direction === directions.up) {y -= speed;}
      character.setAttribute("facing", held_direction);
      charPosition = $('.character').position();
      console.log(charPosition)

   }
   character.setAttribute("walking", held_direction ? "true" : "false");


   //Wall limits (wallillusion)
   var leftLimit = 0;
   var rightLimit = (16 * 11)+8;
   var topLimit = -8 + 10;
   var bottomLimit = (16 * 7);
   if (x < leftLimit) { x = leftLimit; }
   if (x > rightLimit) { x = rightLimit; }
   if (y < topLimit) { y = topLimit; }
   if (y > bottomLimit) { y = bottomLimit; }
   
   
   var camera_left = pixelSize * 80;
   var camera_top = pixelSize * 60;
   

   character.style.transform = `translate3d( ${x*pixelSize}px, ${y*pixelSize}px, 0 )`;
}


//---------- CHARACTER POSITION ----------
let charPosition

const gameState = {
   player: {
      pos: {
         x: x,
         y: y
      }
   }
}



//---------- GAME CONTROL ----------
/* Direction of "character" */
const directions = {
   up: "up",
   down: "down",
   left: "left",
   right: "right",
}
const keys = {
   // Arrow Keys
   38: directions.up,
   37: directions.left,
   39: directions.right,
   40: directions.down,

   // WASD Keys
   // 87: directions.up,
   // 65: directions.left,
   // 68: directions.right,
   // 83: directions.down,
}
document.addEventListener("keydown", (e) => {
   var dir = keys[e.which];
   if (dir && held_directions.indexOf(dir) === -1) {
      held_directions.unshift(dir)
   }
})

document.addEventListener("keyup", (e) => {
   var dir = keys[e.which];
   var index = held_directions.indexOf(dir);
   if (index > -1) {
      held_directions.splice(index, 1)
   }
});



/* Dpad functionality for mouse and touch */
var isPressed = false;
const removePressedAll = () => {
   document.querySelectorAll(".dpad-button").forEach(d => {
      d.classList.remove("pressed")
   })
}
document.body.addEventListener("mousedown", () => {
   console.log('mouse is down')
   isPressed = true;
})
document.body.addEventListener("mouseup", () => {
   console.log('mouse is up')
   isPressed = false;
   held_directions = [];
   removePressedAll();
})
const handleDpadPress = (direction, click) => {   
   if (click) {
      isPressed = true;
   }
   held_directions = (isPressed) ? [direction] : []
   
   if (isPressed) {
      removePressedAll();
      document.querySelector(".dpad-"+direction).classList.add("pressed");
   }
}
//Bind a ton of events for the dpad
document.querySelector(".dpad-left").addEventListener("touchstart", (e) => handleDpadPress(directions.left, true));
document.querySelector(".dpad-up").addEventListener("touchstart", (e) => handleDpadPress(directions.up, true));
document.querySelector(".dpad-right").addEventListener("touchstart", (e) => handleDpadPress(directions.right, true));
document.querySelector(".dpad-down").addEventListener("touchstart", (e) => handleDpadPress(directions.down, true));

document.querySelector(".dpad-left").addEventListener("mousedown", (e) => handleDpadPress(directions.left, true));
document.querySelector(".dpad-up").addEventListener("mousedown", (e) => handleDpadPress(directions.up, true));
document.querySelector(".dpad-right").addEventListener("mousedown", (e) => handleDpadPress(directions.right, true));
document.querySelector(".dpad-down").addEventListener("mousedown", (e) => handleDpadPress(directions.down, true));

document.querySelector(".dpad-left").addEventListener("mouseover", (e) => handleDpadPress(directions.left));
document.querySelector(".dpad-up").addEventListener("mouseover", (e) => handleDpadPress(directions.up));
document.querySelector(".dpad-right").addEventListener("mouseover", (e) => handleDpadPress(directions.right));
document.querySelector(".dpad-down").addEventListener("mouseover", (e) => handleDpadPress(directions.down));

//Set up the game loop
const step = () => {
   placeCharacter();
   window.requestAnimationFrame(() => {
      step();
   })
}
step(); //kick off the first step!


//CHATFUNCTION--------------------------------------

   //To send a Message to DB + Display MSG
   $(".chatText").keyup(function(e){

      //When enter get s pressed do:
      if(e.keyCode == 13){
         e.preventDefault();
         let chatText = $('.chatText').val();
         $.ajax({
            type:'POST',
            url:'../insert_messages.php',
            data:{chatText:chatText},
            success: async function(){
               $('.chatMessages').load('../display_messages.php')
               $('.chatText').val('')

               clearTimeout(delTimer);
               //Deletes Chatbubble after 5s
               delMsgTimer();
            }
         });
      }
   });

   //When spacebar get s pressed add space 
   $(".chatText").keydown(function(e){

      if(e.keyCode == 32){
         $('.chatText').val($('.chatText').val()+' ')
      }
   });

   //Interval function to Display ChatMessage
   let delTimer;

   setInterval(function(){
      $('.chatMessages').load('../display_messages.php')
   },500);

   $('.chatMessages').load('../display_messages.php')

   function delMsgTimer() {
      delTimer = setTimeout( delMsg, 5000);
    }

   function delMsg() {
      $('.chatMessages').load('../delete_messages.php')
    }


    
//CHARACTERFUNCTION--------------------------------------

   $(".outfitBtn").click(function(e){
      e.preventDefault();
      console.log('Clicked')
      let ninjaFit = $('input[name=outfit]:checked', '#ninjaFit').val();
      //When btn  get s clicked do:
      $.ajax({
         type:'POST',
         url:'../update_ninjafit.php',
         data:{ninjaFit:ninjaFit},
         success: async function(){
            $('.character').load('../display_character.php')
         }
      })
   });

   //Interval function to Display Onlineusers
   setInterval(function(){
      $('.onlineState').load('../display_onlineuser.php')
   },5000);

   $('.onlineState').load('../display_onlineuser.php')

   //Interval function to Display Character
   setInterval(function(){
      $('.character').load('../display_character.php')
   },5000);

   $('.character').load('../display_character.php')

});
