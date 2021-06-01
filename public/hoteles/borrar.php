<?php

if(!isset($_POST['id'])){
    header("location:index.php");
    die();
}

$id=$_POST['id'];

session_start();

require_once dirname(__DIR__,2)."/vendor/autoload.php";
use Clases\Hoteles;
$hotel = new Hoteles();
$hotel->setId($id);
$hotel->delete();
$hotel=null;
$_SESSION['mensajes']="Hotel borrado";
header("Location:index.php");