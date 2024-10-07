<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "./basepaldaca/vendor/autoload.php";
class conexion
{
    public function conectar()
    {
        try {

            $server = "127.0.0.1";
            $user = "admin";
            $password = "123456";
            $database = "paldaca";
            $port = "27017";

            $cadenaConexion = "mongodb://" .
                $user . ":" .
                $password . "@" .
                $server . ":" .
                $port . "/" .
                $database;
            $cliente = new MongoDB\Client($cadenaConexion);
            return $cliente->selectDatabase($database);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}