<?php
session_start();

require_once dirname(__DIR__,2)."/vendor/autoload.php";
use Clases\Hoteles;

function mostrarError($txt){
    $_SESSION['errores']=$txt;
    header("Location:{$_SERVER['PHP_SELF']}");
}

 if(isset($_POST['enviar'])){
     //procesamos formulario
     $n=ucwords((trim($_POST['nombre'])));
     $l=ucwords((trim($_POST['localidad'])));
     $d=trim($_POST['direccion']);
     if(strlen($n)==0 || strlen($l)==0 || strlen($d)==0){
         mostrarError("Rellene los campos");
     }
     $hotel = new Hoteles();
     $hotel->setNombre($n);
     $hotel->setLocalidad($l);
     $hotel->setDireccion($d);
     $hotel->create();

     $hotel=null;
     $_SESSION['mensajes']="Hotel creado";
     header("Location:index.php");
 }
 else{
     //pintamos el formulario
     require dirname(__DIR__,2)."/plantillas/cabecera.php";
?>
    <h3 class="text-center">Nuevo hotel</h3>
    <?php
        require dirname(__DIR__,2)."/plantillas/errores.php";
    ?>
    <div class="container mt-3">
    <form name="n" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="input-group flex-nowrap mb-2">
        <span class="input-group-text" id="addon-wrapping">Nombre</span>
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" aria-label="Username" aria-describedby="addon-wrapping">
    </div>

    <div class="input-group flex-nowrap mb-2">
        <span class="input-group-text" id="addon-wrapping">Localidad</span>
        <input type="text" name="localidad" class="form-control" placeholder="Localidad" aria-label="Username" aria-describedby="addon-wrapping">
    </div>

    <div class="input-group flex-nowrap mb-2">
        <span class="input-group-text" id="addon-wrapping">Direccion</span>
        <input type="text" name="direccion" class="form-control" placeholder="Direccion" aria-label="Username" aria-describedby="addon-wrapping">
    </div>
    <div class="mb-2">
        <button type="submit" name="enviar" class="btn btn-info"><i class="fa fa-save"></i>Enviar</button>
        <button type="reset" name="resetear" class="btn btn-warning"><i class="fas fa-eraser"></i>Borrar</button>
        <a href="index.php" class="btn btn-primary mr-2">Volver</a>
    </div>
    </form>
    </div>
    </body>
    </html>
    <?php } ?>