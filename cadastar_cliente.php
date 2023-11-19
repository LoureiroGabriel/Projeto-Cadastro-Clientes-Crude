<?php

include "./conexao.php";

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
        $sql_code = "INSERT INTO clientes (nome, email, telefone, nascimento, data) VALUES ('$nome', '$email', '$telefone', '$nascimento', NOW())";
        $sucesso = $mysqli->query($sql_code) or die($mysqli->error);
        if($sucesso){
            echo "<p><b>Cliente cadastrado com sucesso</b></p>";
            unset($_POST);
        }
    }
}

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
            <input value = "<?php if(isset($_POST["nome"])) echo $_POST["nome"] ?>" type="text" name="nome" id="nome"><br>
        </p>
        <p>
            <label for="email">Email:</label>
            <input value="<?php if(isset($_POST["email"])) echo $_POST["email"] ?>" type="email" name="email" id="email"><br>
        </p>
        <p>
            <label for="telefone">Telefone:</label>
            <input  value = "<?php if(isset($_POST["telefone"])) echo $_POST["telefone"] ?>" placeholder="(31) 98888-8888" type="tel" name="telefone" id="telefone">
        </p>
        <p>
            <label for="nascimento">Data de Nascimento:</label>
            <input value = "<?php if(isset($_POST["nascimento"])) echo $_POST["nascimento"] ?>" type="text" name="nascimento" id="nascimento" placeholder="dd/mm/aaaa">
        </p>
        </p>
        <p>
            <button type="submit">Salvar Cliente</button>
        </p>
    </form>
</body>

</html>