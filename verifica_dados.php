<?php
require_once('conexao.php');

// Verifica se o valor da descrição já existe no banco de dados
$descricao = $_POST['descricao'];
$sql = "SELECT * FROM produtos WHERE descricao = '$descricao'";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    // A descrição já existe no banco de dados
    echo json_encode(array('status' => 'error', 'message' => 'A descrição já existe.'));
} else {
    // A descrição não existe no banco de dados
    echo json_encode(array('status' => 'success', 'message' => 'Descrição disponível.'));
}

$conexao->close();
?>
