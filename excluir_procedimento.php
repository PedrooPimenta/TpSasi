<?php
include "conexao.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql = "DELETE FROM procedimentos WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo '<script>alert("Procedimento excluído com sucesso!"); window.location = "visualizar_procedimentos.php";</script>';
    } else {
        echo '<script>alert("Erro ao excluir procedimento. Tente novamente."); window.location = "visualizar_procedimentos.php";</script>';
    }
} else {
    echo '<script>alert("ID de procedimento não fornecido."); window.location = "visualizar_procedimentos.php";</script>';
}
?>
