<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="libs\bootstrap-4.4.1-dist\css\bootstrap.css">
    <script src="https://kit.fontawesome.com/32099913fe.js" crossorigin="anonymous"></script>
    <title>Configuración</title>
</head>
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php?ctl=main">Organízate</a>
        <div class="contDatos">
            <img class="d-none d-lg-block" src="<?php echo isset($_SESSION['img']) ? $_SESSION["img"] : "" ?>" alt="">
            <h3 class="text-light m-3 d-none d-lg-block"> <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : "" ?></h3>
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
                        <form id="formSettings" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="formSettingsUser">Nombre de Usuario</label>
                                <input type="text" class="inputSettings" id="formSettingsUser" aria-describedby="userHelp" placeholder="Introduce Nombre de Usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="formSettingsEmail">Correo Electrónico</label>
                                <input type="text" class="inputSettings" id="formSettingsEmail" aria-describedby="emailHelp" placeholder="Introduce Correo Electrónico" required>
                            </div>
                            <div class="form-check form-group">
                                <input type="checkbox" class="form-check-input" id="formSettingsNotEmail">
                                <label class="form-check-label" for="formSettingsNotEmail">Notificaciones Email</label>
                                <small id="emailHelp" class="form-text text-muted">Si lo marca recibirá periodicamente notificaciones a su email con los eventos que haya marcado como importantes</small>
                            </div>
                            <!-- <div class="form-group">
                                <label for="formSettingsImg"><i class="fas fa-upload"></i> <span class="formSettingsImgSpan">Cambiar Imagen de Perfil</span></label>
                                    <input name="formSettingsImg" type="file" id="inputFile" class="form-control" placeholder="Imagen de Perfil" required>
                                    <span class="formSettingsImg"></span>
                            </div> -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                        <div class="row col">
                            <a href="index.php?ctl=changepassword">
                                <button class="btn btn-danger">Cambiar Contraseña</button>
                            </a>
                        </div>
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
    <script src="scripts/settings.js"></script>
</body>

</html>