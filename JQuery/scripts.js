$( document ).ready(function() {
    console.log( "ready!" );
    var selected = [];
    $(".checksito").click(function () {
        selected  = [];
        $(".checksito:checked").each(function (){
            selected.push(this.value);
        });
        
    });

    $(".gc_marketplace__show-tags").click(function() {
        console.log(selected);
        var resultado__html = "";
        $.map(selected, function(val){
            resultado__html+=("-" + val + "-");
        });
        $(".show_alert").html(resultado__html);
    });
});