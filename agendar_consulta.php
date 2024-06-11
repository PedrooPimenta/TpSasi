<?php
session_start();
include "conexao.php";

if (!isset($_SESSION['usuario'])) {
    echo '<script>alert("Acesso negado!"); window.location = "login.php";</script>';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paciente_id = $_SESSION['usuario'][0];
    $procedimento_id = $_POST["procedimento_id"];
    $data_hora = $_POST["data_hora"];
    $observacoes = $_POST["observacoes"];

    $sql_verificar_consulta = "SELECT COUNT(*) FROM consultas WHERE data_hora = :data_hora";
    $stmt_verificar_consulta = $conexao->prepare($sql_verificar_consulta);
    $stmt_verificar_consulta->bindParam(':data_hora', $data_hora);
    $stmt_verificar_consulta->execute();
    $consulta_existente = $stmt_verificar_consulta->fetchColumn();

    if ($consulta_existente > 0) {
        echo "<script>alert('Já existe uma consulta agendada para a mesma data e horário. Por favor, escolha outra data/horário.');</script>";
    } else {
        $sql_inserir_consulta = "INSERT INTO consultas (paciente_id, procedimento_id, data_hora, observacoes) VALUES (:paciente_id, :procedimento_id, :data_hora, :observacoes)";
        $stmt_inserir_consulta = $conexao->prepare($sql_inserir_consulta);
        $stmt_inserir_consulta->bindParam(':paciente_id', $paciente_id);
        $stmt_inserir_consulta->bindParam(':procedimento_id', $procedimento_id);
        $stmt_inserir_consulta->bindParam(':data_hora', $data_hora);
        $stmt_inserir_consulta->bindParam(':observacoes', $observacoes);

        if ($stmt_inserir_consulta->execute()) {
            echo "<script>alert('Consulta agendada com sucesso.'); window.location.href = 'ver_consultas.php';</script>";
        } else {
            echo "Erro ao agendar a consulta. Por favor, tente novamente.";
        }
    }
}

$sql_procedimentos = "SELECT id, nome_procedimento FROM procedimentos";
$stmt_procedimentos = $conexao->query($sql_procedimentos);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica - Agendar Consulta</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Agendar Consulta</h1>
    <div class="container mt-5">
        
        <form action="agendar_consulta.php" method="post">
            <div class="mb-3">
                <label for="procedimento_id" class="form-label">Selecione o Procedimento:</label>
                <select id="procedimento_id" name="procedimento_id" class="form-select" required>
                    <?php
                    while ($row_procedimento = $stmt_procedimentos->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row_procedimento['id'] . "'>" . $row_procedimento['nome_procedimento'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="data_hora" class="form-label">Data e Hora da Consulta:</label>
                <input type="datetime-local" id="data_hora" name="data_hora" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações:</label>
                <textarea id="observacoes" name="observacoes" class="form-control" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Agendar Consulta</button>
                <a href="funcionario.php" class="btn btn-light">Voltar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
