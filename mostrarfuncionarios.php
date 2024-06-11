<!DOCTYPE html>
<?php include "conexao.php";
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

<html>
<head>
    <title>Clínica Odontológica - Funcionários Cadastrados</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            overflow-x: auto; 
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2; 
            border-bottom: 2px solid #ddd; 
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Funcionários Cadastrados</h1>
    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>Senha</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT id, nome, email, telefone, cpf, endereco, senha FROM usuarios WHERE nivel_acesso = 0";
                $stmt = $conexao->prepare($query);
                $stmt->execute();
                $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($funcionarios as $funcionario) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($funcionario['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($funcionario['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($funcionario['telefone']) . "</td>";
                    echo "<td>" . htmlspecialchars($funcionario['cpf']) . "</td>";
                    echo "<td>" . htmlspecialchars($funcionario['endereco']) . "</td>";
                    echo "<td>" . htmlspecialchars($funcionario['senha']) . "</td>";
                    echo "<td>";
                    echo "<div class='btn-group'>";
                    echo "<a href='editar_funcionario.php?id=" . $funcionario['id'] . "' class='btn btn-primary btn-sm'>Editar</a> ";
                    echo "<a href='excluir_funcionario.php?id=" . $funcionario['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este funcionário?\");'>Excluir</a>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="administrador.php" class="btn btn-light">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
