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
   

    $sql = "INSERT INTO sensor (nome, rota, unidade_de_medida, valor, status, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do sensor: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'sssdsi', $nome, $rota, $unidade, $valor, $status, $usuario_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Sensor cadastrado com sucesso!";
        echo "<br><a href='../public/sensores.php'>Voltar</a>";
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
</head>

<body>
    <form method="POST">
        <label for="nome">Nome do Sensor:</label>
        <input type="text" name="nome" id="nome" required>
        <br>
        <label for="rota">Rota:</label>
        <input type="text" name="rota" id="rota" required>
        <br>

         <label for="unidade_de_medida">Unidade de medida: </label>
            <select name="unidade_de_medida" id="unidade_de_medida">
                <option value=""> Selecione</option>
                <option value="celcius">celcius</option>
                <option value="km/h">km/h</option>
                <option value="kg">kg</option>
            </select>

            <br>

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
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>
</body>

</html>