<?php
session_start();
if ($_SERVER['SERVER_PORT'] == 443) {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
  }



if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
   
} else {
   
    header("Location: login.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Historico de Procedimentos</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Historico de Procedimentos</h1>
    <div class="container mt-5">

        <?php
        
        include "conexao.php";

        try {
           
            $query = "
                SELECT c.paciente_id, u.nome AS nome_usuario, COUNT(*) AS total_procedimentos, SUM(p.preco) AS valor_total
                FROM consultas c
                INNER JOIN usuarios u ON c.paciente_id = u.id
                INNER JOIN procedimentos p ON c.procedimento_id = p.id
                WHERE u.nivel_acesso = 3
                GROUP BY c.paciente_id, u.nome
                ORDER BY u.nome
            ";

            $stmt = $conexao->prepare($query);
            $stmt->execute();
            $historico_procedimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($historico_procedimentos) > 0) {
                echo "<div class='table-responsive'>
                        <table class='table table-bordered'>
                            <thead>
                                <tr class='text-center'>
                                    <th>Paciente</th>
                                    <th>Total de Procedimentos</th>
                                    <th>Valor Total Gasto</th>
                                </tr>
                            </thead>
                            <tbody>";

                foreach ($historico_procedimentos as $procedimento) {
                    echo "<tr>
                            <td>" . htmlspecialchars($procedimento['nome_usuario']) . "</td>
                            <td>" . htmlspecialchars($procedimento['total_procedimentos']) . "</td>
                            <td>R$ " . number_format($procedimento['valor_total'], 2, ',', '.') . "</td>
                        </tr>";
                }

                echo "</tbody>
                    </table>
                </div>";
            } else {
                echo "<p class='text-center'>Nenhum procedimento encontrado para pacientes.</p>";
            }
        } catch (PDOException $erro) {
            echo "<p class='text-center'>Ocorreu um erro na consulta: " . htmlspecialchars($erro->getMessage()) . "</p>";
        }
        ?>
        <div>
            <a href="funcionario.php" class="btn btn-light mt-3">Voltar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
