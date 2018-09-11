function styleInput() {
    $(".material-input").focus(function(){
        $(this).parent().addClass("is-active is-completed");
    });
    $(".material-input").each(function (index) {
        if($(this).val()){
            $(this).parent().addClass("is-active is-completed")
        } else {
            $(this).parent().removeClass("is-completed");
            $(this).parent().removeClass("is-active")
        }
    });

    $(".material-input").focusout(function(){
        if($(this).val() === "")
            $(this).parent().removeClass("is-completed");
        $(this).parent().removeClass("is-active");
    });
}