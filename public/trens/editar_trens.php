<?php
include '../../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$resultado2 = mysqli_query($conn, "SELECT * FROM rota");  
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM trem WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadotrem = mysqli_stmt_get_result($stmt);
$trem = mysqli_fetch_assoc($resultadotrem);

if (!$trem) {
    die('trem não encontrado.');
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar usuários: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $rota = trim($_POST['rota']);
    $velocidade = trim($_POST['velocidade']);
    $peso = trim($_POST['peso']);
    $temperatura = trim($_POST['temperatura']);
    $tempo = trim($_POST['tempo']);
    $status = trim($_POST['status']);
   

    $sql = "UPDATE trem SET nome = ?, rota = ?, velocidade = ?, peso = ?, temperatura = ?, tempo = ?, status = ?, id = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssddddsii', $nome, $rota, $velocidade, $peso, $temperatura, $tempo, $status, $id, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Trem atualizado com sucesso!";
        echo "<br><a href='trens.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao atualizar trem: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar trem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
</head>



<body >
<div class="corpo2">


    <form method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($trem['nome']); ?>" required>
        <br>
        <label for="rota">Rota:</label>
        <select name="rota" id="rota" required>
            <option value=""> Selecione</option>
            <?php while ($rota = mysqli_fetch_assoc($resultado2)) { ?>
                <option value="<?php echo $rota['id']; ?>"><?php echo $rota['nome']; ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="velocidade">Velocidade:</label>
        <input type="text" name="velocidade" id="velocidade" value="<?php echo htmlspecialchars($trem['velocidade']); ?>" required>
        <br>
        <label for="peso">Peso:</label>
        <input type="text" name="peso" id="peso" value="<?php echo htmlspecialchars($trem['peso']); ?>" required>
        <br>
        <label for="temperatura">Temperatura:</label>
        <input type="text" name="temperatura" id="temperatura" value="<?php echo htmlspecialchars($trem['temperatura']); ?>" required>
        <br>
        <label for="tempo">Tempo:</label>
        <input type="text" name="tempo" id="tempo" value="<?php echo htmlspecialchars($trem['tempo']); ?>" required>
        <br>
        <label for="status">Status: </label>
                <select name="status" id="status">
                    <option value=""> Selecione</option>
                    <option value="funcionando">funcionando</option>
                    <option value="defeituoso">defeituoso</option>
                </select>
                <br>
        
            <?php
            while ($row = mysqli_fetch_assoc($resultadotrem)) {
                $selected = ($row['id'] == $trem['id']) ? 'selected' : '';
                echo "<option value='{$row['id']}' {$selected}>{$row['nome']}</option>";
            }
            ?>
        </select>
        <button type="submit">Atualizar Trem</button>
    </form>
    <button type="button" onclick="window.location.href='trens.php'">Voltar</button>
</div>

<header><?php include '../../scripts/navbar2.php'; ?></header>

</body>


</html>