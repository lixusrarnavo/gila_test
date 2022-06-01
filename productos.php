<?php

include 'Classes/Producto/ProductoController.php';
include 'DB/DB.php';
include 'html/header.html';
include 'html/nav.html';

$controller = new ProductoController();
$productos = $controller->getProductos();
?>
<h3>Productos</h3>
<div class="mt-5">
  <table id="productos" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <th>Nombre</th>
      <th>Sku</th>
      <th>Marca</th>
      <th>Costo</th>
      <th>Categoria</th>
      <th>Caracteristica</th>
      <th>Descripcion</th>
      <th>Margen de ganancia</th>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
<script>
  $(document).ready(function(){
    $('#productos').DataTable({
      "data": <?=json_encode($productos)?>,
      "columns" : [
          { "data" : "nombre" },
          { "data" : "sku" },
          { "data" : "marca" },
          { "data" : "costo" },
          { "data" : "categoria" },
          { "data" : "caracteristica" },
          { "data" : "descripcion" },
          { "data" : "margen"}
      ]
    });
  });
</script>
