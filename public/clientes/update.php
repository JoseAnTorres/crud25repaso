<?php

if(!isset($_GET['id'])){
    header("location:index.php");
    die();
}

$id=$_GET['id'];

session_start();

require_once dirname(__DIR__,2)."/vendor/autoload.php";
use Clases\Clientes;

function mostrarError($txt){
    global $id;
    $_SESSION['errores']=$txt;
    header("Location:{$_SERVER['PHP_SELF']}?id=$id");
}

$cli = new Clientes();
$datos = $cli->read($id);

 if(isset($_POST['editar'])){
     //procesamos formulario
     $n=ucwords((trim($_POST['nombre'])));
     $a=ucwords((trim($_POST['apellidos'])));
     $e=trim($_POST['email']);
     if(strlen($n)==0 || strlen($a)==0){
         mostrarError("Rellene los campos");
     }
     $cliente = new Clientes();
     if($cliente->existeEmail($e, $id)){
         mostrarError("El correo ya existe");
     }

     $cliente->setNombre($n);
     $cliente->setApellidos($a);
     $cliente->setEmail($e);
     $cliente->setId($id);
     $cliente->update();

     $cliente=null;
     $_SESSION['mensajes']="Cliente actualizado";
     header("Location:index.php");
 }
 else{
     //pintamos el formulario
     require dirname(__DIR__,2)."/plantillas/cabecera.php";
?>
    <h3 class="text-center">Nuevo cliente</h3>
    <?php
        require dirname(__DIR__,2)."/plantillas/errores.php";
    ?>
    <div class="container mt-3">
    <form name="n" action="<?php echo $_SERVER['PHP_SELF']."?id=$id" ?>" method="POST">
    <div class="input-group flex-nowrap mb-2">
        <span class="input-group-text" id="addon-wrapping">Nombre</span>
        <input type="text" name="nombre" class="form-control" value="<?php echo $datos->nombre; ?>" aria-label="Username" aria-describedby="addon-wrapping">
    </div>

    <div class="input-group flex-nowrap mb-2">
        <span class="input-group-text" id="addon-wrapping">Apellidos</span>
        <input type="text" name="apellidos" class="form-control" value="<?php echo $datos->apellidos; ?>" aria-label="Username" aria-describedby="addon-wrapping">
    </div>

    <div class="input-group flex-nowrap mb-2">
        <span class="input-group-text" id="addon-wrapping">Email</span>
        <input type="text" name="email" class="form-control" value="<?php echo $datos->email; ?>" aria-label="Email" aria-describedby="addon-wrapping">
    </div>
    <div class="mb-2">
        <button type="submit" name="editar" class="btn btn-info"><i class="fa fa-edit"></i>Editar</button>
        <button type="reset" name="resetear" class="btn btn-warning"><i class="fas fa-eraser"></i>Borrar</button>
        <a href="index.php" class="btn btn-primary mr-2">Volver</a>
    </div>
    </form>
    </div>
    </body>
    </html>
    <?php } ?>