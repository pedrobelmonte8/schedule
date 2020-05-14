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

    //Flechas dias anterior y siguiente
    function diaAnterior() {
        //Cogemos la fecha de la primera tarjeta cambiandole el formato
        let dateTarjeta1 = $("#actualDate").text();
        let dateTarjeta2 = $("#nextDate").text();
        let date1 = dateTarjeta1.split("-").reverse().join("-");
        let date2 = dateTarjeta2.split("-").reverse().join("-");
        date1 = new Date(date1);
        date2 = new Date(date2);
        //Restamos un día
        date1.setDate(date1.getDate() - 1);
        date2.setDate(date2.getDate() - 1);
        //Sumamos un mes para tener bien el formato
        let date1FormatPHP = date1.getFullYear().toString() + "-" + (date1.getMonth() + 1).toString().padStart(2, "0") + "-" + date1.getDate().toString();
        let date2FormatPHP = date2.getFullYear().toString() + "-" + (date2.getMonth() + 1).toString().padStart(2, "0") + "-" + date2.getDate().toString();
        //Ajax
        getListaFecha1(date1FormatPHP);
        getListaFecha2(date2FormatPHP);
    }

    function diaSiguiente() {
        //Cogemos la fecha de la primera tarjeta cambiandole el formato
        let dateTarjeta1 = $("#actualDate").text();
        let dateTarjeta2 = $("#nextDate").text();
        let date1 = dateTarjeta1.split("-").reverse().join("-");
        let date2 = dateTarjeta2.split("-").reverse().join("-");
        date1 = new Date(date1);
        date2 = new Date(date2);
        //Restamos un día
        date1.setDate(date1.getDate() + 1);
        date2.setDate(date2.getDate() + 1);
        //Sumamos un mes para tener bien el formato
        let date1FormatPHP = date1.getFullYear().toString() + "-" + (date1.getMonth() + 1).toString().padStart(2, "0") + "-" + date1.getDate().toString();
        let date2FormatPHP = date2.getFullYear().toString() + "-" + (date2.getMonth() + 1).toString().padStart(2, "0") + "-" + date2.getDate().toString();
        //Ajax
        getListaFecha1(date1FormatPHP);
        getListaFecha2(date2FormatPHP);
    }

    function getListaFecha1(fecha) {
        $.ajax({
            type: "POST",
            url: "index.php",
            data: {
                ctl: "getListaEventos",
                fechaActual: fecha
            },
            success: function(data) {
                let datos = JSON.parse(data);
                //Bucle
                console.log(data);
                $("#actualDate").text(fecha.split("-").reverse().join("-"));
                let lista = $("#actualDateList");
                lista.empty();
                for (let i = 0; i < datos.length; i++) {
                    console.log(datos[i]);
                    let importancia;
                    datos[i].importance == 1 ? importancia = 'importante' : importancia = 'no-importante';
                    /* Insertamos los eventos en la lista */
                    lista.append("<li class='elementList' data-id='" + datos[i].id + "'>" +
                        "<p class='paragElementList'>" + datos[i][3] + " - " + datos[i].title + "</p>" +
                        "<div class='iconos'>" +
                        "<i class='fas fa-square importancia " + importancia + "'></i>" +
                        "<i class='iconos fas fa-trash-alt'></i>" +
                        "<i class='iconos fas fa-pencil-alt'></i>" +
                        "</div> </li>");
                }
                lista.append("<i class='fas fa-plus'></i>");
            }
        });
    }

    function getListaFecha2(fecha) {
        $.ajax({
            type: "POST",
            url: "index.php",
            data: {
                ctl: "getListaEventos",
                fechaActual: fecha
            },
            success: function(data) {
                let datos = JSON.parse(data);
                //Bucle
                console.log(data);
                $("#nextDate").text(fecha.split("-").reverse().join("-"));
                let lista = $("#nextDateList");
                lista.empty();
                for (let i = 0; i < datos.length; i++) {
                    console.log(datos[i]);
                    let importancia;
                    datos[i].importance == 1 ? importancia = 'importante' : importancia = 'no-importante';
                    /* Insertamos los eventos en la lista */
                    lista.append("<li class='elementList' data-id='" + datos[i].id + "'>" +
                        "<p class='paragElementList'>" + datos[i][3] + " - " + datos[i].title + "</p>" +
                        "<div class='iconos'>" +
                        "<i class='fas fa-square importancia " + importancia + "'></i>" +
                        "<i class='iconos fas fa-trash-alt'></i>" +
                        "<i class='iconos fas fa-pencil-alt'></i>" +
                        "</div> </li>");
                }
                lista.append("<i class='fas fa-plus'></i>");
            }
        });
    }
    $("#anterior").click(function() {
        diaAnterior();
    });
    $("#siguiente").click(function() {
        diaSiguiente();
    });
});