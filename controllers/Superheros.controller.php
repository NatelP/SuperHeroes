<?php
require_once '../models/Superheros.php';

if(isset($_GET['operacion'])){
  $superhero = new Superheros();

  if($_GET['operacion'] == 'listar'){
    if(isset($_GET['publisher'])) {
      $publisherId = $_GET['publisher'];
      $resultado = $superhero->getByPublisher($publisherId);
    } else {
      $resultado = $superhero->getAll();
    }
    echo json_encode($resultado);
  }
}

if (isset($_GET['operacion'])){
  $superhero = new Superheros();

  if ($_GET['operacion'] == 'getResumenAlignment'){
    echo json_encode($superhero->getResumenAlignment());
  }
}

?>