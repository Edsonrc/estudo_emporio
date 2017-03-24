<?php
     session_start();
    //Sessão para criação de sessão
	if(!isset($_SESSION['carrinho'])){
		$_SESSION['carrinho'] = array();
	}
	//Adiciona Produto
	if (isset($_GET['acao'])) {
		
		//Adicionar Carrinho
		if ($_GET['acao'] == 'add') {
			$id = intval($_GET['id']);
			if (!isset($_SESSION['carrinho'] [$id])){
				$_SESSION['carrinho'] [$id] = 1;
			}else{
				$_SESSION['carrinho'] [$id] += 1;
			}
		}

		//Alterar quantidade
		if ($_GET['acao'] == 'up') {
			if (is_array($_POST['prod'])) {
				foreach ($_POST['prod'] as $id => $qtd) {
					$id = intval($id);
					$qtd = intval($qtd);
					if (!empty($qtd) || $qtd <> 0) {
						$_SESSION['carrinho'][$id] = $qtd;
					}else{
						unset($_SESSION['carrinho'][$id]);
					}
				}
			}
		}
	}

?>

<?php include_once 'topo.php';
      include_once 'models/Carrinho.class.php';
      
      $objCar = new Carrinho();
      ?>

<section class="container">
	<table class="carrinho_compra">
		<caption>Carrinho de Compra<caption><hr/>
			<thead>
				<tr>
					<th width="30">Produto</th>
					<th>Quantidade</th>
					<th>Preço</th>
					<th>Preço Líquido</th>
					<th>Valor do Imposto</th>
					<th>Subtotal</th>
					<th>Remover</th>
				</tr>
	</thead>
	<form action="index.php?pg=Views/carrinho-compra&acao=up" method="post">
     <tfoot>
     	<tr></tr>
     	<tr>
            <td style="border:none;"><input class="btn" type="submit" value="Atualizar Carrinho"</td>     	
     	    <td style="border:none;"><button class="btn"><a href="index.php?pg=Views/home">Continuar Comprando</a></button></td>     
     	</tr>
     </tfoot>
    

     <tbody>
     	<?php
     	//Função responsável pelo carrinho de compra
     	$objCar->carrinho();
     	?>
     	</tr>
     </tbody>		
	</form>
</table>

</body>
</html>
