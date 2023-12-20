<?php

require 'Conexion.php';

class Superheros extends conexion {
  private $pdo;

  public function __CONSTRUCT() {
    $this->pdo = parent::getConexion();
  }

  public function getByPublisher($publisherId) {
    try {
      $consulta = $this->pdo->prepare("CALL spu_superheroes_por_editor(?)");
      $consulta->bindParam(1, $publisherId, PDO::PARAM_INT);
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $e) {
      die($e->getMessage());
    }
  }

  public function getResumenAlignment(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_resumen_alignment();");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }
}