<?php
include '../../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM rota WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadorota = mysqli_stmt_get_result($stmt);
$rota = mysqli_fetch_assoc($resultadorota);

if (!$rota) {
    die('Rota não encontrada.');
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar usuários: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $destino = trim($_POST['destino']);
    $partida = trim($_POST['partida']);
    $descricao = trim($_POST['descricao']);
    $id = (int) $_POST['id'];

    $sql = "UPDATE rota SET nome = ?, destino = ?, partida = ?, descricao = ?, id = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param ($stmt, "ssssi", $nome, $destino, $partida, $descricao,$id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Rota atualizada com sucesso!";
        echo "<br><a href='rota.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao atualizar rota: " . mysqli_error($conn);
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



<body class="body3" class="min-vh-100" style="background: linear-gradient(rgba(255, 255, 255, 0.85), rgba(255, 255, 255, 0.85)), url('../../assets/img/background.png') no-repeat center center fixed; background-size: cover;">
<div class="corpo2">


    <form method="POST">

        <label for="id">Id da Rota:</label>
        <input type="number" name="id" id="id" value="<?php echo htmlspecialchars($rota['id']); ?>" required>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($rota['nome']); ?>" required>
        <br>
        <label for="partida">Partida:</label>
        <input type="text" name="partida" id="partida" value="<?php echo htmlspecialchars($rota['partida']); ?>" required>
        <br>
        <label for="destino">Destino:</label>
        <input type="text" name="destino" id="destino" value="<?php echo htmlspecialchars($rota['destino']); ?>" required>
        <br>
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" value="<?php echo htmlspecialchars($rota['descricao']); ?>" required>
        <br>
                <br>
        
            <?php
            while ($row = mysqli_fetch_assoc($resultadorota)) {
                $selected = ($row['id'] == $rota['id']) ? 'selected' : '';
                echo "<option value='{$row['id']}' {$selected}>{$row['nome']}</option>";
            }
            ?>
        </select>
        <button type="submit">Atualizar Rota</button>
    </form>
    <button type="button" onclick="window.location.href='rota.php'">Voltar</button>
</div>
<header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>