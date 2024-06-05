<?php
require_once('conexao.php');

$id = $_POST['id'];

$codigo = $_POST['codigo'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$categoria = $_POST['categoria'];

$update_sql = "UPDATE produtos SET codigo='$codigo', descricao='$descricao', preco='$preco', categoria_id=$categoria WHERE id=$id";

if ($conexao->query($update_sql) === TRUE) {
	echo "Dados atualizados com sucesso!";
} else {
	echo "Erro ao atualizar dados: " . $conexao->error;
}

$conexao->close();

header("location: index.php");
?>