<?php
session_start();
if ($_SERVER['SERVER_PORT'] == 443) {
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}


if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
   
} else {
   
    header("Location: login.php");
    exit(); 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica - Área do Funcionário</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center">Área do Funcionário</h1>
    <div class="container mt-5">
        <ul>
            <li ><a class="botoes" href="visualizar_procedimentos.php">Visualizar Procedimentos</a></li>
            <li ><a class="botoes" href="cadastrar_procedimento.php">Cadastrar Procedimento</a></li>
            <li ><a class="botoes" href="pacientes.php">Visualizar Pacientes</a></li>
            <li ><a class="botoes" href="consultas.php">Visualizar Consultas</a></li>
            <li ><a class="botoes" href="historico_procedimentos.php">Histórico</a></li>
            <li ><a class="botoes" href="logout.php">Sair</a></li>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
