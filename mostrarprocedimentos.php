<!DOCTYPE html>
<?php
include "conexao.php";

if ($_SERVER['SERVER_PORT'] != 443) {
  header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}

?>

<html>
<head>
    <title>Clínica Odontológica - Procedimentos Cadastrados</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Procedimentos Cadastrados</h1>
    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Preço</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
              
                $query = "SELECT id, nome_procedimento, preco FROM procedimentos";
                $stmt = $conexao->prepare($query); 
                $stmt->execute();  
                $procedimentos = $stmt->fetchAll(PDO::FETCH_ASSOC); 

              
                foreach ($procedimentos as $procedimento) {
                    echo "<tr>";
                    echo "<td class='align-middle text-center'>" . htmlspecialchars($procedimento['nome_procedimento']) . "</td>";
                    echo "<td class='align-middle text-center'>" . htmlspecialchars($procedimento['preco']) . "</td>";
                    echo "<td class='align-middle text-center'>";
                    echo "<a href='editar_procedimento.php?id=" . $procedimento['id'] . "' class='btn btn-primary btn-sm'>Editar</a> ";
                    echo "<a href='excluir_procedimento.php?id=" . $procedimento['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este procedimento?\");'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="administrador.php" class="btn btn-primary">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
