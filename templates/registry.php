<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/registry.css">
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
                        <h5 class="card-title text-center">Registro</h5>
                        <form class="form-signin">
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                                <label for="inputEmail">Email</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                                <label for="inputPassword">Contraseña</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="inputRepPassword" class="form-control" placeholder="Repetir Contraseña" required>
                                <label for="inputRepPassword">Repetir Contraseña</label>
                            </div>
                            <div class="form-label-group">
                                <input type="file" id="inputRepPassword" class="form-control" placeholder="Repetir Contraseña" required>
                            </div>
                            
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Registrarse</button>
                            <a href="index.php?ctl=login" class="d-block text-center mt-2 small">Iniciar Sesión</a>
                            <hr class="my-4">
                            <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Iniciar con Google</button>
                            <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i>Iniciar con Facebook</button>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>