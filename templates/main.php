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
<title>Document</title>
</head>

<body>
    <!-- Cabecera -->
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Organízate</a>
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
                            <label for="formModalHora">Título</label>
                                <input type="time" class="form-control" id="formModalHora" aria-describedby="horaHelp" placeholder="Introduce la hora" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="CheckModal">
                                <label class="form-check-label" for="CheckModal">Importante</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Inicio Tarjeta 1 -->
            <div class="col-sm-4 mt-4 ml-4 p-4 hoja1">
                <div class="fecha1">
                    <!-- Pinto la fecha del dia actual mediente PHP -->
                    <p id="actualDate"><?php echo isset($params['actDate']) ? $params['actDate'] : "error" ?></p>
                </div>
                <ul id="actualDateList">
                    <!-- elementList Añadir Evento Click -->
                    <!--  <li class="elementList" data-id="1">
                        <p class="paragElementList" data-hour="12:00">12:00- Comida con la familia, ya no se que mas poner pero debo poner cosas hasta que salte de linea</p>
                        <div class="iconos">
                            <i class="far fa-square importancia"></i>
                            <i class="iconos fas fa-trash-alt"></i>
                            <i class="iconos fas fa-pencil-alt"></i>
                        </div>
                    </li> -->
                    <?php echo isset($params['dataActDate']) ? $params['dataActDate'] : "error" ?>
                    <i class="fas fa-plus nuevoEvento"></i>
                </ul>
            </div>
            <!-- Final Tarjeta 1 -->
            <!-- Inicio Tarjeta 2 -->
            <div class="col-sm-4 mt-4 ml-4 p-4 hoja2">
                <div class="fecha2">
                    <p id="nextDate"><?php echo isset($params['nextDate']) ? $params['nextDate'] : "error" ?></p>
                </div>
                <ul id="nextDateList">
                    <!--  <li>
                        <p>12:00 - Comida</p>
                        <div class="iconos"><i class="far fa-square importancia"></i><i class="iconos fas fa-trash-alt"></i><i class="iconos fas fa-pencil-alt"></i></div>
                    </li> -->
                    <i class="fas fa-plus nuevoEvento"></i>
                </ul>
            </div>
            <!-- Final Tarjeta 2 -->
            <!-- Inicio Ficha Detalles -->
            <div class="col-sm-3 mt-4 ml-4 p-4 details">
                <!-- Empieza formulario Modificar -->
                <form action="POST" id="details">
                    <div class="form-group col ">
                        <label for="formTittle" class="text-light">Título</label>
                        <input class="form-control" type="text" name="" id="formTittle">
                    </div>
                    <div class="form-group col ">
                        <label for="formDescription" class="text-light">Descripción</label>
                        <textarea class="form-control" id="formDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group col ">
                        <label for="formDate" class="text-light">XX-XX-XXXX</label>
                    </div>
                    <div class="form-group col ">
                        <select class="bg-success custom-select custom-select-lg mb-3">
                            <option class="bg-danger" value="1">No Importante</option>
                            <option class="bg-success" value="2">Importante</option>
                        </select>
                    </div>
                    <br><br>
                    <div class="details-save form-group col  d-flex">
                        <input class="btn btn-info" type="button" value="Guardar">
                        <button type="button" class="btn btn-dark align-self-end" id="button-search"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <!-- Empieza formulario Buscar -->
                <form id="search" action="POST">
                    <div class="form-group col ">
                        <label for="formTittle" class="text-light">Buscar eventos concretos</label>
                        <input class="form-control" type="text" name="" id="formTittle">
                    </div>
                    <div class="form-group col ">
                        <input class="btn btn-info" type="button" value="Buscar">
                    </div>
                </form>
            </div>
            <!-- Final Ficha Detalles -->
        </div>
        <div class="row next-last">
            <div class="ml-4 col-sm-4 d-flex justify-content-start">
                <i class="fas fa-angle-left center" id="anterior"></i>
            </div>
            <div class="ml-4 col-sm-4 d-flex justify-content-end">
                <i class="fas fa-angle-right center" id="siguiente"></i>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="scripts/main.js"></script>
</body>

</html>