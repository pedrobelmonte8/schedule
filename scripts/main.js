$(document).ready(() => {
    $("#button-search").click(function() {
        $("#details").hide();
        $("#search").css("display", "block");
    });
    //Botón LogOut
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
});