<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/notifications.css">
    <link rel="stylesheet" href="libs\bootstrap-4.4.1-dist\css\bootstrap.css">
    <script src="https://kit.fontawesome.com/32099913fe.js" crossorigin="anonymous"></script>
    <title>Notificaciones</title>
</head>

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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body cuerpoNotificaciones">
                        <h5 class="card-title text-center">Notificaciones</h5>
                        <!-- Listas -->
                        <ul class="list-group list-group-flush">
                           <!--  <li data-id="" class="list-group-item"><div class="d-flex justify-content-between"><div>Título</div><div>22-05-2020 <i class="fas fa-trash-alt"></i></div></div></li>
                            <li data-id="" class="list-group-item"><div class="d-flex justify-content-between"><div>Título</div><div>23-05-2020 <i class="fas fa-trash-alt"></i></div></div></li>
                            <li data-id="" class="list-group-item"><div class="d-flex justify-content-between"><div>Título</div><div>22-05-2020 <i class="fas fa-trash-alt"></i></div></div></li>
                            <li data-id="" class="list-group-item"><div class="d-flex justify-content-between"><div>Título</div><div>23-05-2020 <i class="fas fa-trash-alt"></i></div></div></li>
                            --> <?php echo isset($params["notificaciones"]) ? $params["notificaciones"] : "No hay notificaciones" ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="scripts/notifications.js"></script>
</body>

</html>