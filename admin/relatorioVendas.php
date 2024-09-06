<?php 
require_once '../classes/conexao.php';
require_once '../classes/relatorio.php';
$conn = new Conexao("localhost", "root", "", "dark_consolos");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<center>
    <?php 
        session_start();
        if(!isset($_SESSION['logadoAdm']) || $_SESSION['cargo'] != 'admin' || $_SESSION['cargo'] != 'financeiro') { ?>
            <script>
            const usrResp = confirm("você precisa fazer login");

            if(usrResp){
                window.location.href = "login.php";
            }
            </script>            
    <?php }
        else { ?>
            <h4>Relatório de Vendas</h4>
            <form action="relatorioVendas.php" method="post">
                <input type="date" name="data" required>
                <input type="submit" value="enviar">
            </form>
            <h4>Relatorio do Dia</h4>
            <form action="relatorioVendas.php" method="post">
                <input type="submit" value="Relatorio">
                <input type="hidden" name="dia">
            </form>

            <form action='index.php' method='post'><input type='submit' value='voltar'></form>
        </center>
        <?php 
            if(isset($_POST['data'])){
                $data = $_POST['data'];

                $relatorio = new Relatorio();
                $relatorio->relatorioProd($data);

            } else if(isset($_POST['dia'])){
                $data = date('Y-m-d');
                
                $relatorio = new Relatorio();
                $relatorio->relatorioProd($data);
            }

    
    } ?>
</body>
</html>