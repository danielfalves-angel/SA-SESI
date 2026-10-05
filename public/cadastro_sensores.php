<?php
include '../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar usuários: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $rota = $_POST['rota'];
    $unidade = $_POST['unidade_de_medida'];
    $valor = $_POST['valor'];
    $status = $_POST['status'];
    session_start(); 
$usuario_id = $_SESSION['id_usuario'] ?? null;
   

    $sql = "INSERT INTO sensor (nome, rota, unidade_de_medida, valor, status, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do sensor: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'sssdsi', $nome, $rota, $unidade, $valor, $status, $usuario_id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Sensor cadastrado com sucesso.");</script>';
        echo '<script>window.location.href = "../public/sensores.php";</script>';
        exit();
    } else {
        echo "Erro ao cadastrar sensor: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Sensores</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>


<header><?php include '../scripts/navbar.php'; ?></header>


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

         <label for="unidade_de_medida">Unidade de medida: </label>
            <select name="unidade_de_medida" id="unidade_de_medida" required>
                <option value=""> Selecione</option>
                <option value="celcius">celcius</option>
                <option value="km/h">km/h</option>
                <option value="kg">kg</option>
            </select>

                <div class="form-group">
                    <label for="rota">Rota:</label>
                    <input type="text" name="rota" id="rota" required>
                </div>

        <label for="valor">Valor:</label>
        <input type="number" name="valor" id="valor" required>
        <br>
    
        <label for="status">Status: </label>
            <select name="status" id="status">
                <option value=""> Selecione</option>
                <option value="funcionando">funcionando</option>
                <option value="defeituoso">defeituoso</option>
            </select>
            <br>
    
        <button type="submit">Cadastrar Sensor</button>
    </form>
    <button type="button" onclick="window.location.href='sensores.php'">Voltar</button>
</div>

</body>
</html>