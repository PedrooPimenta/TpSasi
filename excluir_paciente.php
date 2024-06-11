<?php
include "conexao.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $query = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Paciente excluído com sucesso!";
    } else {
        echo "Erro ao excluir paciente!";
    }
    header("Location: pacientes.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Excluir Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <a href="funcionario.php" class="btn btn-secondary">Voltar</a>
</div>
</body>
</html>
