<?php
$hostname = "localhost";
$bancodedadoos = "crud_clientes";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedadoos);
if ($mysqli->connect_errno) {
    echo "falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_errno;
}


function formatar_data($data)
{
    return implode('/', array_reverse(explode('-', $data)));
}


function formatar_telefone($telefone)
{
    if (!empty($telefone)) {
        $ddd = substr($telefone, 0, 2);
        $parte1 = substr($telefone, 2, 5);
        $parte2 = substr($telefone, 7);
        $telefone_formatado = "($ddd) $parte1-$parte2";
        return $telefone_formatado;
    }
}
