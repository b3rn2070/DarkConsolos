<?php
require_once '../../classes/conexao.php';
require_once '../../classes/admFunc.php';
session_start();

if (!isset($_SESSION['logadoAdm']) || $_SESSION['logadoAdm'] == 0) { ?>
     <script>
         const usrResp = confirm("você precisa fazer login");

         if (usrResp) {
             window.location.href = "../admin/login.php";
         }
    </script>

<?php } else if($_SESSION['cargo'] != 'admin') {
    header("Location: ../admin/index.php");
} else {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão Funcionário</title>
</head>
<body>
<center>
    <form action="add.php" method="post">
        <input type="submit" value="Adicionar Funcionário">
    </form>

    <form action="remover.php" method="post">
        <input type="submit" value="Remover Funcionário">
    </form>

    <form action="alterar.php" method="post">
        <input type="submit" value="Alterar Dados de um Funcionário">
    </form>
    <form action="../index.php" method="post"><input type="submit" value="voltar"></form>
</center>
<?php } ?>
</body>
</html>