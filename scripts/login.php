<?php
session_start();
include('../infra/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $_SESSION['usuario'] = $usuario['email'];
        $_SESSION['tipo'] = $usuario['cargo'];

        
        header('Location: ../public/home.php');
        
        exit();
    } else {
        echo '<script>alert("Email ou senha incorretos.");</script>';    
        echo '<script>window.location.href = "../index.php";</script>';
    }
}
?>

