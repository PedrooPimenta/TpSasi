<?php
include "conexao.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $query = "SELECT * FROM procedimentos WHERE id = :id";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $procedimento = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome_procedimento = $_POST["nome_procedimento"];
        $preco = $_POST["preco"];
        
        $sql = "UPDATE procedimentos SET nome_procedimento = :nome_procedimento, preco = :preco WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome_procedimento', $nome_procedimento);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo '<script>alert("Procedimento atualizado com sucesso!"); window.location = "visualizar_procedimentos_adm.php";</script>';
        } else {
            echo '<script>alert("Erro ao atualizar procedimento. Tente novamente."); window.location = "editar_procedimento_adm.php?id=' . $id . '";</script>';
        }
    }
} else {
    echo '<script>alert("ID de procedimento não fornecido."); window.location = "visualizar_procedimentos_adm.php";</script>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Procedimento</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Editar Procedimento</h1>
    <div class="container mt-5">
       
        <form action="editar_procedimento_adm.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <div class="mb-3">
                <label for="nome_procedimento" class="form-label">Nome do Procedimento:</label>
                <input type="text" id="nome_procedimento" name="nome_procedimento" class="form-control" value="<?php echo htmlspecialchars($procedimento['nome_procedimento']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço:</label>
                <input type="number" step="0.01" id="preco" name="preco" class="form-control" value="<?php echo htmlspecialchars($procedimento['preco']); ?>" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="visualizar_procedimentos_adm.php" class="btn btn-light">Voltar</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
