<?php 
    require_once 'conexao.php';
    
    class Login {
        private $conn;
        private $email;
        private $senha;
        private $nome;
        private $id;
        private $logado;

        function __construct($email, $senha){
            $this->conn = new Conexao("localhost", "root", "", "dark_consolos");
            $this->conn->conectar();

            $this->email = $email;
            $this->senha = $senha;
            $this->logado = 0;
        }

        function logar(){
            $sql = "SELECT * FROM `tbclientes` WHERE `emailCli` = '$this->email';";
            $resultado = $this->conn->execQuery($sql);

            if($linha = mysqli_fetch_array($resultado)) {
                if(password_verify($this->senha, $linha['senhaCli'])){
                    $this->nome = $linha["nomeCli"];
                    $this->id = $linha["idCli"];
                    $this->logado = 1;
    
                    $_SESSION["logado"] = 1;
                    $_SESSION['idCliente'] = $linha['idCli'];    
                    header("Location: index.php");
                } 
            } else {
                echo "Usuário e/ou senha inválidos";
            }
        }

        function getNome(){
            return $this->nome;
        }

        function getId(){
            return $this->id;
        }

        function isLogado(){
            return $this->logado;
        }

        function deslogar(){
            $this->logado = 0;
        }
    }
?>