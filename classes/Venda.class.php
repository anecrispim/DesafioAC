<?php
require_once "autoload.php";

class Venda extends Produto
{
    private $idVenda, $quantidade;

    public function getIdVenda()
    {
        return $this->idVenda;
    }

    public function setIdVenda($idVenda)
    {
        $this->idVenda = $idVenda;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }
    
    public function insertVenda()
    {
        try {
            $banco = Conexao::getInstance();
            $pdo = $banco->getConexao();
            $stmt = $pdo->prepare('INSERT INTO Venda (quantidade, Produto_idProduto) VALUES( :quantidade, :idProduto)');
            $idProduto= parent::getIdProduto();
            $stmt->bindParam(':quantidade', $this->quantidade);
            $stmt->bindParam(':idProduto', $idProduto);
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

    public function listaVenda(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('SELECT v.quantidade, p.descricao, p.valorunitario, p.valorTotalVendas FROM Venda v
            INNER JOIN produto p ON v.Produto_idProduto = p.idProduto');
        $stmt->execute();
        $produto = $stmt->fetchAll();
        return $produto; 
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }

    public function selectQtdVenda(){
      try {
        $banco= Conexao::getInstance();
        $pdo= $banco->getConexao();
        $stmt = $pdo->prepare('SELECT count(*) AS "totalV" FROM Venda');
        $stmt->execute();
        $produto = $stmt->fetchAll();
        return $produto[0]['totalV']; 
        } catch(PDOException $e) {
          return 'Error: ' . $e->getMessage();
      }
    }
}
