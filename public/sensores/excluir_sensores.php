<?php
include '../../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM sensor WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {



    echo '<script>alert("Sensor excluído com sucesso.");</script>';
    echo '<script>window.location.href = "sensores.php";</script>';
} else {
    echo "Erro ao excluir sensor: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
?>



