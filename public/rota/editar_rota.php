<?php

session_start();

include '../../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

if (!isset($_SESSION['tipo'])) {
    header('Location: ../../index.php');
    exit();
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM rota WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadorota = mysqli_stmt_get_result($stmt);
$rota = mysqli_fetch_assoc($resultadorota);

if (!$rota) {
    die('Rota não encontrada.');
}

$sql = "SELECT * FROM rota";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar rotas: ' . mysqli_error($conn));
}

$resultado2 = mysqli_query($conn, "SELECT * FROM trem");

if (isset($_GET['id'])) {
    $id_GET = $_GET['id'];
} else {
    die('ID da rota não fornecido.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id']);
    $nome = trim($_POST['nome']);
    $trem = trim($_POST['trem']);
    $destino = trim($_POST['destino']);
    $partida = trim($_POST['partida']);
    $descricao = trim($_POST['descricao']);

    while ($rotaCheck = mysqli_fetch_assoc($resultado)) {
        if ($id_GET != $rotaCheck['id'] && $nome === $rotaCheck['nome']) {
            echo '<script>alert("O nome da rota já está em uso. Por favor, escolha outra.");</script>';
            echo '<script>window.location.href = "rota.php";</script>';
            exit();
        }
    }

    $sql = "UPDATE rota SET nome = ?, trem = ?, destino = ?, partida = ?, descricao = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $nome, $trem, $destino, $partida, $descricao, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Rota atualizada com sucesso.");</script>';
        echo '<script>window.location.href = "rota.php";</script>';
        exit();
    } else {
        echo "Erro ao atualizar rota: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rota</title>
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
                    <span>Editar Rota</span>
                </div>

                <!-- Card Interno -->
                <div class="corpo2">
                    <div class="titulo-sensor">
                        <i class="bi bi-broadcast-pin"></i>
                        <span>Informações da Rota</span>
                    </div>

                    <form method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($rota['id']); ?>">

                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($rota['nome']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="trem">Trem:</label>
                            <select name="trem" id="trem">
                                <option value="">Selecione</option>
                                <?php if ($resultado2) { 
                                    while ($trem = mysqli_fetch_assoc($resultado2)) { ?>
                                        <option value="<?php echo htmlspecialchars($trem['nome']); ?>">
                                            <?php echo htmlspecialchars($trem['nome']); ?>
                                        </option>
                                <?php } } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="partida">Partida:</label>
                            <input type="text" name="partida" id="partida" value="<?php echo htmlspecialchars($rota['partida']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="destino">Destino:</label>
                            <input type="text" name="destino" id="destino" value="<?php echo htmlspecialchars($rota['destino']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" value="<?php echo htmlspecialchars($rota['descricao']); ?>" required>
                        </div>

                        <div class="botoes-container">
                            <button type="button" class="btn-voltar" onclick="window.location.href='rota.php'">Voltar</button>
                            <button type="submit" class="btn-cadastrar">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <header><?php include '../../scripts/navbar2.php'; ?></header>
</body>

</html>