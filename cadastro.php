<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cadastro de Produtos</title>
</head>
<body>

<div class="container mt-5">
    <h2>Cadastro de Produtos</h2>
    <form action="processa_cadastro.php" method="post" id="cadastroForm">
        <div class="form-group">
            <label for="codigo">Codigo:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
			<div id="descricaoError" class="text-danger"></div>
        </div>
        <div class="form-group">
            <label for="preco">Preço:</label>
			<input type="number" class="form-control" id="preco" name="preco" step="0.01" min="0" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select class="form-control" id="categoria" name="categoria" required>
                <option value="" disabled selected>Selecione a categoria</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
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
            }
        });
    });
	
	$(document).ready(function(){
        $('#cadastroForm').submit(function(e){
            e.preventDefault(); // Impede o envio padrão do formulário

            var descricao = $('#descricao').val();
            $.ajax({
                type: "POST",
                url: "verifica_dados.php",
                data: { descricao: descricao },
                dataType: 'json',
                success: function(response){
                    if(response.status == 'error'){
                        $('#descricaoError').text(response.message);
                    } else {
                        // Se não houver erro, envie o formulário
                        $('#descricaoError').empty();
                        $('#cadastroForm')[0].submit(); // Envie o formulário
                    }
                }
            });
        });
    });
</script>

</body>
</html>
