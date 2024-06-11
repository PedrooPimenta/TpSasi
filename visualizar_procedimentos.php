<?php
include "conexao.php";
session_start();


if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
   
} else {
    
    header("Location: login.php");
    exit(); 
}
$query = "SELECT * FROM procedimentos";
$result = $conexao->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Procedimentos</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Procedimentos</h1>
    <div class="container mt-5">
       
        <table class="table table-bordered">
            <thead>
            <tr class="text-center">
                    <th>Nome do Procedimento</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome_procedimento']); ?></td>
                        <td><?php echo htmlspecialchars($row['preco']); ?></td>
                        <td>
                            <a href="editar_procedimento.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Editar</a>
                            <a href="excluir_procedimento.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este procedimento?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="funcionario.php" class="btn btn-light">Voltar</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
