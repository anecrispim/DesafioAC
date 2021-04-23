<?php
	require_once "autoload.php";

	if (isset($_POST["insertVenda"])){

		$venda= new Venda;

		$venda->setQuantidade($_POST["quantidade"]);
		$venda->setIdProduto($_POST["idProduto"]);

		$produto= new Produto;

		$produto->setIdProduto($_POST["idProduto"]);
		$produto->setDataUltimaVenda(date('Y/m/d'));
		
		if (isset($_POST["checkValorUnitario"])){
			$produto->setValorUnitario($_POST["valorUnitario"]);
			echo 
			$produto->setValorTotalVendas($_POST["valorUnitario"] * $_POST["quantidade"]);
			$produto->updateProdutoVendaComValorUnitario();
		}else{
			$valorUnitario = $produto->selectValorUnitario();
			$produto->setValorUnitario($valorUnitario);
			$produto->setValorTotalVendas($valorUnitario * $_POST["quantidade"]);
			$produto->updateProdutoVendaSemValorUnitario();
		}
		$venda->insertVenda();	
		header("Location: form-venda.php?sucesso");
	}
?>