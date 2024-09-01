<?php
session_start();
require_once 'classes/conexao.php';

$conn = new Conexao("localhost", "root", "", "dark_consolos");
$conn->conectar();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Consolos</title>
</head>

<body>
    <div>
        <form action="carrinho.php" method="post"><input type="submit" value="carrinho"></form>
        <?php 
            if((isset($_SESSION['logado'])) && ($_SESSION['logado'] == 1) ){
                ?> <form action="sair.php" method="post"> <input type="submit" value="deslogar"> </form> <?php
            }
        ?>
        <?php
        // produtos em promocao

        $sql = "SELECT * FROM `tbproduto` WHERE `ativo` = 1 AND `promocao` = 1";
        $resultado = $conn->execQuery($sql);

        if ($resultado) {
            while ($linha = mysqli_fetch_array($resultado)) {
                echo "<a href=\"mostrarProduto.php?idProd=" . $linha["idProd"] . "\"><img src='images/" . $linha["fotoProd"] . "'></a>";
            }
        }

        ?>
    </div>
    <div>
        <?php
        // produtos sem promoçao 
        $sql = "SELECT * FROM `tbproduto` WHERE `ativo` = 1 AND `promocao` = 0";
        $resultado = $conn->execQuery($sql);
        while ($linha = mysqli_fetch_array($resultado)) {
            echo "<a href=\"mostrarProduto.php?idProd=" . $linha["idProd"] . "\"><img src='images/" . $linha["fotoProd"] . "'></a>";
        }
        $conn->desconectar();
        ?>
    </div>
</body>
</html>

