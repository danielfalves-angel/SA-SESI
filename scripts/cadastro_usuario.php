<?php
session_start();
require_once 'conect.php';

// Se já estiver logado, vai direto para a Home
if (isset($_SESSION['usuario_logado'])) {
    header("Location: public/home.php");
    exit();
}

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conn, $sql);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        $_SESSION['usuario_logado'] = $usuario['email'];
        header("Location: public/home.php");
        exit();
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Orbital Trens</title>
</head>
<body>

    <div class="card">
        <h2>Login</h2>

        <?php if ($erro) echo "<p style='color:red;'>$erro</p>"; ?>

        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Senha" required><br><br>

            <button type="submit">Enviar</button>
        </form>

        <br>
        <a href="cadastro_usuario.php">Não tem conta? Cadastre-se</a>
    </div>

</body>
</html>