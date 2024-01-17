<?php
class Connection
{
    static function ConnectDB()
    {
        try
        {
            require "Global.php";
            $con = new PDO(DataSourceName, Username, Password);

            return $con;
        }
        catch (PDOException $ex)
        {
            die ("". $ex->getMessage());
        }
    }
}
?>