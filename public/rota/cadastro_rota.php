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

$sql = "SELECT * FROM rota";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar Rota: ' . mysqli_error($conn));
}

$resultado2 = mysqli_query($conn, "SELECT * FROM trem");  
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $trem = $_POST['trem'];
    $destino = $_POST['destino'];
    $partida = $_POST['partida'];
    $descricao = $_POST['descricao'];

    $id = $_SESSION['id'] ?? null;

    while ($rota = mysqli_fetch_assoc($resultado)) {
        if ($nome === $rota['nome']) {
            echo '<script>alert("O nome da rota já está em uso. Por favor, escolha outra.");</script>';
            echo '<script>window.location.href = "rota.php";</script>';
            exit();
        }
    }

    $sql = "INSERT INTO rota (nome, destino, partida, descricao, id) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do rota: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssssi", $nome, $destino, $partida, $descricao, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Rota cadastrada com sucesso.");</script>';
        echo '<script>window.location.href = "rota.php";</script>';
        exit();
    } else {
        echo "Erro ao cadastrar rota: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Rota</title>
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
                    <span>Cadastrar Rota</span>
                </div>

                <div class="corpo2">
                    <div class="titulo-sensor">
                        <i class="bi bi-broadcast-pin"></i>
                        <span>Informações da Rota</span>
                    </div>

                    <form method="POST">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="trem">Trem:</label>
                            <select name="trem" id="trem" required>
                                <option value="">selecione</option>
                                <?php while ($trem = mysqli_fetch_assoc($resultado2)) { ?>
                                    <option value="<?php echo htmlspecialchars($trem['nome']); ?>">
                                        <?php echo htmlspecialchars($trem['nome']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="partida">Partida:</label>
                            <input type="text" name="partida" id="partida" required>
                        </div>

                        <div class="form-group">
                            <label for="destino">Destino:</label>
                            <input type="text" name="destino" id="destino" required>
                        </div>

                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" required>
                        </div>

                        <div class="botoes-container">
                            <button type="button" class="btn-voltar" onclick="window.location.href='rota.php'">Voltar</button>
                            <button type="submit" class="btn-cadastrar">Cadastrar Rota</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <header><?php include '../../scripts/navbar2.php'; ?></header>
</body>

</html>