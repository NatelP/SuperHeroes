<?php

require 'Conexion.php';

class Publisher extends conexion{
  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function getAll(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_publishers_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function getAliPubli($publisherId){
    try{
      $consulta = $this->pdo->prepare("CALL spu_alignment_por_editor(?)");
      $consulta->bindParam(1, $publisherId, PDO::PARAM_INT);
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $e){
      die($e->getMessage());
    }
}

  public function getTotalHeroes($publisherId){
    try{
      $consulta = $this->pdo->prepare("CALL spu_total_heroes_por_editor(?)");
      $consulta->bindparam(1,$publisherId, PDO::PARAM_INT);
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e-getMessage());
    }
  }
}
?>