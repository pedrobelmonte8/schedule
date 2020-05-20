<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="libs\bootstrap-4.4.1-dist\css\bootstrap.css">
    <script src="https://kit.fontawesome.com/32099913fe.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Iniciar Sesión</h5>
                        <form class="form-signin" method="POST">
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="logEmail" autofocus required>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" name="logPass" required>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <!--   <label class="custom-control-label" for="customCheck1">Recordar contrseña</label> -->
                            </div>

                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="inputLogin">Iniciar sesión</button>
                            <!-- Link hacia el registro -->
                            <a href="index.php?ctl=registry" class="d-block text-center mt-2 small">Registro</a>
                            <hr class="my-4">
                            <button class="btn btn-lg btn-google btn-block text-uppercase" href="google.es" name="btnGoogle" disabled><i class="fab fa-google mr-2"></i> Iniciar con Google</button>
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
</body>

</html>