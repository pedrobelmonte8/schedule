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
    $(".cuerpoNotificaciones").on("click", ".iconoEliminar", function() {
        let id = $(this).parent().parent().parent().attr("data-id");
        let li = $(this).parent().parent().parent();
        $.ajax({
            type: "POST",
            url: "index.php",
            data: {
                "ctl": "eliminarNotificacion",
                "id": id
            },
            success: function(data) {
                let datos = JSON.parse(data);
                console.log(li);
                $(li).remove();
            }
        });
        console.log();
    });
});