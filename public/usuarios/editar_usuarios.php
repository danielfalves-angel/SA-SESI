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

// 1. Obtém o ID do usuário que será editado através da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadoUsuario = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultadoUsuario);

if (!$usuario) {
    die('Usuário não encontrado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = $_POST['nome'];
    $senha    = $_POST['senha'];
    $email    = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo    = $_POST['cargo'];
    $status   = $_POST['status'];

    include '../../scripts/analizar_senha.php';
    $seguranca = analisarSenha($senha);

    // Criptografa a senha com hash
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // UPDATE utilizando o $senhaHash correto e o $id vindo do GET
    $sql = "UPDATE usuarios SET nome = ?, senha = ?, email = ?, telefone = ?, cargo = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Passado $senhaHash no lugar de $senha e garantido que $id refira ao registro correto
    mysqli_stmt_bind_param($stmt, 'ssssssi', $nome, $senhaHash, $email, $telefone, $cargo, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        // Verifica se alguma linha foi realmente alterada no banco
        if (mysqli_stmt_affected_rows($stmt) >= 0) {
            echo '<script>alert("Usuário atualizado com sucesso.");</script>';
            echo '<script>window.location.href = "usuarios.php";</script>';
            exit();
        }
    } else {
        echo '<script>alert("Erro ao atualizar usuário.");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="icon" type="image/png" href="../../assets/img/logoIconSemFundo.png">
</head>

<body class="body3">

    <div class="container-central">
        <div class="corpo2">
            <div class="titulo-sensor">
                <i class="bi bi-broadcast-pin"></i>
                <span>Informações do Usuário</span>
            </div>

            <form method="POST">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>" required>
                <br>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" required>
                <br>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
                <br>

                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" value="<?= htmlspecialchars($usuario['telefone'] ?? '') ?>">
                <br>

                <label for="cargo">Cargo:</label>
                <select name="cargo">
                    <option value="administrador" <?= (isset($usuario['cargo']) && $usuario['cargo'] === 'administrador') ? 'selected' : '' ?>>Administrador</option>
                    <option value="usuario" <?= (isset($usuario['cargo']) && $usuario['cargo'] === 'usuario') ? 'selected' : '' ?>>Usuário</option>
                </select>
                <br>

                <label for="status">Status:</label>
                <select name="status">
                    <option value="ativo" <?= (isset($usuario['status']) && $usuario['status'] === 'ativo') ? 'selected' : '' ?>>Ativo</option>
                    <option value="inativo" <?= (isset($usuario['status']) && $usuario['status'] === 'inativo') ? 'selected' : '' ?>>Inativo</option>
                </select>
                <br>
            
                <button type="submit">Editar Usuário</button>
            </form>

        </div>
    </div>

    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>