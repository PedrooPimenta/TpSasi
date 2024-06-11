<?php
session_start();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $sql_verificar = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
    $stmt_verificar = $conexao->prepare($sql_verificar);
    $stmt_verificar->bindParam(":email", $email);
    $stmt_verificar->execute();
    $num_rows = $stmt_verificar->fetchColumn();

    if ($num_rows > 0) {
        echo '<script>alert("Este email já está cadastrado. Por favor, insira um email diferente."); window.location = "cadastro_funcionario_form.php";</script>';
    } else {
        $sql = "INSERT INTO usuarios (nome, email, telefone, cpf, endereco, senha, nivel_acesso) VALUES (:nome, :email, :telefone, :cpf, :endereco, :senha, 0)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":senha", $senha);

        if ($stmt->execute()) {
            echo '<script>alert("Operação realizada com sucesso!"); window.location = "mostrarfuncionarios.php";</script>';
        } else {
            echo "Erro ao salvar os dados: " . $stmt->errorInfo()[2];
        }
    }

    $conexao = null;
}
?>
