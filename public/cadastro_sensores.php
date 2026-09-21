<?php
include '../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar usuários: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $porte = $_POST['porte'];
    $idade = $_POST['idade'];
    $usuario_id = $_POST['usuario'];

    $sql = "INSERT INTO animais (nome, especie, raca, porte, idade, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do animal: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'ssssii', $nome, $especie, $raca, $porte, $idade, $usuario_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Animal cadastrado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao cadastrar animal: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Animais</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <form method="POST">
        <label for="nome">Nome do Animal:</label>
        <input type="text" name="nome" id="nome" required>
        <br>
        <label for="especie">Espécie:</label>
        <input type="text" name="especie" id="especie" required>
        <br>
        <label for="raca">Raça:</label>
        <input type="text" name="raca" id="raca" required>
        <br>
        <label for="porte">Porte:</label>
        <input type="text" name="porte" id="porte" required>
        <br>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" required>
        <br>
    
        <label for="usuario">Usuário:</label>
        <select name="usuario" id="">
            <option value="">Selecione um Usuário</option>
            <?php
            while ($usuario = mysqli_fetch_assoc($resultado)) {
                echo "<option value='{$usuario['id']}'>{$usuario['nome']}</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit">Cadastrar Animal</button>
    </form>
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>
</body>

</html>