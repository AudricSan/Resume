console.log('Hellow World, index.js')

function updateValue(a) {
    // console.log('updateValue')
    // console.log(a)
}

function keydownFunction(a) {
    // console.log('keydownFunction')
    // console.log(a)
}

function keyupFunction(a) {
    // console.log('keyupFunction')
    // console.log(a)
    // console.log(a.value)
    // console.log(a.id)

    switch (a.id) {
        case "litre":
            litre = a.value
            break;
        
        case "price":
            prix = a.value            
            break;
    
        default:
            break;
    }

    total = litre * prix
    // console.log(prix)
    // console.log(litre)
    // console.log(total)

    prixLitre.innerHTML = 'Total = ' + total + '€';
}