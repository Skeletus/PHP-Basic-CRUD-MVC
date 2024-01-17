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
}

?>