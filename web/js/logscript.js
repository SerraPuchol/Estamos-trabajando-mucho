$(document).ready(function () {

    //srink function
    var bandera = 1;
    $(".signup").on("click", function () {
        if (bandera == 1) {
            $(".signup").addClass("shrink");
            $(".signupform").show(250);
            bandera = 0;
            console.log(bandera);
        } else {
            $(".shrink").removeClass("shrink");
            $(".signupform").hide(250);
            bandera = 1;
        }
    });


    //formulario clase activo
    $("input").on("click", function () {
        $(".activo").removeClass("activo");
        $(this).addClass("activo");
    });

    $("input[type=submit").on("click", function () {
        event.preventDefault();
    });
});