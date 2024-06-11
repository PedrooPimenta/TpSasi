<!DOCTYPE html>
<?php
include "conexao.php";
session_start();


if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
  
} else {
   
    header("Location: login.php");
    exit(); 
}
?>

<html>
<head>
    
    <title>Clínica Odontológica - Consultas Agendadas</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Consultas Agendadas</h1>
    <div class="container mt-5">
       
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>Nome do Paciente</th>
                    <th>Procedimento</th>
                    <th>Data e Hora</th>
                    <th>Observações</th>
                </tr>
            </thead>
            <tbody>
                <?php
              
                $query = "SELECT c.id, u.nome, pr.nome_procedimento, c.data_hora, c.observacoes FROM consultas c
                          INNER JOIN usuarios u ON c.paciente_id = u.id
                          INNER JOIN procedimentos pr ON c.procedimento_id = pr.id
                          WHERE u.nivel_acesso=3 "
                          ;
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

              
                foreach ($consultas as $consulta) {
                    echo "<tr>";
                    echo "<td>" . $consulta['nome'] . "</td>";
                    echo "<td>" . $consulta['nome_procedimento'] . "</td>";
                    echo "<td>" . $consulta['data_hora'] . "</td>";
                    echo "<td>" . $consulta['observacoes'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="funcionario.php" class="btn btn-light">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
