<?php
include "conexao.php";

$usuario = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $query = "SELECT id, nome, email, telefone, cpf, endereco FROM usuarios WHERE id = :id";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Paciente não encontrado!";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : $usuario['senha']; // Criptografar a senha se fornecida

   
    $query = "UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, cpf = :cpf, endereco = :endereco, senha = :senha WHERE id = :id";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Paciente atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar paciente!";
    }

  
    header("Location: pacientes.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1>Editar Paciente</h1>
<div class="container mt-5">
<?php if ($usuario): ?>
        <form method="post" action="editar_paciente.php">
            <input type="hidden" name="id" value="<?php echo isset($usuario['id']) ? htmlspecialchars($usuario['id']) : ''; ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($usuario['nome']) ? htmlspecialchars($usuario['nome']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($usuario['email']) ? htmlspecialchars($usuario['email']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo isset($usuario['telefone']) ? htmlspecialchars($usuario['telefone']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo isset($usuario['cpf']) ? htmlspecialchars($usuario['cpf']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo isset($usuario['endereco']) ? htmlspecialchars($usuario['endereco']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha (deixe em branco para manter a mesma)</label>
                <input type="password" class="form-control" id="senha" name="senha">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="funcionario.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Paciente não encontrado.
        </div>
    <?php endif; ?>
</div>
</body>
</html>
