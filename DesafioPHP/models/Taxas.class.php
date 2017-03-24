<?php
/**
 * Description of Produtos
 *
 * @author Edson Ricardo Czarneski
 */
include_once 'Conexao/Conexao.php';
class Taxas {
    
    public function __construct(){
        $this->con = new Conexao();
    }
      public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function __get($atributo){
        return $this->$atributo;
    }
    
   
    //função para cadastro e exibição de produtos
function visualizaTaxa(){   
      $registra = $this->con->conectar()->prepare("SELECT * FROM taxas");
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
                echo '<td>'.$linha['id_imposto'].'</td>';
                echo '<td style="width:200px">'.$tipoP.'</td>';
                echo '<td>'.number_format($linha['imposto'],2,",","").' %</td>';                    
                echo '<td><a href="index.php?pg=views/delete&id='.$linha['id_imposto'].'&action=taxas" title="Excluir esse dado"><img src="views/img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></td>';  
                echo "</tr>";
      }
}

function cadastraTaxa($dados){
    if (isset($_POST['cadastrar'])) {
         try{
            $this->tipo    = $dados['opcao'];
            $this->imposto = $dados['imposto'];
                
            $registra = $this->con->conectar()->prepare("INSERT INTO taxas (tipo, imposto) VALUES (:tipo, :imposto);");                
            $registra->bindParam(":tipo", $this->tipo, PDO::PARAM_INT);
            $registra->bindParam(":imposto", $this->imposto, PDO::PARAM_STR);            
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

}
                
                
             
                         
   
