<?php
session_start();
if(!isset($_SESSION['logado'])) { ?>
    <script>
    const usrResp = confirm("você precisa fazer login");

    if(usrResp){
        window.location.href = "login.php";
    }
    
    </script>            
<?php } else { 

require_once 'classes/carrinho.php';
require_once 'classes/conexao.php';

$conn = new Conexao("localhost", "root", "", "dark_consolos");
$conn->conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
</head>
<body>
    
    <form action="index.php"> <input type="submit" value="voltar"></form>
    <?php
        $carrinho = new Carrinho();

        if(isset($_REQUEST["acao"])){
            $acao = $_REQUEST["acao"];
            
            if($acao == "add"){
                $idProduto = intval($_REQUEST["idProd"]);
                $carrinho->addProduto($idProduto);
            } 
            else if($acao === "remover"){
                $idProduto = intval($_REQUEST["idProd"]);
                $carrinho->removeProduto($idProduto);
            }
            else if($acao === "comprar"){
                $carrinho->comprar();
            }
        }

        $carrinho->listarCarrinho(); 

        $conn->desconectar();
    }
?>
</body>
</html>