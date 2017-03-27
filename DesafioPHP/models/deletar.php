<?php
require_once 'Conexao/Conexao.php';
$id = $_GET ['id'];
$acao = $_GET['acao'];

$con = new Conexao();

if ($acao == 'produtos') {
   
                try{
		$cst = $con->conectar()->prepare("DELETE FROM produtos WHERE id_codigo = :id;");
		$cst->bindParam(":id", $id, PDO::PARAM_INT);
		if($cst->execute()){
                     header('location: index.php?pg=Views/cadastra-produtos');
		}else{
		  return 'Erro ao deletar';
		}
		}catch(PDOException $e){
		  return 'Error: '.$e->getMessage();
		}
    
}else{
    try{
		$cst = $con->conectar()->prepare("DELETE FROM taxas WHERE id_imposto = :id;");
		$cst->bindParam(":id", $id, PDO::PARAM_INT);
		if($cst->execute()){
                     header('location: index.php?pg=Views/cadastra-taxas');
		}else{
		  return 'Erro ao deletar';
		}
		}catch(PDOException $e){
		  return 'Error: '.$e->getMessage();
		}
    
}

?>
