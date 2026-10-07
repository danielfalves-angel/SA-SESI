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

$sql = "SELECT * FROM usuarios";
$usuarios = mysqli_query($conn, $sql);

if ($usuarios === false) {
    die('Erro ao consultar usuarios: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];
    $status = $_POST['status'];

$id = $_SESSION['id'] ?? null;
   

    $sql = "INSERT INTO usuarios (nome, senha, email, telefone, cargo, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do usuario: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'ssssss', $nome, $senha, $email, $telefone, $cargo, $status);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Usuário cadastrado com sucesso.");</script>';
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>
    <main class="body3">
        <div class="titulo3">
            <i class="bi bi-broadcast"></i>
            <span>Cadastro de Usuário</span>
        </div>
        <div class="container-central">
            <div class="corpo2">
                <div class="titulo-sensor">
                    <i class="bi bi-broadcast-pin"></i>
                    <span>Informações do Usuário</span>
                </div>

                <form method="POST">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome">
                    <br>

                    <label for="email">Email:</label>
                    <input type="email" name="email">
                    <br>

                    <label for="senha">Senha:</label>
                    <input type="password" name="senha">
                    <br>

                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone">
                    <br>

                    <label for="cargo">Cargo:</label>
                    <select name="cargo">
                        <option value="administrador">Administrador</option>
                        <option value="usuario">Usuário</option>
                    </select>
                    <br>

                    <label for="status">Status:</label>
                    <select name="status">
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                    <br>

                    <button type="submit">Cadastrar</button>
                </form>
            </div>
            <button type="button" onclick="window.location.href='usuarios.php'">Voltar</button>
        </div>
    </main>
    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>
</html>