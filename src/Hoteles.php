<?php
namespace Clases;

use Hamcrest\Type\IsString;
use PDOException;
use PDO;

class Hoteles extends Conexion{
    private $id, $nombre, $localidad, $direccion;
    

    public function __construct()
    {
        parent::__construct();
    }

    //CRUD---------------------------------------------------
    public function create(){
        $c="insert into hoteles(nombre, localidad, direccion) values(:n, :l, :d)";
        $stmt=parent::$conexion->prepare($c);

        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':l'=>$this->localidad,
                ':d'=>$this->direccion
            ]);
        }catch(PDOException $ex){
            die("Error al insertar en hoteles: ".$ex->getMessage());
        }
    }

    public function update(){
        $c="update hoteles set nombre=:n , localidad=:l , direccion=:d where id=:i";
        $stmt=parent::$conexion->prepare($c);

        try{
            $stmt->execute([
                ':i'=>$this->id,
                ':n'=>$this->nombre,
                ':l'=>$this->localidad,
                ':d'=>$this->direccion
            ]);
        }catch(PDOException $ex){
            die("Error al encontrar actualizar: ".$ex->getMessage());
        }
    }

    public function read($id){
        $c="select * from hoteles where id=:i";
        $stmt=parent::$conexion->prepare($c);

        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al encontrar id: ".$ex->getMessage());
        }
        $fila=$stmt->fetch(PDO::FETCH_OBJ);
        return $fila;
    }

    public function delete(){
        $c="delete from hoteles where id=:i";
        $stmt=parent::$conexion->prepare($c);

        try{
            $stmt->execute([
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar hotel: ".$ex->getMessage());
        }
    }

    public function deleteAll(){
        $c="delete from hoteles";
        $stmt=parent::$conexion->prepare($c);

        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al borrar todo: ".$ex->getMessage());
        }
    }

    public function getTodos(){
        $c="select * from hoteles order by nombre, localidad";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al devolver hoteles");
        }
        return $stmt;
    }

    public function existeNombre($n, $id=-100){
        if($id>0)
            $c = "select * from hoteles where nombre='$n' AND id!=$id";
        else
            $c = "select * from hoteles where nombre='$n'";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al encontrar");
        }
        $fila=$stmt->fetch(PDO::FETCH_OBJ);
        return ($fila) ? true:false;
    }

 /*
public function existeNombre($n, $id=-100){
    if($id>0){
        $c = "select * from hoteles where nombre=:n AND id!=:i";
        $var=[':n'=>$n, ':i'=>$id];
    }
    else{
        $c = "select * from hoteles where nombre=:n";
        $var=[':n'=>$n];
    }
    $stmt=parent::$conexion->prepare($c);
    try{
        $stmt->execute($var);
    }catch(PDOException $ex){
        die("Error al encontrar");
    }
    $fila=$stmt->fetch(PDO::FETCH_OBJ);
    return ($fila) ? true:false;
}
*/

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of localidad
     */ 
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set the value of localidad
     *
     * @return  self
     */ 
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }
}