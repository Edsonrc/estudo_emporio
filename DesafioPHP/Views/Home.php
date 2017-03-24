<?php	
	include_once 'topo.php';
	require_once 'models/Produtos.class.php';        
       $objProd = new Produtos();
?>
<style> 
  .marcado_um a {color:#800000;} 
 </style>
<body>
<section class="container">
	<div class="cabecalho">
		<img src="views/img/logo.jpg" alt="Logo Empresa" title="Logo Empresa"/>
		<hr/>
	</div><!-- / cabecalho-->

	<div class="produtos">
		<?php
		//Função que lista produtos para compra;		
		 $objProd->visualizaProduto();
	    ?>		 		
	</div><!-- / div produtos-->
</section>
	
</body>
</html>

