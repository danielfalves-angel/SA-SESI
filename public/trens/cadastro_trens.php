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

$sql = "SELECT * FROM trem";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar trens: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $rota = $_POST['rota'];
    $velocidade = $_POST['velocidade'];
    $peso = $_POST['peso'];
    $temperatura = $_POST['temperatura'];
    $tempo = $_POST['tempo'];
    $status = $_POST['status'];

$id = $_SESSION['id'] ?? null;
   

    $sql = "INSERT INTO trem (nome, rota, velocidade, peso, temperatura, tempo, status, id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do trens: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'ssddddsi', $nome, $rota, $velocidade, $peso, $temperatura, $tempo, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Trem cadastrado com sucesso.");</script>';
        echo '<script>window.location.href = "trens.php";</script>';
        exit();
    } else {
        echo "Erro ao cadastrar trem: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Trens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
</head>





<body class="body3">

    <div class="titulo3">
        <i class="bi bi-broadcast"></i>
        <span>Cadastro de Trens</span>
    </div>

    <div class="container-central">
        <div class="corpo2">
            <div class="titulo-sensor">
                <i class="bi bi-broadcast-pin"></i>
                <span>Informações do trens</span>
            </div>

            <form method="POST">
        <label for="nome">nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br> 
            
         <label for="velocidade">Velocidade: </label>
         <input type="text" name="velocidade" id="velocidade" required>

                <div class="form-group">
                    <label for="rota">Rota:</label>
                    <input type="text" name="rota" id="rota" required>
                </div>

                <label for="peso">Peso:</label>
                <input type="number" name="peso" id="peso" required>
                <br>

                <label for="temperatura">Temperatura:</label>
                <input type="number" name="temperatura" id="temperatura" required>
                <br>

                <label for="tempo">Tempo:</label>
                <input type="number" name="tempo" id="tempo" required>
                <br>

                <label for="status">Status: </label>
                <select name="status" id="status">
                    <option value=""> Selecione</option>
                    <option value="funcionando">funcionando</option>
                    <option value="defeituoso">defeituoso</option>
                </select>
                <br>
            
                <button type="submit">Cadastrar trens</button>
            </form>
        </div>
        <button type="button" onclick="window.location.href='trens.php'">Voltar</button>
    </div>

    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>
</html>