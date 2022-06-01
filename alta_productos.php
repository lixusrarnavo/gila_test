<?php

include 'Classes/Producto/ProductoController.php';
include 'Classes/Producto/Producto.php';
include 'DB/DB.php';
include 'html/header.html';
include 'html/nav.html';

$controller = new ProductoController();
$categorias = $controller->getCategorias();
$caracteristicas = $controller->getCaracteristicas($categorias[0]['id']);

if (!empty($_POST)) {
  $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
  $sku = filter_input(INPUT_POST, 'sku', FILTER_SANITIZE_STRING);
  $marca = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_STRING);
  $costo = filter_input(INPUT_POST, 'costo', FILTER_SANITIZE_NUMBER_FLOAT);
  $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
  $caracteristica = filter_input(INPUT_POST, 'caracteristica', FILTER_SANITIZE_NUMBER_INT);
  $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);

  $product = new Producto();
  $product->setNombre($nombre);
  $product->setSku($sku);
  $product->setMarca($marca);
  $product->setCosto($costo);
  $product->setIdCategoria($categoria);
  $product->setIdCaracteristica($caracteristica);
  $product->setDescripcion($descripcion);

  $db = new DB();
  $db->insertProducto(
    $product->getNombre(),
    $product->getSku(),
    $product->getMarca(),
    $product->getCosto(),
    $product->getIdCategoria(),
    $product->getIdCaracteristica(),
    $product->getDescripcion()
  );
}
?>

<h3>Alta Productos</h3>
<form id="alta_productos" method="post">
  <div class="row">
    <div class="col-3">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" id="nombre" class="form-control">
    </div>
  </div>
  <div class="row">
    <div class="col-3">
      <label for="sku">Sku</label>
      <input type="text" name="sku" id="sku" class="form-control">
    </div>
  </div>
  <div class="row">
    <div class="col-3">
      <label for="marca">Marca</label>
      <input type="text" name="marca" id="marca" class="form-control">
    </div>
  </div>
  <div class="row">
    <div class="col-3">
      <label for="costo">Costo</label>
      <input type="text" name="costo" id="costo" class="form-control">
    </div>
  </div>
  <div class="row">
    <div class="col-3">
      <label for="categoria">Categoria</label>
      <select id="categoria" name="categoria" class="form-control">
        <?php
          foreach($categorias as $categoria) {
            echo "<option value=" . $categoria['id'] . ">" . $categoria['descripcion'] . "</option>";
          }
        ?>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-3">
      <label for="caracteristica">Caracteristica</label>
      <select id="caracteristica" name="caracteristica" class="form-control">
        <?php
          foreach($caracteristicas as $caracteristica) {
            echo "<option value=" . $caracteristica['id'] . ">" . $caracteristica['descripcion'] . "</option>";
          }
        ?>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-3">
      <label for="descripcion">Descripcion</label>
      <input type="text" id="descripcion" name="descripcion" class="form-control">
    </div>
  </div>
  <input type="submit" class="btn btn-primary">
</form>
<script>
  $(document).ready(function() {
    $('#categoria').on('change', function() {
      $.ajax({
        url: 'ajax/get_caracteristicas.php',
        data: {
          id: $(this).val()
        },
        method: 'post',
        success: function(data) {
          data = JSON.parse(data);
          $('#caracteristica').empty();
          for (i = 0; i < data.length; i++) {
            $option = $('<option></option>');
            $option.attr('value', data[i]['id']);
            $option.text(data[i]['descripcion']);
            $('#caracteristica').append($option);
          }
        }
      })
    });
  });
</script>
