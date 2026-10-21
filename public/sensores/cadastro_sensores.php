<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit();
}
                


include '../../infra/connect.php';
$resultado2 = mysqli_query($conn, "SELECT * FROM rota");  
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
    $unidade = $_POST['unidade_de_medida'];
    $valor = $_POST['valor'];
    $localizacao = $_POST['localizacao'];
    $rota = $_POST['rota'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];

    while ($sensor = mysqli_fetch_assoc($resultado)) {
        if ($nome === $sensor['nome']) {
            echo '<script>alert("O nome do sensor já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "sensores.php";</script>';
            exit();
        }
    }

    $sql = "INSERT INTO sensor (nome, descricao, unidade_de_medida, valor, localizacao, rota, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssisss', $nome, $descricao, $unidade, $valor, $localizacao, $rota, $status);
    
    if ($stmt === false) {
        die('Erro ao preparar a inserção do sensor: ' . mysqli_error($conn));
    }

    

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Sensor cadastrado com sucesso.");</script>';
        echo '<script>window.location.href = "sensores.php";</script>';
        exit();
    } else {
        echo "Erro ao cadastrar sensor: " . mysqli_error($conn);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
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

        <label for="localizacao">Localização:</label>
        <input type="text" name="localizacao" id="localizacao" required>
        <br>

        <label for="rota">Rota:</label>
        <select name="rota" id="rota" required>
            <option value=""> Selecione</option>
            <?php while ($rota = mysqli_fetch_assoc($resultado2)) { ?>
                <option value="<?php echo $rota['nome']; ?>"><?php echo $rota['nome']; ?></option>
            <?php } ?>
        </select>
        <br>

        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" required>
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

<header><?php include '../../scripts/navbar2.php'; ?></header>

</body>

</html>