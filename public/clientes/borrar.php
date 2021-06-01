<?php

if(!isset($_POST['id'])){
    header("location:index.php");
    die();
}

$id=$_POST['id'];

session_start();

require_once dirname(__DIR__,2)."/vendor/autoload.php";
use Clases\Clientes;
$cli = new Clientes();
$cli->setId($id);
$cli->delete();
$cli=null;
$_SESSION['mensajes']="Cliente borrado";
header("Location:index.php");