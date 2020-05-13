<?php
class Sesiones
{
    protected $usuario;
    protected $nivel;
    protected $id;
    protected $img;
    public function __construct()
    {
        try {
            if (!isset($_SESSION)) {
                session_start();
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
    }

    public function inicioSesion($user, $nv, $id, $img)
    {
        try {
            $_SESSION['user'] = $user;
            $_SESSION['nivel'] = $nv;
            $_SESSION['id'] = $id;
            $_SESSION["img"] = $img;
            $this->usuario = $user;
            $this->nivel = $nv;
            $this->id = $id;
            $this->img = $img;
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
    }
    public function destruir_sesion()
    {
        try {
            session_destroy();
            session_unset();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
    }
    public function caduca()
    {
        try {
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
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
    }
}
