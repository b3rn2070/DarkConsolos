<?php
session_start();
if (isset($_SESSION["logadoAdm"]) && $_SESSION["logadoAdm"] == 1) {
    header("Location: index.php");
}
require_once '../classes/conexao.php';
require_once '../classes/adm.php';
$conn = new Conexao("localhost", "root", "", "dark_consolos"); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<center>
    <h1>Login adm</h1>
    <form action="login.php" method="post">
        <p><input type="text" placeholder="email" name="email" required></p>
        <p><input type="password" placeholder="senha" name="senha" maxlength="16" minlength="8" required></p>
        <p><input type="submit" value="login"></p>
    </form>

    <?php 
        if(isset($_POST['email']) && isset($_POST['senha'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
            $login = new ADM();
            $login->logar($email, $senha);
        }
    ?>
</center>
</body>
</html>