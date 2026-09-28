
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Editar Sensores</title>
</head>

<body class="min-vh-100" style="background: linear-gradient(rgba(255, 255, 255, 0.85), rgba(255, 255, 255, 0.85)), url('../assets/img/background.png') no-repeat center center fixed; background-size: cover;">
>

<header><?php include '../scripts/navbar.php'; ?></header>

<?php

include '../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM sensores WHERE id = ?";
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

    $sql = "UPDATE sensores SET nome = ?, localizacao = ?, tipo = ?, status = ?, id_usuario = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssiii', $nome, $localizacao, $tipo, $status, $usuario_id, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Sensor atualizado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
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
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <form method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($sensor['nome']); ?>" required>
        <label for="localizacao">Localização:</label>
        <input type="text" name="localizacao" id="localizacao" value="<?php echo htmlspecialchars($sensor['localizacao']); ?>" required>
        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" id="tipo" value="<?php echo htmlspecialchars($sensor['tipo']); ?>" required>
        <label for="status">Status:</label>
        <input type="number" name="status" id="status" value="<?php echo htmlspecialchars($sensor['status']); ?>" required>
        
            <?php
            while ($row = mysqli_fetch_assoc($resultado)) {
                $selected = ($row['id'] == $sensor['id_usuario']) ? 'selected' : '';
                echo "<option value='{$row['id']}' {$selected}>{$row['nome']}</option>";
            }
            ?>
        </select>
        <button type="submit">Atualizar Sensor</button>
    </form>
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>

</body>

</html>



            </div>

        </nav>

    </header>

    <footer></footer>
    <script src="../scripts/home.js"></script>
</body>

</html>