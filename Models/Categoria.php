<?php

require "../config/Connection.php";

class Categoria
{
    public $con;

    function __construct()
    {
        $this->con = Connection::ConnectDB();
    }

    /// <summary>
    /// Function to list all rows in table Categoria
    /// </summary>
    function ListarCategorias()
    {
        $query = "SELECT * FROM categoria";
        $result = $this->con->prepare($query);
        if($result->execute())
        {
            if($result->rowCount() > 0)
            {
                while($row = $result->fetch(PDO::FETCH_ASSOC))
                {
                    $datos[] = $row;
                }
                return $datos;
            }
        }
        return false;
    }

    /// <summary>
    /// Function to create a new Categoria
    /// </summary>
    function RegistrarCategoria($nombre, $descripcion)
    {
        $query = "INSERT INTO categoria(nombre, descripcion) VALUES (?, ?)";
        $result = $this->con->prepare($query);
        $result->bindParam(1,$nombre);
        $result->bindParam(2,$descripcion);
        if($result->execute())
        {
            return true;
        }
        return false;
    }

    /// <summary>
    /// Function to get Categoria by ID
    /// </summary>
    function ObtenerCategoriaPorID($categoria_id)
    {
        $query = "SELECT * FROM categoria WHERE categoria_id = ?";
        $result = $this->con->prepare($query);
        $result->bindParam(1,$categoria_id);
        if($result->execute())
        {
            return $result->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    /// <summary>
    /// Function to get Categoria by ID
    /// </summary>
    function ActualizarCategoria($categoria_id, $nombre, $descripcion)
    {
        $query = "UPDATE categoria SET nombre=?, descripcion=? WHERE categoria_id = ?";
        $result = $this->con->prepare($query);
        $result->bindParam(1,$nombre);
        $result->bindParam(2,$descripcion);
        $result->bindParam(3,$categoria_id);
        if($result->execute())
        {
            return true;
        }
        return false;

    }

}

?>