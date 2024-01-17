<?php

require "../config/Connection.php";

class Usuario
{
    public $con;

    function __construct()
    {
        $this->con = Connection::ConnectDB();
    }

    function RegistrarUsuario($n_doc, $nombre, $ape, $correo, $clave)
    {
        $query = "INSERT INTO usuarios(n_documento, nombre, apellidos, correo, clave) VALUES (?, ?, ?, ?, ?)";
        $result = $this->con->prepare($query);

        $result->bindParam(1, $n_doc);
        $result->bindParam(2, $nombre);
        $result->bindParam(3, $ape);
        $result->bindParam(4, $correo);
        $HashedClave = password_hash($clave, PASSWORD_DEFAULT);
        $result->bindParam(5, $HashedClave);

        if($result->execute())
        {
            return true;
        }
        return false;

    }

    function ValidarUsuario($correo, $clave)
    {
        $query = "SELECT * FROM usuarios WHERE correo = ? ";
        $result = $this->con->prepare($query);
        $result->bindParam(1,$correo);
        $result->execute();
        $fila = $result->fetch();
        if ($fila !== false && password_verify($clave, $fila["clave"])) {
            return $fila;
        }
            return false;

    }
}

?>