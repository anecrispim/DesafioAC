<?php
require_once('config/config.ini.php');
class Conexao{
  private $conexao;
  private static $instance;

  private function __construct(){
    try{
      $this->conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
    }catch (PDOException $e){
      print('Erro ao conectar com o Banco de Dados: '.$e->getMessage());
    }
  }
  public static function getInstance(){
    if (empty(self::$instance)){ // verifica se o atributo instancia tá vazio ->usa o self sempre que for um atributo estático
      self::$instance = new self ();
    }
    return self::$instance;
  }
  public function getConexao(){
    return $this->conexao;
  }
}
?>