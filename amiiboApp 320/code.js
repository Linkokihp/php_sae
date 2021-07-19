// Start the getData application to fetch all games from the amiibo api
getData ()
async function getData () {
  // Endpoint for all game series
  const url = 'https://www.amiiboapi.com/api/gameseries'
  // Fetch GET request
  const response = await fetch(url)
  const data = await response.json()
  // After we have all games, show them in the page
  showGames(data)
}


function showGames (data) {
  

  const names = []
  data.amiibo.forEach(game => {
    names.push(game.name)
  });
  console.log(names)
  const uniqueNames = [...new Set(names)]

  console.log( uniqueNames)
  // Create a div for every game in the api
  // and append it in the .container element
  uniqueNames.forEach(gameName => {
    const gameDiv = document.createElement('li')
    const dataOption = document.createElement('option')
    dataOption.setAttribute('value', gameName)
    gameDiv.innerHTML = gameName
    document.querySelector('#games').appendChild(dataOption)
    document.querySelector('.gameseries').appendChild(gameDiv)
  }); 

  getAmiibos()
}


// BONUS
// ADD Datalist function

document.querySelector('form').addEventListener('submit', async e => {
  e.preventDefault()
  document.querySelector('.amiibos').innerHTML = ''
  const gameName = document.querySelector('form > input').value
  const url = `https://www.amiiboapi.com/api/amiibo/?gameseries=${gameName}`
  
  const response = await fetch(url)
  const data = await response.json()
  console.log(data)
  showAmiibos(data)
})


function getAmiibos() {
  console.log('getting amiibos')
  // 1: click event on loaded <li>s
    const listItems = document.querySelectorAll('li')
    
    listItems.forEach( item => {

      // document.querySelector('input["type=submit"]').

      item.addEventListener('click', async (e) =>{
        // 2: get content of clicked <li>
        document.querySelector('.amiibos').innerHTML = ''
        const gameName = e.target.innerText
        // 3: make request using the content as part of the URL
        const url = `https://www.amiiboapi.com/api/amiibo/?gameseries=${gameName}`
  
        const response = await fetch(url)
        const data = await response.json()
        console.log(data)
        showAmiibos(data)
      })
    })
    
}

// 1: create a function that shows amiibos
function showAmiibos (gameData) {
// 2: write a template for each amiibo that will be shown
   gameData.amiibo.forEach( amiibo => {
    const amiiboTemplate = `
    <figure>
      <div>
        <img src="${amiibo.image}" alt="${amiibo.name}">
      </div>
      <figcaption>
        <ul>
          <li><h3>Name: ${amiibo.name}</h3></li>
          <li><h4>Game Series: ${amiibo.gameSeries}</h4></li>
          <li><h4>Amiibo Series: ${amiibo.amiiboSeries}</h4></li>
          <li><h4>Type: ${amiibo.type}</h4></li>
          <li>Releases: 
            <ul>
              ${amiibo.release.au != null ? `<li>Australian Release: ${amiibo.release.au}</li>` : `<li>No Australian release Date</li>`}
              ${amiibo.release.eu != null ? `<li>European Release: ${amiibo.release.eu}</li>` : `<li>No European release Date</li>`}
              ${amiibo.release.jp != null ? `<li>Japanese Release: ${amiibo.release.jp}</li>` : `<li>No Japanese  release Date</li>`}
              ${amiibo.release.na != null ? `<li>North Amertican Release: ${amiibo.release.na}</li>` : `<li>No North Amertican release Date</li>`}
            </ul>
          </li>
        </ul>
      </figcaption>

    </figure>
    `

    // SAME AS :
    // if ( amiibo.release.au != null ){
    //   return '<li>Australian Release: ${amiibo.release.au}</li>'
    // }else {
    //   return `No Australian release Date`
    // }

    // 3: insert the template in the HTML
    const amiiboExample = document.createElement('div')
    amiiboExample.innerHTML = amiiboTemplate
    document.querySelector('.amiibos').appendChild(amiiboExample)

   } )

  


}










