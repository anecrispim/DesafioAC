<?php
	require_once "autoload.php";

	if (isset($_POST["insertProduto"])){

		$produto= new Produto;
		$produto->setDescricao($_POST["descricao"]);
		$produto->setValorUnitario($_POST["valorUnitario"]);
		$produto->setEstoque($_POST["estoque"]);
		$produto->setCodigoBarra($_POST["codigoBarra"]);
		$produto->setDeletado(false);
		
		$produto->insertProduto();		
		header("Location: form-produto.html?sucesso");
	}
	if (isset($_POST["editProduto"])){
		$produto= new Produto;
		$produto->setIdProduto($_GET["codigo"]);
		$produto->setDescricao($_POST["descricao"]);
		$produto->setValorUnitario($_POST["valorUnitario"]);
		$produto->setEstoque($_POST["estoque"]);
		$produto->setCodigoBarra($_POST["codigoBarra"]);
		$produto->setDeletado(false);
		
		$produto->updateProduto();		
		header("Location: produtos.php?sucesso");
	}
	if ($_GET["acao"] == "excluir"){
		$produto= new Produto;
		$produto->setIdProduto($_GET["codigo"]);
		echo $produto->getIdProduto();
		
		echo $_GET["acao"];

		$produto->setDeletado(true);

		$produto->updateProdutoLixeira();		
		header("Location: produtos.php?sucesso");
	}
	if ($_GET["acao"] == "restaurar"){
		$produto= new Produto;
		$produto->setIdProduto($_GET["codigo"]);
		echo $produto->getIdProduto();
		
		echo $_GET["acao"];

		$produto->setDeletado(false);

		$produto->updateProdutoLixeira();		
		header("Location: produtos-excluidos.php?sucesso");
	}
?>