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
    <title>Produto</title>
</head>

<body>
    <main>
        <?php
        $idProduto = $_REQUEST["idProd"];
        $sql = "SELECT * FROM `tbproduto` WHERE `idProd` = '$idProduto'";
        $resultado = $conn->execQuery($sql);

        while ($linha = mysqli_fetch_array($resultado)) {
            echo "<img src='images/" . $linha["fotoProd"] . "'>";
            echo "<h2>Produto: " . $linha["nomeProd"] . "</h2>";
            echo "<h2>Descrição: " . $linha["descrProd"] . "</h2>";

            if ($linha["promocao"] == 1) {
                echo "<h2>Preço promocional: R$" . $linha["precoProm"] . "<s>R$" . $linha["precoVenda"] . "</s></h2>";
            } else {
                echo "<h2>Preço: R$" . $linha["precoVenda"] . "</h2>";
            }
            echo "<form action=\"carrinho.php?acao=add&idProd=" . $linha["idProd"] . "\" method=" . "post" . "><input type=" . "submit" . " value=" . "Adicionar ao carrino" . "></form>";
        }
        $conn->desconectar();
        ?>
    </main>
</body>

</html>