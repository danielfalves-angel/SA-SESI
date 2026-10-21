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

// 1. Obtém o ID do usuário que será editado através da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadoUsuario = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultadoUsuario);

$sql = "SELECT * FROM usuarios";
$resultado2 = mysqli_query($conn, $sql);

if (!$usuario) {
    die('Usuário não encontrado.');
}

if(isset($_GET['id'])) {
    $id_GET = $_GET['id'];
} else {
    die('ID do usuário não encontrado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id       = $_POST['id'];
    $nome     = $_POST['nome'];
    $senha    = $_POST['senha'];
    $email    = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo    = $_POST['cargo'];
    $status   = $_POST['status'];

    include '../../scripts/analizar_senha.php';
    $seguranca = analisarSenha($senha);

    if ($seguranca !== true) {
        echo '<script>alert("A senha não atende aos requisitos mínimos: 1 Maiúscula, 4 Minúsculas, 2 Números, 1 Caractere Especial e 8 Caracteres.");</script>';
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    }

    while ($usuario1 = mysqli_fetch_assoc($resultado2)) {
        if ($id_GET != $usuario1['id'] && $email === $usuario1['email']) {
            echo '<script>alert("O email já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "usuarios.php";</script>';
            exit();
        }
        if ($id_GET != $usuario1['id'] && $telefone === $usuario1['telefone']) {
            echo '<script>alert("O telefone já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "usuarios.php";</script>';
            exit();
        }
    }

    // Criptografa a senha com hash
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // UPDATE utilizando o $senhaHash correto e o $id vindo do GET
    $sql = "UPDATE usuarios SET nome = ?, senha = ?, email = ?, telefone = ?, cargo = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    mysqli_stmt_bind_param($stmt, 'ssssssi', $nome, $senhaHash, $email, $telefone, $cargo, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="icon" type="image/png" href="../../assets/img/logoIconSemFundo.png">
</head>

<body class="body3">
    <div class="corpo">
        <main>
            <div class="campo1">
                <div class="titulo3">
                    <i class="bi bi-pencil-square"></i>
                    <span>Editar Usuário</span>
                </div>

                <div class="corpo2">
                    <div class="titulo-sensor">
                        <i class="bi bi-broadcast-pin"></i>
                        <span>Informações do Usuário</span>
                    </div>

                    <form method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">

                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" id="senha" required>
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($usuario['telefone'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="cargo">Cargo:</label>
                            <select name="cargo" id="cargo">
                                <option value="usuario" <?= (isset($usuario['cargo']) && $usuario['cargo'] === 'usuario') ? 'selected' : '' ?>>Usuário</option>
                                <option value="administrador" <?= (isset($usuario['cargo']) && $usuario['cargo'] === 'administrador') ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status">
                                <option value="ativo" <?= (isset($usuario['status']) && $usuario['status'] === 'ativo') ? 'selected' : '' ?>>Ativo</option>
                                <option value="inativo" <?= (isset($usuario['status']) && $usuario['status'] === 'inativo') ? 'selected' : '' ?>>Inativo</option>
                            </select>
                        </div>

                        <div class="botoes-container">
                            <button type="button" class="btn-voltar" onclick="window.location.href='usuarios.php'">Voltar</button>
                            <button type="submit" class="btn-cadastrar">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>