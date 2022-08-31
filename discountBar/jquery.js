function changes_options() {
    let value = parseFloat($("#cost_value").html());
    let per_complete = value/100;
    console.log(per_complete);
    if(per_complete <= 1) {
        $("#Progress").width(per_complete*100 + "%");
    }else if(per_complete >= 1 ) {
        $("#Progress").width(100 + "%");
        $(".text_discount").html("¡Felicidades! - Tienes envío GRATIS");
    }
}


function update() {
    let value = parseFloat($("#cost_value").html());
    $("#cost_value").html(parseFloat(value +10).toFixed(2));
    changes_options();
}



function replaceClass(class_identifier, remove_class, add_class){
    let elem = $(`.${class_identifier}`);
    if (elem.hasClass(remove_class)){
        elem.removeClass(remove_class);
         
    }
    elem.addClass(add_class);   
}

function replaceId(id_identifier, remove_id, add_id){
    let elem = $(`#${id_identifier}`);
    if (elem.hasClass(remove_id)){
        elem.removeClass(remove_id);
        elem.addClass(add_id);    
    }
}

function parent_console(){
    console.log($(".card_tapa1").parent())
}

async function intento__1() {
    let promise = new Promise ((resolve, reject) => {
        setTimeout(function(){
        $(".intento1").html("Muy buenas tardes, mi gente")
        resolve("done!")
        reject("buena mi gente, no funciono");
        replaceClass("card_tapa1", "hidden", "showing")
    }, 200)});
    
    setTimeout(async function(){
        let result = await promise;
        console.log(result)
        $(".card_compra").addClass("hidden");
        console.log(result + 1)
    }, 3000); 
    
}

