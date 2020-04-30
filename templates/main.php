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
        <i class="fas fa-cog iconSettings"></i>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Inicio Tarjeta 1 -->
            <div class="col-sm-4 mt-4 ml-4 p-4 hoja1">
                <div class="fecha1">
                    <p id="actualDate">Hoy</p>
                </div>
                <ul>
                    <div>
                        <!-- elementList Añadir Evento Click -->
                        <li class="elementList" data-id="">
                            <p>12:00 - Comida con la familia, ya no se que mas poner pero debo poner cosas hasta que salte de linea</p>
                            <div class="iconos"><i class="far fa-square importancia"></i>
                                <i class="iconos fas fa-trash-alt"></i><i class="iconos fas fa-pencil-alt"></i></div>
                        </li>
                        <i class="fas fa-plus"></i>

                    </div>
                </ul>
            </div>
            <!-- Final Tarjeta 1 -->
            <!-- Inicio Tarjeta 2 -->
            <div class="col-sm-4 mt-4 ml-4 p-4 hoja2">
                <div class="fecha2">
                    <p id="nextDate">Mañana</p>
                </div>
                <ul>
                    <li>
                        <p>12:00 - Comida </p>
                        <div class="iconos"><i class="far fa-square importancia"></i><i class="iconos fas fa-trash-alt"></i><i class="iconos fas fa-pencil-alt"></i></div>
                    </li>
                    <i class="fas fa-plus"></i>
                </ul>
            </div>
            <!-- Final Tarjeta 2 -->
            <!-- Inicio Ficha Detalles -->
            <div class="col-sm-3 mt-4 ml-4 p-4 details">
                <form action="POST">
                    <div class="form-group">
                        <label for="formTittle" class="text-light">Título</label>
                        <input class="form-control" type="text" name="" id="formTittle">
                    </div>
                    <div class="form-group">
                        <label for="formDescription" class="text-light">Example textarea</label>
                        <textarea class="form-control" id="formDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="formDate" class="text-light">XX-XX-XXXX</label>
                    </div>
                    <div class="form-group">
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Importante
                            </button>
                            <div class="dropdown-menu p-0">
                                <a class="dropdown-item bg-success" href="#">Action</a>
                                <a class="dropdown-item bg-danger" href="#">Another action</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Final Ficha Detalles -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>