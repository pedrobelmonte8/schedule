<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="libs\bootstrap-4.4.1-dist\css\bootstrap.css">
    <script src="https://kit.fontawesome.com/32099913fe.js" crossorigin="anonymous"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Handlee&display=swap');
</style>
<title>Organízate</title>
</head>

<body>
    <!-- Cabecera -->
    <nav class="navbar navbar-dark bg-dark">
       <div class="next-last"> <a class="navbar-brand" href="index.php?ctl=main">Organízate</a> <i class="fas fa-angle-left center" id="anterior"></i>    <i class="fas fa-angle-right center" id="siguiente"></i></div>

        <div class="contDatos">
            <img src="<?php echo isset($_SESSION['img']) ? $_SESSION["img"] : "" ?>" alt="">
            <h3 class="text-light m-3"> <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : "" ?></h3>
            <a href="index.php?ctl=notificaciones"><i class="fas fa-bell iconSettings iNoti"></i></a>
            <a href="index.php?ctl=configuracion"> <i class="fas fa-cog iconSettings iConf"></i></a>
            <i id="buttonLogOut" class="fas fa-sign-out-alt iconSettings"></i>
        </div>
    </nav>
    <div class="container-fluid">
        <!-- Modal de nuevo Evento -->
        <div id="modalNuevoEvento" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="fechaModal" class="modal-title">Nuevo Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column">
                        <p>Rellene los campos correspondientes</p>
                        <!-- Formulario del Modal -->
                        <form id="formModal">
                            <div class="form-group">
                                <label for="formModalTitulo">Título</label>
                                <input type="text" class="form-control" id="formModalTitulo" aria-describedby="tituloHelp" placeholder="Introduce Título" required>
                            </div>
                            <div class="form-group">
                                <label for="formModalDescription">Mas detalles</label>
                                <textarea class="form-control" id="formModalDescription" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="formModalHora">Hora</label>
                                <input type="time" class="form-control" id="formModalHora" aria-describedby="horaHelp" placeholder="Introduce la hora" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="CheckModal">
                                <label class="form-check-label" for="CheckModal">Recuérdamelo</label>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Modificar Evento -->
        <div id="modalModificarEvento" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="fechaModal" class="modal-title">Modificar Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column">
                        <p>Rellene los campos correspondientes</p>
                        <!-- Formulario del Modal -->
                        <form id="formModalM">
                            <div class="form-group">
                                <label for="formModalTituloM">Título</label>
                                <input type="text" class="form-control" id="formModalTituloM" aria-describedby="tituloHelp" placeholder="Introduce Título" required>
                            </div>
                            <div class="form-group">
                                <label for="formModalDescriptionM">Mas detalles</label>
                                <textarea class="form-control" id="formModalDescriptionM" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="formModalHoraM">Hora</label>
                                <input type="time" class="form-control" id="formModalHoraM" aria-describedby="horaHelp" placeholder="Introduce la hora" required>
                            </div>
                            <div class="form-group">
                                <label for="formModalFechaM">Fecha</label>
                                <input type="date" class="form-control" id="formModalFechaM" aria-describedby="fechaHelp" placeholder="Introduce la fecha" min="2000-01-01" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="CheckModalM">
                                <label class="form-check-label" for="CheckModalM">Recuérdamelo</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!--  <div class="row next-last">
                <div class="ml-4 col-sm-4 d-flex justify-content-start">
                    <i class="fas fa-angle-left center" id="anterior"></i>
                </div>
                <div class="ml-4 col-sm-4 d-flex justify-content-end">
                    <i class="fas fa-angle-right center" id="siguiente"></i>
                </div>
            </div> -->
            <!-- Inicio Tarjeta 1 -->
            <div class=" col-11 col-md-6 col-lg-4 mt-4 ml-4 p-4 hoja1">
                <div class="fecha1">
                    <!-- Pinto la fecha del dia actual mediente PHP -->
                    <p id="actualDate"><?php echo isset($params['actDate']) ? $params['actDate'] : "error" ?></p>
                </div>
                <ul id="actualDateList">
                    
                    <i class="fas fa-plus nuevoEvento"></i>
                </ul>
            </div>
            <!-- Final Tarjeta 1 -->
            <!-- Inicio Tarjeta 2 -->
            <div class="d-none d-lg-block col-lg-4 col-11 mt-4 ml-4 p-4 hoja2">
                <div class="fecha2">
                    <p id="nextDate"><?php echo isset($params['nextDate']) ? $params['nextDate'] : "error" ?></p>
                </div>
                <ul id="nextDateList">
                    <i class="fas fa-plus nuevoEvento"></i>
                </ul>
            </div>
            <!-- Final Tarjeta 2 -->
            <!-- Inicio Ficha Detalles -->
            <div class="col-11 col-lg-3 col-md-5 mt-4 ml-4 p-4 details">
                <!-- Empieza formulario Buscar -->
                <form id="search" method="POST">
                    <div class="form-group col ">
                        <label for="formTittle" class="text-light">Buscar eventos</label>
                        <input class="form-control" type="text" id="textSearch">
                    </div>
                    <div class="form-group col ">
                        <input class="btn btn-info" type="submit">
                    </div>
                </form>
                <div class="col ">
                    <ul id="searchList">
                    </ul>
                </div>
            </div>
            <!-- Final Ficha Detalles -->
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="scripts/main.js"></script>
</body>

</html>