
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
    <header>

        <nav class="navbar-principal">
            <span><img class="logo" src="../assets/img/ChatGPT_Image_11_de_mai._de_2026__11_19_38-removebg-preview.png"
                    alt=""></span>
        </nav>

        <nav class="menu-lateral">
            <div class="botoes">
                <div class="text-icon"> 
                    <a href="home.php">
                        <button class="botao">
                            <span class="icon"><i class="bi bi-house-fill"></i></span>
                            <span class="text">Home</span>
                        </button>
                    </a>
                </div>

                <div class="text-icon">
                    <a href="sensores.php">
                        <button class="botao">
                            <span class="icon"><i class="bi bi-broadcast-pin"></i></span>
                            <span class="text">Sensores</span>
                        </button>
                    </a>
                </div>
            </div>

            <div class="text-icon">
                <a href="trem.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-train-front"></i></span>
                        <span class="text">Trens</span>
                    </button>
                </a>

            </div>

            <div class="text-icon">
                <a href="relatorios.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-envelope-paper-fill"></i></span>
                        <span class="text">Relatórios</span>
                    </button>
                </a>
            </div>

            <div class="text-icon">
                <a href=""></a>
                    <button class="botao">
                        <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                        <span class="text">Sair</span>
                    </button>

            </div>
<?php

include '../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM animais WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadoAnimal = mysqli_stmt_get_result($stmt);
$animal = mysqli_fetch_assoc($resultadoAnimal);

if (!$animal) {
    die('Animal não encontrado.');
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar usuários: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $especie = trim($_POST['especie']);
    $raca = trim($_POST['raca']);
    $porte = trim($_POST['porte']);
    $idade = (int) $_POST['idade'];
    $usuario_id = (int) $_POST['usuario'];

    $sql = "UPDATE animais SET nome = ?, especie = ?, raca = ?, porte = ?, idade = ?, id_usuario = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssiii', $nome, $especie, $raca, $porte, $idade, $usuario_id, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Animal atualizado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao atualizar animal: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <form method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($animal['nome']); ?>" required>
        <label for="rota">Rota:</label>
        <input type="text" name="rota" id="rota" value="<?php echo htmlspecialchars($animal['rota']); ?>" required>
        <label for="unidade">Unidade:</label>
        <input type="text" name="unidade" id="unidade" value="<?php echo htmlspecialchars($animal['unidade']); ?>" required>
        <label for="valor">Valor:</label>
        <input type="text" name="valor" id="valor" value="<?php echo htmlspecialchars($animal['valor']); ?>" required>
        <label for="status">Status:</label>
        <input type="number" name="status" id="status" value="<?php echo htmlspecialchars($animal['status']); ?>" required>
        
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