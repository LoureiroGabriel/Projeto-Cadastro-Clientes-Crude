<?php
include("./conexao.php");

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    if (isset($_POST["confirmar"])) {
        $sql_code = "DELETE FROM clientes WHERE id = '$id'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

        if ($sql_query) { ?>
            <h1>Cliente Deletado com Sucesso</h1>
            <p><a href="./clientes.php">Clique aqui</a> para voltar à lista de clientes</p>
<?php
            die();
        }
    }
} else {
    echo "<p>Parâmetro 'id' não encontrado.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
</head>

<body>
    <h1>Tem certeza que deseja deletar este cliente?</h1>

    <form action="" method="post">
        <a style="margin-right: 40px" href="./clientes.php">Não</a>
        <button type="submit" name="confirmar" value="1">Sim</button>
    </form>
</body>

</html>