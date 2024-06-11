<!DOCTYPE html>
<?php
session_start();
include "conexao.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario'][1] != 3) {
    echo '<script>alert("Acesso negado!"); window.location = "login.php";</script>';
    exit();
}

$paciente_id = $_SESSION['usuario'][2]; 



$sql_consultas = "SELECT c.id, p.nome_procedimento, c.data_hora, c.observacoes FROM consultas c
                  INNER JOIN procedimentos p ON c.procedimento_id = p.id
                  WHERE c.paciente_id = :paciente_id ORDER BY c.data_hora";
$stmt_consultas = $conexao->prepare($sql_consultas);
$stmt_consultas->bindParam(':paciente_id', $paciente_id);
$stmt_consultas->execute();
?>


<html>
<head>
    <title>Clínica Odontológica -  Consultas</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Minhas consultas</h1>
    <div class="container mt-5">
      

    <h2>Minhas Consultas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Procedimento</th>
                <th>Data e Hora</th>
                <th>Observações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $stmt_consultas->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nome_procedimento'] . "</td>";
            echo "<td>" . $row['data_hora'] . "</td>";
            echo "<td>" . $row['observacoes'] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
        <br>
        <a href="javascript:history.back()" class="btn btn-light">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
