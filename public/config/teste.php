<?php 

class Conexao {
    private $db = "site";
    private $user = 'root';
    private $pass = '865358';
    private $end = '127.0.0.1';
        
    public $conexao;

    public function estabelecon(){

        $this->conexao = mysqli_connect($this->end,$this->user,$this->pass,$this->db);
        
        if(!$this->conexao){
            echo ("<script> alert('Estamos tendo problemas técnicos'); </script>");
        }else{
            return $this->conexao;
        }

        
    }
    
}

?> 