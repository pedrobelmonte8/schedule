$(document).ready(() => {
    $('#form_register').submit(function(e) {
        let name = $('#inputName').val();
        let email = $('#inputEmail').val();
        let pass1 = $('#inputPassword').val();
        let pass2 = $('#inputRepPassword').val();
        let errores = [];
        //Comprobamos que todos los campos están rellenados
        if (name == "" || email == "" || pass1 == "" || pass2 == "") {
            errores.push("<div class='error'><p><i class='fa fa-times-circle'></i><p>Rellene todos los campos</p></div>");
        } else {
            //Formato del Nombre de Usuario
            if (!name.match(/^[a-z0-9][a-z0-9_\-@]{4,19}$/i)) {
                errores.push("<div class='error'><p><i class='fa fa-times-circle'></i>El usuario estará comprendido entre 5 y 20 caracteres, comenzando por una letra o un dígito (-, @, y _ están permitidos).</div>");
            }
            //Formato del Email
            if (!email.match(/^[a-z]+([\.]?[a-z0-9_-]+)*@[a-z]+([\.-]+[a-z0-9]+)*\.[a-z]{2,}$/)) {
                errores.push("<div class='error'><p><i class='fa fa-times-circle'></i>El campo email debe tener el siguiente formato de email usuario@servidor.tipo</p></div>");
            }
            //Formato de la Contraseña
            if (!pass1.match(/^[a-z0-9][a-z0-9_\-@]{7,20}$/i)) {
                errores.push("<div class='error'><p><i class='fa fa-times-circle'></i>La contraseña estará comprendida entre 8 y 21 caracteres, comenzando por una letra o un dígito (-, @, y _ están permitidos).</p></div>");
            }
            //Comprobamos que ambas contraseñas coinciden
            if (errores.length == 0) {
                if (pass1 != pass2) {
                    errores.push("<div class='error'><p><i class='fa fa-times-circle'></i>Ambas contraseñas deben coincidir</p></div>");
                }
            }
            //Si hay errores...
            if (errores.length > 0) {
                $("#errores").empty();
                for (let i = 0; i < errores.length; i++) {
                    $("#errores").append(errores[i]);
                }
                errores = [];
                return false;
            }

        }


    })
});