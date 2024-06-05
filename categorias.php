<?php
require_once('conexao.php');

$sql = "SELECT id, nome FROM categorias";
$result = $conexao->query($sql);

$options = '<option value="" selected>Selecione a categoria</option>';
while ($row = $result->fetch_assoc()) {
    $options .= '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
}

echo $options;

$conexao->close();
?>
