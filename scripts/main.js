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

    //Al clickar en cruz para crear nuevo Evento...
    function abrirModal() {
        //Abro modal
        $("#modalNuevoEvento").modal();
    }
    //Arreglar Modal y LocalStorage
    $(".nuevoEvento").on("click", function() {
        let fechaClickada;
        if ($(this).closest("ul").attr("id") == "actualDateList") {
            fechaClickada = $("#actualDate").text();
        } else if ($(this).closest("ul").attr("id") == "nextDateList") {
            fechaClickada = $("#nextDate").text();
        }
        localStorage.setItem("fechaClickada", fechaClickada);
        abrirModal();
    });

    $("#formModal").submit(function() {
        //Recojo los datos y compruebo que están rellenados
        let titulo = $.trim($("#formModalTitulo").val());
        let masDetalles = $.trim($("#formModalDescription").val());
        let hora = $.trim($("#formModalHora").val());
        let importancia;
        let flag = true;
        $("#CheckModal").is(":checked") ? importancia = 1 : importancia = 0;
        console.log(titulo + masDetalles + hora);
        console.log(importancia);
        if (titulo == "") {
            alert("Complete el campo titulo");
            flag = false;
        } else
        if (hora == "") {
            alert("Complete el campo hora");
            flag = false;
        }
        //Si todo a ido bien se hace la petición Ajax...

        if (flag) {
            let date = localStorage.getItem("fechaClickada");
            date = date.split("-").reverse().join("-");
            $.ajax({
                type: "POST",
                url: "index.php",
                data: {
                    "ctl": "nuevoEvento",
                    "titulo": titulo,
                    "masDetalles": masDetalles,
                    "hora": hora,
                    "importancia": importancia,
                    "fecha": date
                },
                success: function(data) {
                    //Si todo va bien...
                    console.log(data);
                    if (data) {
                        //Vaciamos el Formulario
                        $("#formModalTitulo").val("");
                        $("#formModalDescription").val("");
                        $("#formModalHora").val("");
                        $("#CheckModal").prop("checked", false);
                        //Cerramos el modal
                        $("#modalNuevoEvento").modal("toggle");
                        //Actualizamos las listas
                        actualizarListas();
                    }
                }
            });

        }
        return false;
    });


    function modificarEvento() {

    }

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
        let date1FormatPHP = date1.getFullYear().toString() + "-" + (date1.getMonth() + 1).toString().padStart(2, "0") + "-" + date1.getDate().toString().padStart(2, "0");
        let date2FormatPHP = date2.getFullYear().toString() + "-" + (date2.getMonth() + 1).toString().padStart(2, "0") + "-" + date2.getDate().toString().padStart(2, "0");
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
        let date1FormatPHP = date1.getFullYear().toString() + "-" + (date1.getMonth() + 1).toString().padStart(2, "0") + "-" + date1.getDate().toString().padStart(2, "0");
        let date2FormatPHP = date2.getFullYear().toString() + "-" + (date2.getMonth() + 1).toString().padStart(2, "0") + "-" + date2.getDate().toString().padStart(2, "0");
        //Ajax
        getListaFecha1(date1FormatPHP);
        getListaFecha2(date2FormatPHP);
    }

    function actualizarListas() {
        let dateTarjeta1 = $("#actualDate").text();
        let dateTarjeta2 = $("#nextDate").text();
        let date1 = dateTarjeta1.split("-").reverse().join("-");
        let date2 = dateTarjeta2.split("-").reverse().join("-");
        date1 = new Date(date1);
        date2 = new Date(date2);
        let date1FormatPHP = date1.getFullYear().toString() + "-" + (date1.getMonth() + 1).toString().padStart(2, "0") + "-" + date1.getDate().toString().padStart(2, "0");
        let date2FormatPHP = date2.getFullYear().toString() + "-" + (date2.getMonth() + 1).toString().padStart(2, "0") + "-" + date2.getDate().toString().padStart(2, "0");
        //Ajax
        getListaFecha1(date1FormatPHP);
        getListaFecha2(date2FormatPHP);
        //Añadimos los eventos dinamicamente...
        $("#actualDateList").unbind("click", ".iconoEliminar");
        $("#actualDateList").on("click", ".iconoEliminar", function() {
            eliminarEvento(this);
        });
        $("#nextDateList").on("click", ".iconoEliminar", function() {
            eliminarEvento(this);
        });
    }

    function eliminarEvento(e) {
        let id = $(e).closest(".elementList").attr("data-id");
        //Funcion Ajax
        $.ajax({
            type: "POST",
            url: "index.php",
            data: {
                ctl: "eliminarEvento",
                id: id
            },
            success: function(data) {
                alert("Exito");
                actualizarListas();
            }
        });
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
                $("#actualDate").text(fecha.split("-").reverse().join("-"));
                let lista = $("#actualDateList");
                lista.empty();
                for (let i = 0; i < datos.length; i++) {
                    let importancia;
                    datos[i].importance == 1 ? importancia = 'importante' : importancia = 'no-importante';
                    /* Insertamos los eventos en la lista */
                    lista.append("<li class='elementList' data-id='" + datos[i].id + "'>" +
                        "<p class='paragElementList'>" + datos[i][3] + " - " + datos[i].title + "</p>" +
                        "<div class='iconos'>" +
                        "<i class='fas fa-square importancia " + importancia + "'></i>" +
                        "<i class='iconos fas fa-trash-alt iconoEliminar'></i>" +
                        "<i class='iconos fas fa-pencil-alt'></i>" +
                        "</div> </li>");
                }
                lista.append("<i class='fas fa-plus nuevoEvento' ></i>");
                $(".nuevoEvento").unbind("click");
                $(".nuevoEvento").on("click", function() {
                    let fechaClickada;
                    if ($(this).closest("ul").attr("id") == "actualDateList") {
                        fechaClickada = $("#actualDate").text();
                    } else if ($(this).closest("ul").attr("id") == "nextDateList") {
                        fechaClickada = $("#nextDate").text();
                    }
                    localStorage.setItem("fechaClickada", fechaClickada);
                    abrirModal();
                });
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
                $("#nextDate").text(fecha.split("-").reverse().join("-"));
                let lista = $("#nextDateList");
                lista.empty();
                for (let i = 0; i < datos.length; i++) {
                    let importancia;
                    datos[i].importance == 1 ? importancia = 'importante' : importancia = 'no-importante';
                    /* Insertamos los eventos en la lista */
                    lista.append("<li class='elementList' data-id='" + datos[i].id + "'>" +
                        "<p class='paragElementList'>" + datos[i][3] + " - " + datos[i].title + "</p>" +
                        "<div class='iconos'>" +
                        "<i class='fas fa-square importancia " + importancia + "'></i>" +
                        "<i class='iconos fas fa-trash-alt iconoEliminar'></i>" +
                        "<i class='iconos fas fa-pencil-alt'></i>" +
                        "</div> </li>");
                }
                lista.append("<i class='fas fa-plus nuevoEvento' ></i>");
                $(".nuevoEvento").unbind("click");
                $(".nuevoEvento").on("click", function() {
                    let fechaClickada;
                    if ($(this).closest("ul").attr("id") == "actualDateList") {
                        fechaClickada = $("#actualDate").text();
                    } else if ($(this).closest("ul").attr("id") == "nextDateList") {
                        fechaClickada = $("#nextDate").text();
                    }
                    localStorage.setItem("fechaClickada", fechaClickada);
                    abrirModal();
                });
            }
        });
    }
    $("#anterior").click(function() {
        diaAnterior();

    });
    $("#siguiente").click(function() {
        diaSiguiente();
    });
    actualizarListas();
    /*  $(".iconoEliminar").unbind("click"); */
    $(".iconoEliminar").on("click", function() {
        alert("asd");
        eliminarEvento(this);
    });
});