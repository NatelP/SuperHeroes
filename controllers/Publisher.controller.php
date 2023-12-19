<?php
require_once '../models/Publisher.php';

if(isset($_GET['operacion'])){
  $publisher = new Publisher();

  if($_GET['operacion'] == 'listar'){
    $resultado = $publisher->getAll();
    echo json_encode($resultado);
  } elseif ($_GET['operacion'] == 'getAlignment') {
    if(isset($_GET['publisherId'])) {
      $publisherId = $_GET['publisherId'];
      $resultadoAlineamiento = $publisher->getAliPubli($publisherId);
      echo json_encode($resultadoAlineamiento);
    } else {
      echo json_encode(array('error' => 'No se proporcionó el ID del editor'));
    }
  }
}
?>