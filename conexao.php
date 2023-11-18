<?php
$hostname = "localhost";
$bancodedadoos = "crud_clientes";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedadoos);
if($mysqli->connect_errno){
    echo "falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_errno;
}else{
    echo "Conectado com Sucesso";
}