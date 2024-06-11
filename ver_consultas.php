<?php
session_start();
include "conexao.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario'][1] != 3) {
    echo '<script>alert("Acesso negado!"); window.location = "login.php";</script>';
    exit();
}

$paciente_id = $_SESSION['usuario'][0]; 

$query = "SELECT c.id, p.nome, pr.nome_procedimento, c.data_hora, c.observacoes FROM consultas c
          INNER JOIN pacientes p ON c.paciente_id = p.id
          INNER JOIN procedimentos pr ON c.procedimento_id = pr.id
          WHERE c.paciente_id = :paciente_id";
$stmt = $conexao->prepare($query);
$stmt->bindParam(':paciente_id', $paciente_id);
$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clínica Odontológica - Minhas Consultas</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Minhas Consultas</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Procedimento</th>
            <th>Data e Hora</th>
            <th>Observações</th>
        </tr>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['nome_procedimento'] . "</td>";
            echo "<td>" . $row['data_hora'] . "</td>";
            echo "<td>" . $row['observacoes'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
