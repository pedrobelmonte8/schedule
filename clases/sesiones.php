<?php
class Sesiones
{
    protected $usuario;
    protected $nivel;
    protected $id;
    protected $img;
    public function __construct()
    {
        session_start();
    }

    public function inicioSesion($user, $nv, $id, $img)
    {
        $_SESSION['user'] = $user;
        $_SESSION['nivel'] = $nv;
        $_SESSION['id'] = $id;
        $_SESSION["img"] = $img;
        $this->usuario = $user;
        $this->nivel = $nv;
        $this->id = $id;
        $this->img = $img;
    }
    public function destruir_sesion()
    {
        session_destroy();
        session_unset();
    }
    public function caduca()
    {
        // 5 segundos
        $inactividad = 600;
        if (isset($_SESSION["timeout"])) {
            $session = time() - $_SESSION["timeout"];
            if ($session > $inactividad) {
                session_unset($_SESSION);
                session_destroy();
                header('location:index.php?ctl=inicio');
            }
        }
        $_SESSION["timeout"] = time();
    }
}
