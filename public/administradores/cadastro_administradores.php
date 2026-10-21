<?php
session_start(); 

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'administrador') {
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
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];
    $status = $_POST['status'];
    $id = $_SESSION['id'] ?? null;

include '../../scripts/analizar_senha.php';
    $seguranca = analisarSenha($senha);

    if ($seguranca !== true) {
        echo '<script>alert("A senha não atende aos requisitos mínimos: 1 Maiúscula, 4 Minúsculas, 2 Números, 1 Caractere Especial e 8 Caracteres.");</script>';
        echo '<script>window.location.href = "administradores.php";</script>';
        exit();
    }

    while ($usuario = mysqli_fetch_assoc($usuarios)) {
        if ($email === $usuario['email']) {
            echo '<script>alert("O email já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "administradores.php";</script>';
            exit();
        }
        if ($telefone === $usuario['telefone']) {
            echo '<script>alert("O telefone já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "administradores.php";</script>';
            exit();
        }
    }



    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
   

    $sql = "INSERT INTO usuarios (nome, senha, email, telefone, cargo, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do usuario: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'ssssss', $nome, $senhaHash, $email, $telefone, $cargo, $status);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Administrado cadastrado com sucesso.");</script>';
        echo '<script>window.location.href = "administradores.php";</script>';
        exit();
    } else {
        echo "Erro ao cadastrar Administrado: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Administrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="icon" type="image/png" href="../../assets/img/logoIconSemFundo.png">
</head>
<body>
    <main class="body3">
        <div class="titulo3">
            <i class="bi bi-broadcast"></i>
            <span>Cadastro de Administrado</span>
        </div>
        <div class="container-central">
            <div class="corpo2">
                <div class="titulo-sensor">
                    <i class="bi bi-broadcast-pin"></i>
                    <span>Informações do Administrado</span>
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
                    <br><br>

                    <button type="button" onclick="window.location.href='administradores.php'">Voltar</button> 
                    
                    
                </form>
            </div>
            
        </div>
    </main>
    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>
</html>