<?php
session_start();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); 
    $telefone = $_POST["telefone"]; 
    $cpf = $_POST["cpf"]; 
    $endereco = $_POST["endereco"]; 

    $sql_verificar = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
    $stmt_verificar = $conexao->prepare($sql_verificar);
    $stmt_verificar->bindParam(":email", $email);
    $stmt_verificar->execute();
    $num_rows = $stmt_verificar->fetchColumn();

    if ($num_rows > 0) {
        echo '<script>alert("Este email já está cadastrado. Por favor, insira um email diferente."); window.location = "cadastro_paciente.php";</script>';
    } else {
        $sql = "INSERT INTO usuarios (nome, email, senha, telefone, cpf, endereco, nivel_acesso) VALUES (:nome, :email, :senha, :telefone, :cpf, :endereco, 3)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":cpf", $cpf); 
        $stmt->bindParam(":endereco", $endereco); 

        if ($stmt->execute()) {
            echo '<script>alert("Cadastro realizado com sucesso!"); window.location = "login.php";</script>';
        } else {
            echo "Erro ao salvar os dados: " . $stmt->errorInfo()[2];
        }
    }

    $conexao = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica - Cadastro de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>

    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Cadastrar Paciente</h1>
    <form action="cadastro_paciente.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br>
        <br>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required><br>
        <br>
        <input class="btn btn-primary" type="submit" value="Cadastrar">
        <a href="index.php" class="btn btn-light">Voltar</a>
    </form>
</body>
</html>
