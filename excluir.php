<?php
require_once('conexao.php');

if (isset($_GET['id'])) {
    $idProduto = $_GET['id'];

    // Evite injeção de SQL usando prepared statements
    $stmt = $conexao->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $idProduto);

    if ($stmt->execute()) {
        // Exclusão bem-sucedida
        echo "Produto excluído com sucesso.";
    } else {
        // Erro na exclusão
        echo "Erro ao excluir o produto: " . $stmt->error;
    }

    $stmt->close();
}

$conexao->close();

header("location: index.php");
?>
