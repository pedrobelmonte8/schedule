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
                        <h5 class="card-title text-center">Configuración</h5>
                        <form id="formModalM">
                            <div class="form-group">
                                <label for="formSettingsUser">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="formSettingsUser" aria-describedby="userHelp" placeholder="Introduce Nombre de Usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="formSettingsEmail">Correo Electrónico</label>
                                <input type="text" class="form-control" id="formSettingsEmail" aria-describedby="emailHelp" placeholder="Introduce Correo Electrónico" required>
                            </div>
                            <div class="form-group">
                                <label for="formSettingsImg">Imagen de Perfil</label>
                                <input type="file" class="form-control" id="formSettingsImg" aria-describedby="imgHelp"  required>
                            </div>
                            <div class="form-group">
                                <label for="formSettingsNotEmail">Notificaciones al Email</label>
                                <input type="checkbox" class="form-control" id="formSettingsNotEmail" aria-describedby="NotEmailHelp" placeholder="Introduce la fecha" min="2000-01-01" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="CheckModalM">
                                <label class="form-check-label" for="CheckModalM">Importante</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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