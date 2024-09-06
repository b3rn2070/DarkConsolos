<?php
require_once 'conexao.php';

class Relatorio
{
    private $conn;

    function __construct()
    {
        $this->conn = new Conexao("localhost", "root", "", "dark_consolos");
        $this->conn->conectar();
    }

    function relatorioProd($data)
    {
        echo "<table border='1' align='center' width='80%'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Foto</th>";
        echo "<th>Nome do Produto</th>";
        echo "<th>Preço</th>";
        echo "<th>Preço de Venda</th>";
        echo "<th>Quantidade</th>";
        echo "<th>Total Ganho</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        $totalVendas = 0;


        $sql = "SELECT pe.idProduto, p.fotoProd, p.nomeProd, pe.precoVenda, SUM(pe.qnt) AS 'qntProduto', SUM(pe.precoVenda) AS 'total'
                FROM tbPedidos pe
                JOIN tbProduto p ON v.idProduto = p.idProduto
                WHERE v.data = '$data'
                GROUP BY v.idProduto;";

        $resultado = $this->conn->execQuery($sql);

        if ($resultado) {
            while ($linha = mysqli_fetch_array($resultado)) {
                $foto = $linha['fotoProd'];
                $nomeProd = $linha['nomeProd'];
                $precoProd = $linha['precoVenda'];
                $total = $linha['total'];
                $qntProduto = $linha['qnt'];
                $precoVenda = $linha['precoVenda'];
                $totalVendas += $total;

                echo "<tr>";
                echo "<td><img height='50%' src='../imagens/" . $foto . "' alt='foto produto'></td>";
                echo "<td>" . $nomeProd . "</td>";
                echo "<td>R$" . $precoProd . "</td>";
                echo "<td>R$" . $precoVenda . "</td>";
                echo "<td>" . $qntProduto . "</td>";
                echo "<td>R$" . $total . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Erro na consulta: " . mysqli_error($this->conn->getConn());
        }

        echo "<tr>";
        echo "<h3>Total de Vendas: R$" . $totalVendas . "</h3>";
        echo "</tr>";

        $this->conn->desconectar();
    }
}
echo "</tbody>";
echo "</table>";
