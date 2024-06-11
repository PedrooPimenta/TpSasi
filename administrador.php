<?php
session_start();
if ($_SERVER['SERVER_PORT'] == 443) {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
  }
if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
    $nome = $_SESSION["usuario"][0];
} else {
   
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica - Administrador</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Página do Administrador</h1>
    <p>Seja bem-vindo, <?php echo $nome; ?>  </p>
    <p> Esta é a página exclusiva para administradores.</p>
    <p>Aqui você pode realizar tarefas especiais.</p>

    
    <ul>
        <li><a class="botoes" href="cadastro_funcionario_form.php">Cadastrar Funcionários</a></li>
        <li><a class="botoes" href="mostrarfuncionarios.php">Visualizar Funcionários</a></li>
        <li ><a class="botoes" href="visualizar_procedimentos_adm.php">Visualizar Procedimentos</a></li>
        <li ><a class="botoes" href="cadastro_procedimento_form.php">Cadastrar Procedimento</a></li>
        <li><a class="botoes" href="logout.php">Sair</a></li>
    </ul>

</body>
</html>
