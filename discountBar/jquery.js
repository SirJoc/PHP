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