<?php
namespace Clases;

use PDO;
use PDOException;

class Conexion{
    protected static $conexion;

    public function __construct()
    {
        if(self::$conexion==null){
            self::crearConexion();
        }
    }

    public static function crearConexion(){
        //leemos .config
        $opciones=parse_ini_file(dirname(__DIR__)."/.config");
        $base=$opciones['database'];
        $user=$opciones['user'];
        $pass=$opciones['pass'];
        $host=$opciones['host'];
        //creamos dns
        $dns = "mysql:host=$host; dbname=$base; charset=utf8mb4";
        //creamos conexion
        try{
            self::$conexion=new PDO($dns, $user, $pass);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $ex){
            die("Error al conectar a la bbdd ".$ex->getMessage());
        }
    }
}