<?php

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}


if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'adm') {
    header('Location: ../public/home.php');
    exit();
}

require_once '../infra/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO usuarios(email, senha, cargo) VALUES ('$email', '$senha', 'comum')";
    $conn->query($sql);
    if ($conn->affected_rows > 0) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $conn->error;
    }
    header('Location: ../public/adm.php');
    exit();
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