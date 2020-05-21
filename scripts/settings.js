$(document).ready(() => {
    function LogOut() {
        $.ajax({
            url: "index.php",
            type: "GET",
            data: {
                ctl: "logout"
            },
            success: function() {
                window.location.href = "index.php";
            }
        });

    }
    $("#buttonLogOut").click(function() {
        LogOut();
    });
    /* Código para que funcione correctamente los estilo del Input de la imagen */
    /*     $('input[type=file]').change(function() {
            var filename = jQuery(this).val().split('\\').pop();
            var idname = jQuery(this).attr('id');
            $('span.' + idname).next().find('span').html(filename);
            $('.formSettingsImgSpan').html(filename);
        }); */

    $.ajax({
        type: "POST",
        url: "index.php",
        data: {
            "ctl": "cargarDatosUsuario"
        },
        success: function(data) {
            if (data) {
                let datos = JSON.parse(data);
                console.log(datos);
                $("#formSettingsUser").val(datos.name);
                $("#formSettingsEmail").val(datos.email);
                datos.not_email == 0 ? $("#formSettingsNotEmail").prop("checked", false) : $("#formSettingsNotEmail").prop("checked", true);
            }
        }
    });

    /* Submit del Form */
    $("#formSettings").submit(function() {
        /* Comprobamos los campos obligatorios y si a cambiado la img de perfil */
        let nombreUser = $.trim($("#formSettingsUser").val());
        let email = $.trim($("#formSettingsEmail").val());
        let notEmail;
        /*  let img; */
        /*   $("#formSettingsImg")[0].files.length == 0 ? img = 0 : img = 1; */
        let flag = true;
        $("#formSettingsNotEmail").is(":checked") ? notEmail = 1 : notEmail = 0;
        console.log(nombreUser + " " + email + " " + notEmail);
        if (nombreUser == "") {
            flag = false;
            alert("No puede dejar el campo usuario vacío");
            return false;
        } else if (email == "") {
            flag = false;
            alert("No puede dejar el campo email Vacío");
            return false;
        } else if (!nombreUser.match(/^[a-z0-9][a-z0-9_\-@]{4,19}$/i)) {
            flag = false;
            alert("El usuario estará comprendido entre 5 y 20 caracteres, comenzando por una letra o un dígito (-, @, y _ están permitidos)");
            return false;
        } else if (!email.match(/^[a-z]+([\.]?[a-z0-9_-]+)*@[a-z]+([\.-]+[a-z0-9]+)*\.[a-z]{2,}$/)) {
            flag = false;
            alert("Introduzca un email con un formato válido");
            return false;
        }
        /* Cambiamos los datos en la BBDD */
        if (flag) {
            $.ajax({
                type: "POST",
                url: "index.php",
                data: {
                    "ctl": "cambiarDatosUsuario",
                    "user": nombreUser,
                    "email": email,
                    "notEmail": notEmail
                        /*, "img": img */
                },
                success: function(data) {
                    let datos = JSON.parse(data);
                    if (datos) {
                        alert("Cambios realizados correctamente");
                        window.location.href = "index.php";
                    } else {
                        alert("No se ha realizado ningún cambio");

                    }
                }
            });

        }
        return false;
    });

});