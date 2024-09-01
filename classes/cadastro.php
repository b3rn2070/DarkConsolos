<?php 
    require_once 'conexao.php';

    class Cadastro {
        private $conn;
        private $nome;
        private $email;
        private $senha;
        private $cpf;

        function __construct($nome, $email, $senha, $cpf){
            $this->conn = new Conexao("localhost", "root", "", "dark_consolos");
            $this->conn->conectar();

            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->cpf = $cpf;
        }

        function cadastrar(){
            $sql = "INSERT INTO `tbclientes`(`idCli`, `nomeCli`, `emailCli`, `senhaCli`, `cpf`) VALUES (NULL,'$this->nome','$this->email','$this->senha','$this->cpf')";
            $this->conn->execQuery($sql);
            header("Location: login.php");
        }

        function verificarEmail(){
            $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            if(preg_match($pattern, $this->email) == 1) {
                return true;
            } else {
                return false;
            }
        }

        function verificarCpfBD(){
            $sql = "SELECT * FROM `tbclientes` WHERE cpf = '$this->cpf'";
            $resultado = $this->conn->execQuery($sql);
            if($linha = mysqli_fetch_array($resultado)){
                return false;
            } else {
                return true;
            }
        }
    }
?>