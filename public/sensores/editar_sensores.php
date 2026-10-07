
<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = ($_POST['nome']);
    $unidade = ($_POST['unidade_de_medida']);
    $rota = ($_POST['rota']);
    $valor = ($_POST['valor']);
    $status = $_POST['status'];

    $sql = "UPDATE sensor SET nome = ?, unidade_de_medida = ?, rota = ?, valor = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssidsi', $nome, $unidade, $rota, $valor, $status, $id);

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



<body class="body3">

    <div class="titulo3">
        <i class="bi bi-broadcast"></i>
        <span>Cadastro de Sensor</span>
    </div>

    <div class="container-central">
        <div class="corpo2">
            <div class="titulo-sensor">
                <i class="bi bi-broadcast-pin"></i>
                <span>Informações do Sensor</span>
            </div>

    <form method="POST">
        <label for="nome">nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($sensor['nome']); ?>" required>
        <br> 
            
         <label for="unidade_de_medida">Unidade de medida: </label>
            <select name="unidade_de_medida" id="unidade_de_medida" required>
                <option value="<?php echo htmlspecialchars($sensor['unidade_de_medida']); ?>"> <?php echo htmlspecialchars($sensor['unidade_de_medida']); ?></option>
                <option value="celcius">celcius</option>
                <option value="km/h">km/h</option>
                <option value="kg">kg</option>
            </select>

                <div class="form-group">
                    <label for="rota">Rota:</label>
                    <input type="text" name="rota" id="rota" value="<?php echo htmlspecialchars($sensor['rota']); ?>" required>
                </div>

        <label for="valor">Valor:</label>
        <input type="number" name="valor" id="valor" value="<?php echo htmlspecialchars($sensor['valor']); ?>" required>
        <br>
    
        <label for="status">Status: </label>
            <select name="status" id="status">
                <option value="<?php echo htmlspecialchars($sensor['status']); ?>"> <?php echo htmlspecialchars($sensor['status']); ?></option>
                <option value="funcionando">funcionando</option>
                <option value="defeituoso">defeituoso</option>
            </select>
            <br>
    
        <button type="submit">Editar Sensor</button>
    </form>
    <button type="button" onclick="window.location.href='sensores.php'">Voltar</button>
</div>

<header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>