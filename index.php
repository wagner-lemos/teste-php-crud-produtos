<?php
require_once('conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Lista de Produtos</title>
</head>
<body>

<div class="container mt-5">
    <h2>Lista de Produtos</h2>

    <form action="" method="get" class="mb-3">
        <div class="form-row mb-4">
			<div class="form-group col-md-3">
                <label for="filtro_codigo">Codigo:</label>
                <input type="text" class="form-control" id="filtro_codigo" name="filtro_codigo" value="<?= isset($_GET['filtro_codigo']) ? $_GET['filtro_codigo'] : '' ?>">
            </div>
			<div class="form-group col-md-3">
                <label for="filtro_descricao">Descrição:</label>
                <input type="text" class="form-control" id="filtro_descricao" name="filtro_descricao" value="<?= isset($_GET['filtro_descricao']) ? $_GET['filtro_descricao'] : '' ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="filtro_categoria">Categoria:</label>
                <select class="form-control" id="filtro_categoria" name="filtro_categoria"></select>
            </div>
			<div class="form-group col-xs-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
                <label for="filtro_preco">Preço:</label>
				<input type="number" class="form-control" id="filtro_preco" name="filtro_preco" step="0.01" min="0" value="<?= isset($_GET['filtro_preco']) ? $_GET['filtro_preco'] : '' ?>">
            </div>
            <div  class="form-group col-xs-3 col-sm-3 col-md-1 col-lg-1 col-xl-1" style="margin-top: 32px">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>

		<a href="cadastro.php" class="btn btn-primary">Cadastrar</a>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Codigo</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $registro_pagina = 3;

            if (!isset($_GET['pagina']) || empty($_GET['pagina'])) {
                $pagina = 1;
            } else {
                $pagina = $_GET['pagina'];
            }

            $inicio = ($pagina - 1) * $registro_pagina;

            $filtroConsulta = "";

			if (isset($_GET['filtro_codigo']) && !empty($_GET['filtro_codigo'])) {
                $filtroConsulta .= " AND produtos.codigo LIKE '%" . $_GET['filtro_codigo'] . "%'";
            }
			if (isset($_GET['filtro_descricao']) && !empty($_GET['filtro_descricao'])) {
                $filtroConsulta .= " AND produtos.descricao LIKE '%" . $_GET['filtro_descricao'] . "%'";
            }
            if (isset($_GET['filtro_categoria']) && !empty($_GET['filtro_categoria'])) {
                $filtroConsulta .= " AND produtos.categoria_id = " . $_GET['filtro_categoria'];
            }
			if (isset($_GET['filtro_preco']) && !empty($_GET['filtro_preco'])) {
                $filtroConsulta .= " AND produtos.preco LIKE '%" . $_GET['filtro_preco'] . "%'";
            }

            $sql = "SELECT produtos.id, produtos.codigo, produtos.descricao, produtos.preco, categorias.nome AS categoria FROM produtos
                    INNER JOIN categorias ON produtos.categoria_id = categorias.id
                    WHERE 1 $filtroConsulta
                    ORDER BY produtos.id ASC LIMIT $inicio, $registro_pagina";

            $result = $conexao->query($sql);

            $totalRegistros = $conexao->query("SELECT COUNT(*) as total FROM produtos WHERE 1 $filtroConsulta")->fetch_assoc()['total'];

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['codigo'] . "</td>";
                echo "<td>" . $row['descricao'] . "</td>";
                echo "<td>" . $row['categoria'] . "</td>";
                echo "<td>" . $row['preco'] . "</td>";
                echo "<td><a href='editar.php?id=".$row['id']."' class='link-primary'>Editar</a> - <a href='excluir.php?id=" . $row['id'] . "' class='link-primary'>Excluir</a></td>";
                echo "</tr>";
            }

            $conexao->close();
            ?>
        </tbody>
    </table>

    <!-- Paginação -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            $totalPaginas = ceil($totalRegistros / $registro_pagina);

            for ($i = 1; $i <= $totalPaginas; $i++) {
                echo "<li class='page-item " . ($i == $pagina ? 'active' : '') . "'>";
                echo "<a class='page-link' href='?pagina=$i'>$i</a>";
                echo "</li>";
            }
            ?>
        </ul>
    </nav>
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
                $("#filtro_categoria").html(data);
            }
        });
    });
</script>

</body>
</html>
