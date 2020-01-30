$(document).ready(function () {

    //srink function
    var bandera = 1;
    $(".signup").on("click", function () {
        if (bandera == 1) {
            $(".signup, .login").addClass("shrink");
            $(".signupform").show();
            bandera = 0;
            console.log(bandera);
        } else {
            $(".shrink").removeClass("shrink");
            $(".signupform, .loginform").hide();
            bandera = 1;
        }
    });
    $(".login").on("click", function () {
        if (bandera == 1) {
            $(".signup, .login").addClass("shrink");
            $(".loginform").show();
            bandera = 0;
            console.log(bandera);
        } else {
            $(".shrink").removeClass("shrink");
            $(".signupform, .loginform").hide();
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