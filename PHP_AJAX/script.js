console.log('Script loaded')

// Simple form code
document.querySelector('#myForm').addEventListener('submit', e => {
    e.preventDefault()

    const fd = new FormData(document.querySelector('#myForm'))

    //console.log(fd)

    fetch('small_example.php', {
        method: 'POST',
        body: fd //Standart is GET
    }).then(response => {
        response.text().then(data => {
            console.log(data)
            document.querySelector('.messages').append(data)
        })
    })
})


// Contact form code
document.querySelector('#contact').addEventListener('submit', e => {
    e.preventDefault()

    const fd = new FormData(document.querySelector('#contact'))

    fetch('contact.php', {
        method: 'POST',
        body: fd
    }).then(response => {
        response.json().then(data => {
            console.log(data)
            if(data[0] == 'Fail') {
                document.querySelector('.responseContainer').append('Someting went wrong: ' + data[1])
            } else {
                document.querySelector('.responseContainer').append(data[1])
            }
        })
    })
})