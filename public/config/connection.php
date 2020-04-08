<?php 
class BD{

    private $db = "site";
    private $user = 'root';
    private $pass = '865358';
    private $end = '127.0.0.1';
    public $conexao;
    
    function conexao(){
        $this->conexao = mysqli_connect($this->end,$this->user,$this->pass,$this->db);
        return $this->conexao;
    }
}    
?>