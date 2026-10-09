<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit();
}


include '../../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$sql = "SELECT * FROM rota";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar Rota: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $destino = $_POST['destino'];
    $partida = $_POST['partida'];
    $descricao = $_POST['descricao'];

$id = $_SESSION['id'] ?? null;
   

    $sql = "INSERT INTO rota (nome, destino, partida, descricao, id) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do rota: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'sssssi', $nome, $destino, $partida, $descricao, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("rota cadastrado com sucesso.");</script>';
        echo '<script>window.location.href = "rota.php";</script>';
        exit();
    } else {
        echo "Erro ao cadastrar rota: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de rota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
</head>
<body class="body3">

    <div class="titulo3">
        <i class="bi bi-broadcast"></i>
        <span>Cadastro de rota</span>
    </div>

    <div class="container-central">
        <div class="corpo2">
            <div class="titulo-sensor">
                <i class="bi bi-broadcast-pin"></i>
                <span>Informações da Rota </span>
            </div>

            <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br> 
            
         <label for="destino">Destino: </label>
         <input type="text" name="destino" id="destino" required>

         <label for="partida">Partida: </label>
         <input type="text" name="partida" id="partida" required>

         <label for="descricao">Descrição: </label>
         <input type="text" name="descricao" id="descricao" required>
                <br>
            
                <button type="submit">Cadastrar Rota</button>
            </form>
        </div>
        <button type="button" onclick="window.location.href='rota.php'">Voltar</button>
    </div>

    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>
</html>