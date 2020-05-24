<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/registry.css">
    <link rel="stylesheet" href="libs\bootstrap-4.4.1-dist\css\bootstrap.css">
    <script src="https://kit.fontawesome.com/32099913fe.js" crossorigin="anonymous"></script>
    <title>Registro</title>
</head>
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Registro</h5>
                        <form class="form-signin" method="POST" role="form" data-toggle="validator" id="form_register" enctype="multipart/form-data">
                            <div class="form-label-group">
                                <input name="inputName" type="text" id="inputName" class="form-control" placeholder="Nombre de Usuario" required autofocus>
                            </div>
                            <div class="form-label-group">
                                <input name="inputEmail" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                            </div>

                            <div class="form-label-group">
                                <input name="inputPassword" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                            </div>
                            <div class="form-label-group">
                                <input name="inputRepPassword" type="password" id="inputRepPassword" class="form-control" placeholder="Repita la Contraseña" required>
                            </div>
                            <div class="form-label-group">
                                <input name="inputFile" type="file" id="inputFile" class="form-control" placeholder="Imagen de Perfil" required>
                            </div>

                            <button name="inputRegister" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Registrarse</button>
                            <a href="index.php?ctl=login" class="d-block text-center mt-2 small">Iniciar Sesión</a>
                            <!--  <hr class="my-4">
                            <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Iniciar con Google</button>
                            <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i>Iniciar con Facebook</button> -->
                        </form>
                    </div>
                </div>
                <!-- ERRORES -->
            </div>

        </div>
        <div class="row">
            <div class="" id="errores">
                <?php echo isset($params['msg']) ? $params['msg'] : "" ?>
            </div>
        </div>
    </div>
</body>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="scripts/registry.js"></script>

</html>