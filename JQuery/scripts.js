$( document ).ready(function() {
    console.log( "ready!" );

    $(".checksito").click(function () {
        var selected = [];
        $(".checksito:checked").each(function (){
            selected.push(this.value);
        });
        console.log(selected);
    });
});