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

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM trem WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadotrem = mysqli_stmt_get_result($stmt);
$trem = mysqli_fetch_assoc($resultadotrem);

if (!$trem) {
    die('Trem não encontrado.');
}

$sql = "SELECT * FROM trem";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar trens: ' . mysqli_error($conn));
}

if(isset($_GET['id'])) {
    $id_GET = $_GET['id'];
} else {
    die('ID do trem não fornecido.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id']);
    $nome = trim($_POST['nome']);
    $rota = trim($_POST['rota'] ?? $trem['rota']);
    $velocidade = trim($_POST['velocidade']);
    $peso = trim($_POST['peso']);
    $temperatura = trim($_POST['temperatura']);
    $tempo = trim($_POST['tempo']);
    $status = trim($_POST['status']);

    while ($tremCheck = mysqli_fetch_assoc($resultado)) {
        if ($id_GET != $tremCheck['id'] && $nome === $tremCheck['nome']) {
            echo '<script>alert("O nome do trem já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "trens.php";</script>';
            exit();
        }
    }

    $sql = "UPDATE trem SET nome = ?, rota = ?, velocidade = ?, peso = ?, temperatura = ?, tempo = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssddddsi', $nome, $rota, $velocidade, $peso, $temperatura, $tempo, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Trem atualizado com sucesso.");</script>';
        echo '<script>window.location.href = "trens.php";</script>';
        exit();
    } else {
        echo "Erro ao atualizar trem: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Trem</title>
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
                    <span>Editar Trem</span>
                </div>

                <div class="corpo2">
                    <div class="titulo-sensor">
                        <i class="bi bi-broadcast-pin"></i>
                        <span>Informações do Trem</span>
                    </div>

                    <form method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($trem['id']); ?>">

                        <div class="form-group">
                            <label for="nome">Nome do trem:</label>
                            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($trem['nome']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="velocidade">Velocidade (km/h):</label>
                            <input type="number" step="any" name="velocidade" id="velocidade" value="<?php echo htmlspecialchars($trem['velocidade']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="peso">Peso (kg):</label>
                            <input type="number" step="any" name="peso" id="peso" value="<?php echo htmlspecialchars($trem['peso']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="temperatura">Temperatura (°C):</label>
                            <input type="number" step="any" name="temperatura" id="temperatura" value="<?php echo htmlspecialchars($trem['temperatura']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="tempo">Tempo (min):</label>
                            <input type="number" step="any" name="tempo" id="tempo" value="<?php echo htmlspecialchars($trem['tempo']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" required>
                                <option value="funcionando" <?php echo ($trem['status'] === 'funcionando') ? 'selected' : ''; ?>>funcionando</option>
                                <option value="defeituoso" <?php echo ($trem['status'] === 'defeituoso') ? 'selected' : ''; ?>>defeituoso</option>
                            </select>
                        </div>

                        <div class="botoes-container">
                            <button type="button" class="btn-voltar" onclick="window.location.href='trens.php'">Voltar</button>
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