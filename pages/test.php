<?php
require "Models/Usuario.php";

$usuario = new Usuario();

$n_doc = "123456";
$nombre = "Adrian";
$apellidos = "Perez";
$correo = "adrianpinado@gmail.com";
$clave = "123456";

/* test - registro de usuario
if($usuario->RegistrarUsuario($n_doc, $nombre, $apellidos, $correo, $clave))
{
    echo "Registro exitoso";
}
else
{
    echo "Error";
}
*/

if ($usuario->ValidarUsuario($correo, $clave))
{
    echo "usuario encontrado";
}
else
{
    echo "no encontrado";
}

?>