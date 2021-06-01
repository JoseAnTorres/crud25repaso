<?php
session_start();
require_once dirname(__DIR__,2)."/vendor/autoload.php";
use Clases\Hoteles;

$hotel = new Hoteles();
$todos = $hotel->getTodos();
$hotel=null;

require dirname(__DIR__,2)."/plantillas/cabecera.php";
?>
<h3 class="text-center">Hoteles disponibles</h3>
<div class="container mt-3">
<?php
        require dirname(__DIR__,2)."/plantillas/mensajes.php";
    ?>
<a href="create.php" class="btn btn-success mb-2"><i class="fas fa-plus"></i>Nuevo hotel</a>
<table id="example" class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Localidad</th>
      <th scope="col">Direccion</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($fila=$todos->fetch(PDO::FETCH_OBJ)){
    echo <<<CADENA
    <tr>
      <th scope="row">{$fila->id}</th>
      <td>{$fila->nombre}</td>
      <td>{$fila->localidad}</td>
      <td>{$fila->direccion}</td>
      <td>
      <form name='as' action="borrar.php" method="POST" class="form form-inline">
      <a href="update.php?id={$fila->id}" class="btn btn-secondary"><i class="fas fa-edit"></i>Editar</a> 
      <input type="hidden" name="id" value="{$fila->id}">
      <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i> Borrar</button>
      </form>
      </td>
    </tr>
    CADENA;
  }
    ?>
  </tbody>
</table>
</div>
<!--DATA TABLE BOOTSTRAP 5 -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<body>
</html>