<?php
include "conexao.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo '<script>alert("Funcionário excluído com sucesso!"); window.location = "mostrarfuncionarios.php";</script>';
    } else {
        echo '<script>alert("Erro ao excluir funcionário. Tente novamente."); window.location = "mostrarfuncionarios.php";</script>';
    }
} else {
    echo '<script>alert("ID de funcionário não fornecido."); window.location = "mostrarfuncionarios.php";</script>';
}
?>
