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

$sql = "SELECT * FROM sensor";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar sensor: ' . mysqli_error($conn));
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

   

    $sql = "INSERT INTO sensor (nome, descricao, unidade_de_medida, valor, tipo_de_area, localizacao, rota, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssissss', $nome, $descricao, $unidade, $valor, $area, $localizacao, $rota, $status);
    
    if ($stmt === false) {
        die('Erro ao preparar a inserção do sensor: ' . mysqli_error($conn));
    }

    

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Sensor atualizado com sucesso.");</script>';
        echo '<script>window.location.href = "sensores.php";</script>';
        exit();
    } else {
        echo "Erro ao atualizar sensor: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

$resultado = mysqli_query($conn, "SELECT * FROM usuarios WHERE cargo = 'administrador'");

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Sensores</title>
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
   


<body>
    <div class="corpo">

    <main>
        <h1>Gerenciador de Sensores</h1>



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
        <input type="text" name="nome" id="nome" required>
        <br> 

        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" required>
        <br>

        <label for="unidade_de_medida">Unidade de medida: </label>
        <select name="unidade_de_medida" id="unidade_de_medida" required>
            <option value=""> Selecione</option>
            <option value="celcius">celcius</option>
            <option value="km/h">km/h</option>
            <option value="kg">kg</option>
        </select>

        <label for="valor">Valor:</label>
        <input type="number" name="valor" id="valor" required>
        <br>

        <label for="tipo_de_area">Área:</label>
        <select name="tipo_de_area" id="tipo_de_area" required>
            <option value=""> Selecione</option>
            <option value="plano">plano</option>
            <option value="aclive">aclive</option>
            <option value="declive">declive</option>
        </select>
        <br>

        <label for="localizacao">Localização:</label>
        <input type="text" name="localizacao" id="localizacao" required>
        <br>

        <label for="rota">Rota:</label>
        <input type="text" name="rota" id="rota" required>
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
        </div>
        <button type="button" onclick="window.location.href='sensores.php'">Voltar</button>
    </div>

    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>