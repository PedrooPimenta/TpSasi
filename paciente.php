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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica - Área do Paciente</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
<body >
    <h1>Clinica Odontológica</h1>
    

    <p>Bem-vindo, <?php echo $_SESSION['usuario'][0]; ?></p>
    <ul>
        <li><a class="botoes" href="minhas_consultas.php">Minha consultas</a></li>
        <li><a class="botoes" href="agendar_consulta_paciente.php">Agendar consulta</a></li>
        <li><a class="botoes"  href="logout.php">Sair</a></li>
    </ul>
  
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-pPRJgIZ2z9M5Qzg0cGGtWL+N/soqGFMXGf7Pme2kOK9eN44fq1mRa9Z6TfDyj25X" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93/87AsLPAtR8tKSo8lj2UFV8QzMWwq0V4FbOarOU0vsM84C1+jxvs267MPlb5" crossorigin="anonymous"></script>
</body>
</html>
