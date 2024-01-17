<?php

session_start();
require "../Models/Usuario.php";

$usuario = new Usuario();

switch($_REQUEST["Operator"])
{
    case "validar_usuario":
        if (isset($_POST["correo"], $_POST["clave"])
         && !empty($_POST["correo"]) && !empty($_POST["clave"]))
        {
            if ($user = $usuario->ValidarUsuario($_POST["correo"], $_POST["clave"]))
            {
                foreach($user as $campos => $valor)
                {
                    $_SESSION["user"][$campos] = $valor;
                }
                $response = "success";
            }
            else
            {
                $response = "not found";
            }
        }
        else
        {
            $response = "requiere id";
        }

        echo $response;
    break;
    
    case "cerrar_sesion":

        unset($_SESSION["user"]);
        header("location:../");

    break;
}

?>