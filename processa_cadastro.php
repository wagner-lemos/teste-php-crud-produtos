<?php
require_once('conexao.php');

$codigo = $_POST['codigo'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$categoria = $_POST['categoria'];

$sql = "INSERT INTO produtos (codigo, descricao, preco, categoria_id) VALUES ('$codigo', '$descricao', '$preco', $categoria)";

if ($conexao->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $conexao->error;
}

$conexao->close();

header("location: index.php");
?>
