<?php

include "./conexao.php";
$id = intval($_GET["id"]);


function limpar_texto($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}

$erro = false;

if (count($_POST) > 0) {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $nascimento = $_POST["nascimento"];

    if (empty($nome)) {
        $erro = "Preencha o nome";
    }
    if (empty($email)) {
        $erro = "Preencha o e-mail";
    }

    if (!empty($nascimento)) {
        $pedacos = explode('/', $nascimento);
        if (count($pedacos) == 3) {
            $nascimento = implode('-', array_reverse($pedacos));
        } else {
            $erro = "A data de nascimento deve seguir o padrão dia/mês/ano";
        }
    }

    if (!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if (strlen($telefone) != 11) {
            $erro  = "O telefone deve ser preenchido no padrão (31) 98888-8888";
        }
    }

    if ($erro) {
        echo "<p><b>$erro</b></p>";
    } else {
        $sql_code = "UPDATE clientes
        SET nome = '$nome',
        email = '$email',
        nascimento = '$nascimento'
        WHERE id = '$id'";

       
        $sucesso = $mysqli->query($sql_code) or die($mysqli->error);
        if ($sucesso) {
            echo "<p><b>Cliente atualizado com sucesso</b></p>";
            unset($_POST);
        }
    }
}


$sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_clientes = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_clientes->fetch_assoc();
// echo "<pre>";
// print_r($cliente);
// echo "</pre>";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
</head>

<body>
    <a href="./clientes.php"> Voltar para a Lista</a>
    <form action="" method="post">
        <p>
            <label for="nome">Nome:</label>
            <input value="<?php echo $cliente["nome"]; ?>" type="text" name="nome" id="nome"><br>
        </p>
        <p>
            <label for="email">Email:</label>
            <input value="<?php echo $cliente["email"]; ?>" type="email" name="email" id="email"><br>
        </p>
        <p>
            <label for="telefone">Telefone:</label>
            <input value="<?php if (!empty($cliente['telefone'])) echo formatar_telefone($cliente["telefone"]); ?>" placeholder="(31) 98888-8888" type="tel" name="telefone" id="telefone">
        </p>
        <p>
            <label for="nascimento">Data de Nascimento:</label>
            <input value="<?php if (!empty($cliente['nascimento'])) echo formatar_data($cliente["nascimento"]) ?>" type="text" name="nascimento" id="nascimento" placeholder="dd/mm/aaaa">
        </p>
        </p>
        <p>
            <button type="submit">Salvar Cliente</button>
        </p>
    </form>
</body>

</html>