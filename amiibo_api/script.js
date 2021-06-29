console.log('script loaded')

getData()

async function getData() {
    //Endpoint for all game series
    const url = 'https://www.amiiboapi.com/api/gameseries/'

    //Fetch GET request
    const response = await fetch(url)
    const data = await response.json()

    //Show data in consoles
    console.log(data)

    //After fetching data show data in page
    showGames(data)

}

//Shows all gamenames in page
function showGames(data) {
    //Array just for names
    const names = []
    data.amiibo.forEach(game => {
        names.push(game.name)
    })

    const uniqueNames = [...new Set(names)]

    uniqueNames.forEach(gameName => {
        const card = document.createElement('div')
        //Create Options for datalist
        const dataOption = document.createElement('option')
        //Add values attribute to option
        dataOption.setAttribute('value', gameName)

        card.classList.add('card')
        
        const template = `
        <div class='info'>${gameName}</div>
        <button class='click'>Give me all Amiibos!!</button>
        `
        card.innerHTML = template
        document.querySelector('.container').appendChild(card)
        document.querySelector('.games').appendChild(dataOption)
    })

    getAmiibos()
}


function getAmiibos() {
    const listItems = document.querySelectorAll('.click')

    listItems.forEach(item => {
        item.addEventListener('click', async (e) => {
            
            //Get clicked div
            const gameName = e.target.previousElementSibling.innerText

            //Make GET request
            const url = `https://www.amiiboapi.com/api/amiibo/?gameseries=${gameName}`

            const response = await fetch(url)
            const data = await response.json()
            console.log(data)
        })
    })
    showAmiibos(data)
}


function showAmiibos(data) {
    
    data.amiibo.forEach(amiibo => {
        const template = `
        <figure>
            <div class='info'>
                <img src="${amiibo.image}" alt="${amiibo.name}"
            </div>
            <div class='name'>${amiibo.name}</div>
        </figure>
        `   

        const card = document.createElement('div')
        card.innerHTML = template
        document.querySelector('.amiibo').appendChild(card)
    })   
}