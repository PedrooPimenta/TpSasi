<?php
session_start();
include "conexao.php";


if (!isset($_SESSION['usuario']) || $_SESSION['usuario'][1] != 3) {
    echo '<script>alert("Acesso negado!"); window.location = "login.php";</script>';
    exit();
}

$paciente_id = $_SESSION['usuario'][2];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["agendar_consulta"])) {
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
            echo "<script>alert('Consulta agendada com sucesso.'); window.location.href = 'paciente.php';</script>";
        } else {
            echo "Erro ao agendar a consulta. Por favor, tente novamente.";
        }
    }
}

$sql_procedimentos = "SELECT id, nome_procedimento FROM procedimentos";
$stmt_procedimentos = $conexao->query($sql_procedimentos);

$sql_consultas = "SELECT c.id, p.nome_procedimento, c.data_hora, c.observacoes FROM consultas c
                  INNER JOIN procedimentos p ON c.procedimento_id = p.id
                  WHERE c.paciente_id = :paciente_id ORDER BY c.data_hora";
$stmt_consultas = $conexao->prepare($sql_consultas);
$stmt_consultas->bindParam(':paciente_id', $paciente_id);
$stmt_consultas->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agendar Nova Consulta - Clínica Odontológica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="styles/style.css">
<body >
    <h1 >Agendar Nova Consulta</h1>
    <form action="paciente.php" method="post" class="mt-5">
        <input type="hidden" name="agendar_consulta" value="1">
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

        <button type="submit" class="btn btn-primary">Agendar Consulta</button>
        <a href="paciente.php" class="btn btn-light">Voltar</a>
    </form>
</body>
</html>
