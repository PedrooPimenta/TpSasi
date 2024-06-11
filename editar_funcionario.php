<?php
include "conexao.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $query = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $cpf = $_POST["cpf"];
        $endereco = $_POST["endereco"];
        $senha = $_POST["senha"];

       
        if (empty($senha)) {
         
            $senha = $funcionario['senha'];
        } else {
          
            $senha = password_hash($senha, PASSWORD_DEFAULT);
        }
        
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, cpf = :cpf, endereco = :endereco, senha = :senha WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo '<script>alert("Funcionário atualizado com sucesso!"); window.location = "mostrarfuncionarios.php";</script>';
        } else {
            echo '<script>alert("Erro ao atualizar funcionário. Tente novamente."); window.location = "editar_funcionario.php?id=' . $id . '";</script>';
        }
    }
} else {
    echo '<script>alert("ID de funcionário não fornecido."); window.location = "mostrarfuncionarios.php";</script>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Editar Funcionário</h1>
    <div class="container mt-5">
        <form action="editar_funcionario.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo htmlspecialchars($funcionario['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($funcionario['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" class="form-control" value="<?php echo htmlspecialchars($funcionario['telefone']); ?>">
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF:</label>
                <input type="text" id="cpf" name="cpf" class="form-control" value="<?php echo htmlspecialchars($funcionario['cpf']); ?>">
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço:</label>
                <input type="text" id="endereco" name="endereco" class="form-control" value="<?php echo htmlspecialchars($funcionario['endereco']); ?>">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha (deixe em branco para manter a mesma)</label>
                <input type="password" id="senha" name="senha" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="mostrarfuncionarios.php" class="btn btn-light">Voltar</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
