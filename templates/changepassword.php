<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="libs\bootstrap-4.4.1-dist\css\bootstrap.css">
    <script src="https://kit.fontawesome.com/32099913fe.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php?ctl=main">Organízate</a>
        <div class="contDatos">
            <img src="<?php echo isset($_SESSION['img']) ? $_SESSION["img"] : "" ?>" alt="">
            <h3 class="text-light m-3"> <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : "" ?></h3>
            <a href="index.php?ctl=notificaciones"><i class="fas fa-bell iconSettings iNoti"></i></a>
            <a href="index.php?ctl=configuracion"> <i class="fas fa-cog iconSettings iConf"></i></a>
            <i id="buttonLogOut" class="fas fa-sign-out-alt iconSettings"></i>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Configuración</h5>
                        <form id="formModalM">
                            <div class="form-group">
                                <label for="formSettingsPass">Cambiar Contraseña</label>
                                <input type="password" class="inputSettings" id="formSettingsPassActual" aria-describedby="passHelp" placeholder="Introduce Contraseña Actual" required>
                                <input type="password" class="inputSettings" id="formSettingsPass" aria-describedby="passHelp" placeholder="Introduce Nueva Contraseña" required>
                                <input type="password" class="inputSettings" id="formSettingsPass2" aria-describedby="passHelp" placeholder="Repite Contraseña" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="mx-auto" id="errores">
                <?php echo isset($params['msg']) ? $params['msg'] : "" ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- <script src="scripts/settings.js"></script> -->
</body>

</html>