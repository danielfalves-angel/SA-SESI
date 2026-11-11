<?php


session_start();


if (!isset($_SESSION['tipo'])) {
    header('Location: ../../index.php');
    exit();
}


include '../../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}


$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM rota WHERE id = $id";
$resultado = mysqli_query($conn, $sql);
$rota = mysqli_fetch_assoc($resultado);

if($rota['trem']==="Ainda não possui trem"){
if ($id > 0) {


    $stmt_trem = mysqli_prepare($conn, "UPDATE trem SET id_rota = NULL WHERE id_rota = ?");
    mysqli_stmt_bind_param($stmt_trem, 'i', $id);
    mysqli_stmt_execute($stmt_trem);
    mysqli_stmt_close($stmt_trem);


    $stmt = mysqli_prepare($conn, "DELETE FROM rota WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);


    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Rota excluída com sucesso.");</script>';
        echo '<script>window.location.href = "rota.php";</script>';
    } else {
        echo "Erro ao excluir rota: " . mysqli_error($conn);
    }


    mysqli_stmt_close($stmt);
} else {
    echo '<script>alert("ID de rota inválido."); window.location.href = "rota.php";</script>';
}
}else{
    echo '<script>alert("Esta rota possui um trem.");</script>';
    echo '<script>window.location.href = "rota.php";</script>';
}

?>