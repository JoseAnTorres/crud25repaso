<?php
session_start();
require_once dirname(__DIR__,2)."/vendor/autoload.php";
use Clases\Clientes;

$cli = new Clientes();
$todos = $cli->getTodos();
$cli=null;

require dirname(__DIR__,2)."/plantillas/cabecera.php";
?>
<h3 class="text-center">Clientes registrados</h3>
<div class="container mt-3">
<?php
        require dirname(__DIR__,2)."/plantillas/mensajes.php";
    ?>
<a href="create.php" class="btn btn-success mb-2"><i class="fas fa-plus"></i>Nuevo clientes</a>
<table id="example" class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Apellidos, nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($fila=$todos->fetch(PDO::FETCH_OBJ)){
    echo <<<CADENA
    <tr>
      <th scope="row">{$fila->id}</th>
      <td>{$fila->apellidos}, {$fila->nombre}</td>
      <td>{$fila->email}</td>
      <td>
      <a href="update.php?id={$fila->id}" class="btn btn-secondary"><i class="fas fa-edit"></i>Editar cliente</a> 
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