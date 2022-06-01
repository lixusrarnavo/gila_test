<?php

include '../Classes/Producto/ProductoController.php';
include '../DB/DB.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$controller = new ProductoController();
$caracteristicas = $controller->getCaracteristicas($id);

echo json_encode($caracteristicas);
