<?php
require_once('conexao.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id = $id";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

$conexao->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Produto</title>
</head>
<body>

<div class="container mt-5">
    <h2>Editar Produto</h2>
    <form action="processa_edicao.php" method="post">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>" />
		<div class="form-group">
            <label for="codigo">Codigo:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $produto['codigo']; ?>" required>
        </div>
		<div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo $produto['descricao']; ?>" required>
        </div>
		
		<div class="form-group">
            <label for="preco">Preço:</label>
			<input type="number" class="form-control" id="preco" name="preco" step="0.01" min="0" value="<?php echo $produto['preco']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="categoria">Categorias:</label>
            <select class="form-control" id="categoria" name="categoria" required>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "categorias.php",
        success: function(data){
            $("#categoria").html(data);
            $("#categoria").val(<?php echo $produto['categoria_id']; ?>);
            $("#categoria").change();
        }
    });
});

</script>

</body>
</html>