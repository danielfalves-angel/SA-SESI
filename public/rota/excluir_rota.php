<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit();
}

include '../../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM rota WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {



    echo '<script>alert("Rota excluída com sucesso.");</script>';
    echo '<script>window.location.href = "rota.php";</script>';
} else {
    echo "Erro ao excluir rota: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
?>



