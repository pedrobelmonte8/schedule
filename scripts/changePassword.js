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
    $("#formPass").submit(function() {
        let pass1 = $("#formSettingsPassActual").val();
        let pass2 = $("#formSettingsPass").val();
        let newPass = $("#formSettingsPass2").val();
        let flag = true;
        console.log(pass1 + " " + pass2 + " " + newPass);
        if (!pass1.match(/^[a-z0-9][a-z0-9_\-@]{7,20}$/i)) {
            alert("La contraseña estará comprendida entre 8 y 21 caracteres, comenzando por una letra o un dígito (-, @, y _ están permitidos, ñ no)");
            flag = false;
        } else if (pass1 != pass2) {
            alert("Ambas contraseñas deben coincidir");
            flag = false;
        } else if (!newPass.match(/^[a-z0-9][a-z0-9_\-@]{7,20}$/i)) {
            alert("La nueva contraseña estará comprendida entre 8 y 21 caracteres, comenzando por una letra o un dígito (-, @, y _ están permitidos, ñ no)");
            flag = false;
        }
        if (flag) {
            $.ajax({
                type: "POST",
                url: "index.php",
                data: {
                    "ctl": "changePassword",
                    "oldPass": pass1,
                    "newPass": newPass
                },
                success: function(data) {
                    let datos = JSON.parse(data);
                    console.log(datos);
                    if (datos == 0) {
                        alert("La contraseña es incorrecta");
                    } else if (datos == 1) {
                        alert("La contraseña se modificó correctamente");
                        window.location.href = "index.php";
                    } else {
                        alert("Ha ocurrido un error inesperado");
                    }
                }
            });
        }
        return false;
    });

});