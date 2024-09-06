<?php 
require_once 'conexao.php';

class ADM {
    private $conn;

    function __construct(){
        $this->conn = new Conexao("localhost", "root", "", "dark_consolos");
        $this->conn->conectar();
        
    }

    function logar($email, $senha){
        $sql = "SELECT * FROM `tbfuncionarios` WHERE `emailFunc` = ? AND `ativo` = 1";
        $stmt = $this->conn->getConn()->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if($linha = mysqli_fetch_array($resultado)) {
            if(password_verify($senha, $linha['senhaFunc'])){
                $_SESSION["logadoAdm"] = 1;
                $_SESSION['idFunc'] = $linha['idFunc'];
                $_SESSION['cargo'] = $linha['cargo'];
                echo $_SESSION['logadoAdm'];
                die();

                return true;
                header("Location: index.php");
                
            } else {
                return false;
            }
        }
    }

    function cadastrar($nome, $email, $senha, $cargo){
        $sql = "INSERT INTO `tbfuncionarios`(`idFunc`, `nomeFunc`, `emailFunc`, `senhaFunc`, `ativo`, `cargo`) 
                VALUES (NULL, ?, ?, ?, 1, ?)";
        $stmt = $this->conn->getConn()->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $senha, $cargo);
        $stmt->execute();
        $stmt->close();
        header("Location: ../login.php");
        exit;
    }
}
?>