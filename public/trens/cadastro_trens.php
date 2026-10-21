<?php

session_start();

if (!isset($_SESSION['tipo'])) {
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
    $rota = $_POST['rota'] ?? '';
    $velocidade = $_POST['velocidade'];
    $peso = $_POST['peso'];
    $temperatura = $_POST['temperatura'];
    $tempo = $_POST['tempo'];
    $status = $_POST['status'];

    $id = $_SESSION['id'] ?? null;

    while ($trem = mysqli_fetch_assoc($resultado)) {
        if ($nome === $trem['nome']) {
            echo '<script>alert("O nome do trem já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "trens.php";</script>';
            exit();
        }
    }

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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Trens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
</head>

<body class="body3">
    <div class="corpo">
        <main>
            <div class="campo1">
                <div class="titulo3">
                    <i class="bi bi-pencil-square"></i>
                    <span>Cadastrar Trem</span>
                </div>

                <div class="corpo2">
                    <div class="titulo-sensor">
                        <i class="bi bi-broadcast-pin"></i>
                        <span>Informações do Trem</span>
                    </div>

                    <form method="POST">
                        <div class="form-group">
                            <label for="nome">Nome do trem:</label>
                            <input type="text" name="nome" id="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="velocidade">Velocidade (km/h):</label>
                            <input type="number" step="any" name="velocidade" id="velocidade" required>
                        </div>

                        <div class="form-group">
                            <label for="peso">Peso (kg):</label>
                            <input type="number" step="any" name="peso" id="peso" required>
                        </div>

                        <div class="form-group">
                            <label for="temperatura">Temperatura (°C):</label>
                            <input type="number" step="any" name="temperatura" id="temperatura" required>
                        </div>

                        <div class="form-group">
                            <label for="tempo">Tempo (min):</label>
                            <input type="number" step="any" name="tempo" id="tempo" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" required>
                                <option value="">selecione</option>
                                <option value="funcionando">funcionando</option>
                                <option value="defeituoso">defeituoso</option>
                            </select>
                        </div>

                        <div class="botoes-container">
                            <button type="button" class="btn-voltar" onclick="window.location.href='trens.php'">Voltar</button>
                            <button type="submit" class="btn-cadastrar">Cadastrar Trem</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <header><?php include '../../scripts/navbar2.php'; ?></header>
</body>

</html>