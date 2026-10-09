
<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
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
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $unidade = $_POST['unidade_de_medida'];
    $valor = $_POST['valor'];
    $area = $_POST['tipo_de_area'];
    $localizacao = $_POST['localizacao'];
    $rota = $_POST['rota'];
    $status = $_POST['status'];


    $sql = "UPDATE sensor SET nome = ?, descricao = ?, unidade_de_medida = ?, valor = ?, tipo_de_area = ?, localizacao = ?, rota = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssissssi', $nome, $descricao, $unidade, $valor, $area, $localizacao, $rota, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Sensor atualizado com sucesso.");</script>';
        echo '<script>window.location.href = "sensores.php";</script>';
        exit();
    } else {
        echo '<script>alert("Erro ao atualizar sensor.");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sensor</title>
    <link rel="stylesheet" href="../../assets/styles/style.css">
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

        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" value="<?php echo htmlspecialchars($sensor['descricao']); ?>" required>
        <br>

        <label for="unidade_de_medida">Unidade de medida: </label>
        <select name="unidade_de_medida" id="unidade_de_medida" required>
            <option value="<?php echo htmlspecialchars($sensor['unidade_de_medida']); ?>"> <?php echo htmlspecialchars($sensor['unidade_de_medida']); ?></option>
            <option value="celcius">celcius</option>
            <option value="km/h">km/h</option>
            <option value="kg">kg</option>
        </select>

        <label for="valor">Valor:</label>
        <input type="number" name="valor" id="valor" value="<?php echo htmlspecialchars($sensor['valor']); ?>" required>
        <br>

        <label for="tipo_de_area">Área:</label>
        <select name="tipo_de_area" id="tipo_de_area" required>
            <option value="<?php echo htmlspecialchars($sensor['tipo_de_area']); ?>"> <?php echo htmlspecialchars($sensor['tipo_de_area']); ?></option>
            <option value="plano">plano</option>
            <option value="aclive">aclive</option>
            <option value="declive">declive</option>
        </select>
        <br>

        <label for="localizacao">Localização:</label>
        <input type="text" name="localizacao" id="localizacao" value="<?php echo htmlspecialchars($sensor['localizacao']); ?>" required>
        <br>

        <label for="rota">Rota:</label>
        <input type="text" name="rota" id="rota" value="<?php echo htmlspecialchars($sensor['rota']); ?>" required>
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

</div>
</div>

    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>