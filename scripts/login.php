<?php
session_start();
include('../infra/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

   

    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($query);
    $usuario = $result->fetch_assoc();
    if(password_verify($senha, $usuario['senha'])){
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

