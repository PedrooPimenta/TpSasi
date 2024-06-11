<?php
session_start();
if ($_SERVER['SERVER_PORT'] != 443) {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
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
    <title>Clínica Odontológica - Pacientes Cadastrados</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Pacientes Cadastrados</h1>
    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
               
                include "conexao.php";

               
                $query = "SELECT id, nome, email, telefone, cpf, endereco FROM usuarios WHERE nivel_acesso = 3";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

              
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>" . $usuario['nome'] . "</td>";
                    echo "<td>" . $usuario['email'] . "</td>";
                    echo "<td>" . $usuario['telefone'] . "</td>";
                    echo "<td>" . $usuario['cpf'] . "</td>";
                    echo "<td>" . $usuario['endereco'] . "</td>";
                    echo "<td class='text-center'>";
                    echo "<a href='editar_paciente.php?id=" . $usuario['id'] . "' class='btn btn-primary btn-sm me-2'>Editar</a>";
                    echo "<a href='excluir_paciente.php?id=" . $usuario['id'] . "' class='btn btn-danger btn-sm'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }

               
                $conexao = null;
                ?>
            </tbody>
        </table>
        <a href="funcionario.php" class="btn btn-light">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
