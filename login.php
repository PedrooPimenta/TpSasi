<?php
session_start();
require("conexao.php");


if(isset($_POST["email"]) && isset($_POST["senha"]) && $conexao != null){
    $query = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
    $query->execute(array($_POST["email"]));

    if($query->rowCount()){
        $user = $query->fetch(PDO::FETCH_ASSOC);

       
        if (password_verify($_POST["senha"], $user["senha"])) {
            $_SESSION["usuario"] = array($user["nome"], $user["nivel_acesso"], $user["id"]);

         
            if ($user["nivel_acesso"] == 1) {
                echo "<script>window.location = 'administrador.php'</script>";
            } else if ($user["nivel_acesso"] == 0) {
                echo "<script>window.location = 'funcionario.php'</script>";
            } else if ($user["nivel_acesso"] == 3) {
                echo "<script>window.location = 'paciente.php'</script>"; 
            }
        } else {
            echo "<script>alert('Dados incorretos!'); window.location = 'index.php'</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location = 'index.php'</script>";
    }
} else {
    echo "<script>window.location = 'index.php'</script>";
}
?>
