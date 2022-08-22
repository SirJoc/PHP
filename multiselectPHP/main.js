var list_checkbox = document.getElementsByName('vehicle');
var pets = document.getElementById('pets');



pets.addEventListener('click', (event) => {
    list_checkbox.forEach(element_checkbox => {
        if(element_checkbox.checked){
            console.log(element_checkbox)
        }
    })
})



