<?php
/**
 * @author Edson Ricardo Czarneski
 */
include_once 'Conexao/Conexao.php';
class Produtos {
    
    public function __construct(){
        $this->con = new Conexao();
    }
      public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function __get($atributo){
        return $this->$atributo;
    }
    
    function visualizaProduto(){        
     $consulta = $this->con->conectar()->prepare("SELECT * FROM produtos ");
     $consulta->execute();
   
   foreach($consulta as $linha) { 

                  echo '<ul class="itens">';
                  echo '<li>';
                  echo '<p><img src="views/img/foto_generica.jpg" alt="Empório:Foto Genérica" title="Empório: Foto Genérica"></p>';
                  echo '<p>'.$linha['nome'].'</p>';
                  echo '<p>R$ '.$linha['preco_liquido'].'</p>';
                  echo '<button class="btn"><a href="index.php?pg=Views/carrinho-compra&acao=add&id='.$linha['id_codigo'].'">Comprar</a></button>';                   
                  echo '</li>';    
                  echo '</ul>';
         } 

    }
    
//função para cadastro e exibição de produtos
function produtoCadastrado(){   
      $registra = $this->con->conectar()->prepare("SELECT * FROM produtos ORDER BY id_codigo");
      $registra->execute(); 
      
      foreach($registra as $linha) { 
          $tipoP = $linha['tipo'];
           switch ($tipoP){
                     case 1:
                     $tipoP = "Alimento e Bebida";
                     break;
                     case 2:
                     $tipoP = "Eletroeletrônico";
                     break;
                     case 3:
                     $tipoP = "Medicamentos";
                     break;
                     case 4:
                     $tipoP = "Produtos de Limpeza";
                     break;
                     case 5:
                     $tipoP = "Vestuário";
                     
            }
                  echo '<tr>';
                  echo '<td>'.$linha['id_codigo'].'</td>';
                  echo '<td style="width:120px">'.$linha['nome'].'</td>';
                  echo '<td style="width:120px">'.$tipoP.'</td>';
                  echo '<td>'.$linha['un_medida'].'</td>';
                  echo '<td>R$ '.$linha['preco_liquido'].'</td>';                 
                  echo '<td><a href="index.php?pg=Views/cadastra-produtos&acao=delet&id='.$linha['id_codigo'].'" title="Excluir esse dado"><img src="views/img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></td>'; 
                  echo '<input type="hidden" id="action" name="action" />';
                  echo '</tr>';
      }
}

function cadastraProduto($dados){
    if (isset($_POST['cadastrar'])) {
         try{
            $this->id_codigo = $dados['codigo'];
            $this->nome      = $dados['desc'];
            $this->tipo      = $dados['opcao'];
            $this->un_medida = $dados['un'];
            $this->preco_liquido = strip_tags(trim($dados['preco']));
            $this->indice_taxa   = $dados['opcao'];
                
            $registra = $this->con->conectar()->prepare("INSERT INTO produtos (id_codigo, un_medida, tipo, indice_taxa, nome, preco_liquido) VALUES (:id_codigo, :un_medida, :tipo, :indice_taxa, :nome, :preco_liquido);");          
            $registra->bindParam(":id_codigo", $this->id_codigo, PDO::PARAM_INT);
            $registra->bindParam(":un_medida", $this->un_medida, PDO::PARAM_STR);
            $registra->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            $registra->bindParam(":indice_taxa", $this->indice_taxa, PDO::PARAM_STR);
            $registra->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $registra->bindParam(":preco_liquido", $this->preco_liquido, PDO::PARAM_STR);    
             if($registra->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
           
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }  
        
    }
}

function deletaProduto($dado){
    
    try{
		$this->id = $this->$dado;
		$cst = $this->con->conectar()->prepare("DELETE FROM produtos WHERE id_codigo = :id;");
		$cst->bindParam(":id", $this->id, PDO::PARAM_INT);
		if($cst->execute()){
		  return 'ok';
		}else{
		  return 'Erro ao deletar';
		}
		}catch(PDOException $e){
		  return 'Error: '.$e->getMessage();
		}
}

}

                  
                