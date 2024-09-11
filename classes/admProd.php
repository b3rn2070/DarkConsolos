<?php
require_once '../../classes/conexao.php';

class AdmProd
{
    private $conn;

    function __construct()
    {
        $this->conn = new Conexao("localhost", "root", "", "dark_consolos");
        $this->conn->conectar();
    }


    function addProd($nome, $descr, $fotoProd, $qnt, $precoVenda, $precoProm, $prom, $ativo)
    {
        $sql = "INSERT INTO `tbprodutos`(`idProd`, `nomeProd`, `descrProd`, `fotoProd`, `qnt`, `precoVenda`, `precoProm`, `prom`, `ativo`) 
                VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->getConn()->prepare($sql);
        $stmt->bind_param("sssiddii", $nome, $descr, $fotoProd, $qnt, $precoVenda, $precoProm, $prom, $ativo);
        $stmt->execute();
        $stmt->close();
        header("Location: ../index.php");
        exit;
    }

    function listarProd()
    {
        echo "<table align='center' border='1'>";
        echo "<thead align='center'>";
        echo "<tr>";
        echo "<th> Id </th>";
        echo "<th> Foto </th>";
        echo "<th> Nome </th>";
        echo "<th> Descrição </th>";
        echo "<th> Preço </th>";
        echo "<th> Preco Promoção </th>";
        echo "<th> Quantidade </th>";
        echo "<th> Promoção </th>";
        echo "<th> Ativo </th>";
        echo "<th> Remover </th>";
        echo "<th> Alterar </th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody align='center'>";

        $sql = "SELECT * FROM `tbprodutos`;";
        $resultado = $this->conn->execQuery($sql);

        while ($linha = mysqli_fetch_array($resultado)) {
            $idProd = $linha['idProd'];
            $dados = "idProd=" . $idProd . "&nomeProd=" . $linha['nomeProd'] . "&descr=" . $linha['descr'] . "&foto=" . $linha['fotoProd'] . "&qnt=" . $linha['qnt'] . "&promocao=" . $linha['promocao'] . "&precoVenda=" . $linha['precoVenda'] . "&precoProm=" . $linha['precoProm'] . "&ativo=" . $linha['ativo'];

            echo "<tr>";
            echo "<th>" . $idProd . "</th>";
            echo "<th>" . "<img src='../../images/" . $linha['nomeProd'] . "</th>";
            echo "<th>" . $linha['nomeProd'] . "</th>";
            echo "<th>" . $linha['descr'] . "</th>";
            echo "<th>" . $linha['precoVenda'] . "</th>";
            echo "<th>" . $linha['precoProm'] . "</th>";
            echo "<th>" . $linha['qnt'] . "</th>";
            echo "<th>" . $linha['promocao'] . "</th>";
            echo "<th>" . $linha['ativo'] . "</th>";
            echo "<th><form action='?$dados&acao=remover' method='post'> <input type='submit' name='remover' value='Remover'></form></th>";
            echo "<th><form action='alterar.php?$dados&acao=alterar' method='post'> <input type='submit' name='alterar' value='Alterar'></form></th>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    }

    function removerFunc($id)
    {
        $sql = "DELETE FROM `tbfuncionarios` WHERE `idFunc` = $id;";
        $this->conn->execQuery($sql);
    }

    function atualizarFunc($id, $nome, $email, $senha, $ativo, $cargo)
    {
        $sql = "UPDATE `tbfuncionarios` SET `nomeFunc`='$nome',`emailFunc`='$email',`senhaFunc`='$senha',`ativo`=$ativo,`cargo`='$cargo' WHERE `idFunc` =  $id;";
        $resultado = $this->conn->execQuery($sql);

        if ($resultado == true) {
            return true;
        } else {
            return false;
        }
    }
}
