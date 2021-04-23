<?php
require_once "autoload.php";

class Produto
{
    private $idProduto, $descricao, $valorUnitario, $estoque, $codigoBarra, $deletado, $dataUltimaVenda, $valorTotalVendas;

    public function getIdProduto()
    {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }

    public function setValorUnitario($valorUnitario)
    {
        $this->valorUnitario = $valorUnitario;
    }

    public function getEstoque()
    {
        return $this->estoque;
    }

    public function setEstoque($estoque)
    {
        $this->estoque = $estoque;
    }

    public function getCodigoBarra()
    {
        return $this->codigoBarra;
    }

    public function setCodigoBarra($codigoBarra)
    {
        $this->codigoBarra = $codigoBarra;
    }

    public function getDeletado()
    {
        return $this->deletado;
    }

    public function setDeletado($deletado)
    {
        $this->deletado = $deletado;
    }

    public function getDataUltimaVenda()
    {
        return $this->dataUltimaVenda;
    }

    public function setDataUltimaVenda($dataUltimaVenda)
    {
        $this->dataUltimaVenda = $dataUltimaVenda;
    }

    public function getValorTotalVendas()
    {
        return $this->valorTotalVendas;
    }

    public function setValorTotalVendas($valorTotalVendas)
    {
        $this->valorTotalVendas = $valorTotalVendas;
    }
    
    public function insertProduto()
    {
        try {
            $banco = Conexao::getInstance();
            $pdo = $banco->getConexao();
            $stmt = $pdo->prepare('INSERT INTO Produto (descricao, valorUnitario, estoque, codigoBarra, deletado) VALUES( :descricao, :valorUnitario, :estoque, :codigoBarra, :deletado)');
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':valorUnitario', $this->valorUnitario);
            $stmt->bindParam(':estoque', $this->estoque);
            $stmt->bindParam(':codigoBarra', $this->codigoBarra);
            $stmt->bindParam(':deletado', $this->deletado);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                var_dump($stmt->errorInfo());
            } else {
                return true;
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }



  public function updateProduto(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('UPDATE Produto SET descricao = :descricao, valorUnitario = :valorUnitario, estoque = :estoque, codigoBarra = :codigoBarra, deletado = :deletado WHERE idProduto = :idProduto');
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':valorUnitario', $this->valorUnitario);
        $stmt->bindParam(':estoque', $this->estoque);
        $stmt->bindParam(':codigoBarra', $this->codigoBarra);
        $stmt->bindParam(':deletado', $this->deletado);
        $stmt->bindParam(':idProduto', $this->idProduto);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
          var_dump($stmt->errorInfo());
        }else{
          return true;
        }
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }

    public function listaProduto(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('SELECT * FROM Produto WHERE deletado = false');
        $stmt->execute();
        $produto = $stmt->fetchAll();
        return $produto; 
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }

    public function updateProdutoLixeira(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('UPDATE Produto SET deletado = :deletado WHERE idProduto = :idProduto');
        $stmt->bindParam(':deletado', $this->deletado);
        $stmt->bindParam(':idProduto', $this->idProduto);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
          var_dump($stmt->err());
        }else{
          return true;
        }
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }
    public function listaProdutoLixeira(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('SELECT * FROM Produto WHERE deletado = true');
        $stmt->execute();
        $produto = $stmt->fetchAll();
        return $produto; 
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }
    public function selectValorUnitario(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('SELECT valorUnitario FROM Produto WHERE idProduto = :idProduto');
        $stmt->bindParam(':idProduto', $this->idProduto);
        $stmt->execute();
        $produto = $stmt->fetchAll();
        return $produto[0]['valorUnitario']; 
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }
    public function updateProdutoVendaSemValorUnitario(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('UPDATE Produto SET valorTotalVendas = :valorTotalVendas, dataUltimaVenda = :dataUltimaVenda WHERE idProduto = :idProduto');
        $stmt->bindParam(':valorTotalVendas', $this->valorTotalVendas);
        $stmt->bindParam(':dataUltimaVenda', $this->dataUltimaVenda);
        $stmt->bindParam(':idProduto', $this->idProduto);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
          var_dump($stmt->errorInfo());
        }else{
          return true;
        }
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }
    public function updateProdutoVendaComValorUnitario(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('UPDATE Produto SET valorUnitario = :valorUnitario, valorTotalVendas = :valorTotalVendas, dataUltimaVenda = :dataUltimaVenda WHERE idProduto = :idProduto');
        $stmt->bindParam(':valorUnitario', $this->valorUnitario);
        $stmt->bindParam(':valorTotalVendas', $this->valorTotalVendas);
        $stmt->bindParam(':dataUltimaVenda', $this->dataUltimaVenda);
        $stmt->bindParam(':idProduto', $this->idProduto);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
          var_dump($stmt->errorInfo());
        }else{
          return true;
        }
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }

    public function selectQtdProduto(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('SELECT count(*) AS "totalP" FROM Produto');
        $stmt->execute();
        $produto = $stmt->fetchAll();
        return $produto[0]['totalP']; 
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }
}
