
<?php

include '../../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM sensor WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadoSensor = mysqli_stmt_get_result($stmt);
$sensor = mysqli_fetch_assoc($resultadoSensor);

if (!$sensor) {
    die('Sensor não encontrado.');
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar usuários: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $localizacao = trim($_POST['localizacao']);
    $tipo = trim($_POST['tipo']);
    $status = trim($_POST['status']);
    $usuario_id = (int) $_POST['usuario'];

    $sql = "UPDATE sensor SET nome = ?, localizacao = ?, tipo = ?, status = ?, id_usuario = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssiii', $nome, $localizacao, $tipo, $status, $usuario_id, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Sensor atualizado com sucesso!";
        echo "<br><a href='sensores.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao atualizar sensor: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sensor</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>

<header><?php include '../../scripts/navbar.php'; ?></header>

<body class="body3" class="min-vh-100" style="background: linear-gradient(rgba(255, 255, 255, 0.85), rgba(255, 255, 255, 0.85)), url('../../assets/img/background.png') no-repeat center center fixed; background-size: cover;">
<div class="corpo2">


    <form method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($sensor['nome']); ?>" required>
        <br>
        <label for="localizacao">Localização:</label>
        <input type="text" name="localizacao" id="localizacao" value="<?php echo htmlspecialchars($sensor['localizacao']); ?>" required>
        <br>
        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" id="tipo" value="<?php echo htmlspecialchars($sensor['tipo']); ?>" required>
        <label for="status">Status:</label>
        <input type="number" name="status" id="status" value="<?php echo htmlspecialchars($sensor['status']); ?>" required>
        <br>
        
            <?php
            while ($row = mysqli_fetch_assoc($resultado)) {
                $selected = ($row['id'] == $sensor['id_usuario']) ? 'selected' : '';
                echo "<option value='{$row['id']}' {$selected}>{$row['nome']}</option>";
            }
            ?>
        </select>
        <button type="submit">Atualizar Sensor</button>
    </form>
    <button type="button" onclick="window.location.href='sensores.php'">Voltar</button>
</div>
</body>

</html>