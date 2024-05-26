<?php
require_once "models/User.php";
class Login
{
    // Controlador Principal
    public function main() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (empty($_SESSION['session'])) {
                $message = "";
                require_once "views/company/login.view.php";                
            } else {
                header("Location:?c=Dashboard");
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User(
                $_POST['user_email'],
                $_POST['user_pass']
            );
            $user = $user->login();            
            if ($user) {
                $active = $user->getUserState();
                if ($active != 0) {
                    $_SESSION['session'] = $user->getRolName();
                    header("Location:?c=Dashboard");
                } else {
                    $message = "El Usuario NO está activo";
                    require_once "views/company/login.view.php";
                }
            } else {
                $message = "Credenciales incorrectas ó el Usuario NO existe";
                require_once "views/company/login.view.php";
            }
        }
    }
}
