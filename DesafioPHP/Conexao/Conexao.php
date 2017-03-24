<?php

class Conexao {
    private $usuario;
    private $senha;
    private $banco;
    private $servidor; 
    private $porta;
    private static $pdo;
    //Método construtor conexao
    public function __construct() {
        $this->servidor = "localhost";
        $this->banco = "emporio";
        $this->usuario = "czarneski";
        $this->senha = "2308404"; 
        $this->porta = "5432";
    }
    //Método para conexão
    public function conectar(){
        try {
            //verificando se atributo pdo está estanciado
            if (is_null(self::$pdo)) {
                //Estanciando conexao
                self::$pdo = new PDO("pgsql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
                
            }
            return self::$pdo;// se já estiver estanciado, retorna.
            
        } catch (PDOException $ex) {
            
        }
    }
}
    
