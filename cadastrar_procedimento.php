<?php
include "conexao.php";
session_start();


if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
} else {
    header("Location: login.php");
    exit(); 
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_procedimento = $_POST["nome_procedimento"];
    $preco = $_POST["preco"];

    $sql = "INSERT INTO procedimentos (nome_procedimento, preco) VALUES (:nome_procedimento, :preco)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':nome_procedimento', $nome_procedimento);
    $stmt->bindParam(':preco', $preco);

    if ($stmt->execute()) {
        echo '<script>alert("Procedimento cadastrado com sucesso!"); window.location = "visualizar_procedimentos.php";</script>';
    } else {
        echo '<script>alert("Erro ao cadastrar procedimento. Tente novamente."); window.location = "cadastrar_procedimento.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Procedimento</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Cadastrar Procedimento</h1>
    <div class="container mt-5">
       
        <form action="cadastrar_procedimento.php" method="post">
            <div class="mb-3">
                <label for="nome_procedimento" class="form-label">Nome do Procedimento:</label>
                <input type="text" id="nome_procedimento" name="nome_procedimento" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço:</label>
                <input type="number" step="0.01" id="preco" name="preco" class="form-control" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Cadastrar Procedimento</button>
                <a href="funcionario.php" class="btn btn-light">Voltar</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
