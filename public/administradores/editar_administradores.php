
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
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];
    $status = $_POST['status'];
    $id = $_SESSION['id'] ?? null;

    include '../../scripts/analizar_senha.php';
    $seguranca = analisarSenha($senha);

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);


    $sql = "UPDATE usuarios SET nome = ?, senha = ?, email = ?, telefone = ?, cargo = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
     mysqli_stmt_bind_param($stmt, 'ssssssi', $nome, $senha, $email, $telefone, $cargo, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Administrador atualizado com sucesso.");</script>';
        echo '<script>window.location.href = "administradores.php";</script>';
        exit();
    } else {
        echo '<script>alert("Erro ao atualizar administrador.");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

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
                <span>Informações do Administrador</span>
            </div>

     <form method="POST">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>">
                    <br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>">
                    <br>

                    <label for="senha">Senha:</label>
                    <input type="password" name="senha">
                    <br>

                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>">
                    <br>

                    <label for="cargo">Cargo:</label>
                    <select name="cargo">
                        <option value="<?php echo htmlspecialchars($usuario['cargo']); ?>" selected><?php echo htmlspecialchars($usuario['cargo']); ?></option>
                        <option value="administrador">Administrador</option>
                        <option value="usuario">Usuário</option>
                    </select>
                    <br>

                    <label for="status">Status:</label>
                    <select name="status">
                        <option value="<?php echo htmlspecialchars($usuario['status']); ?>" selected><?php echo htmlspecialchars($usuario['status']); ?></option>
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                    <br>
            
                <button type="submit">Editar administrador</button>
                <br><br>

                <button type="button" onclick="window.location.href='administradores.php'">Voltar</button> 
    </form>

</div>
</div>

<header><?php include '../../scripts/navbar2.php'; ?></header>

</body>

</html>