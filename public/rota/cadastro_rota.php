<?php
session_start();

if (!isset($_SESSION['tipo'])) {
    header('Location: ../../index.php');
    exit();
}

include '../../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $trem_id = $_POST['trem_id'];
    $destino = $_POST['destino'];
    $partida = $_POST['partida'];
    $descricao = $_POST['descricao'];


    $sql_check = "SELECT id FROM rota WHERE nome = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "s", $nome);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        mysqli_stmt_close($stmt_check);
        echo '<script>alert("O nome da rota já está em uso. Por favor, escolha outro.");</script>';
        echo '<script>window.location.href = "rota.php";</script>';
        exit();
    }
    mysqli_stmt_close($stmt_check);

    $sql = "INSERT INTO rota (nome, trem, destino, partida, descricao) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    

    $nome_trem_texto = "Ainda não possui trem"; 
    
    if ($trem_id) {
        $res_nome = mysqli_query($conn, "SELECT nome FROM trem WHERE id = " . intval($trem_id));
        if ($r = mysqli_fetch_assoc($res_nome)) {
            $nome_trem_texto = $r['nome'];
        }
    }

    mysqli_stmt_bind_param($stmt, "sssss", $nome, $nome_trem_texto, $destino, $partida, $descricao);

    if (mysqli_stmt_execute($stmt)) {

        $nova_rota_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);


        if ($trem_id) {
            $sql_update_trem = "UPDATE trem SET id_rota = ? WHERE id = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update_trem);
            mysqli_stmt_bind_param($stmt_update, "ii", $nova_rota_id, $trem_id);
            mysqli_stmt_execute($stmt_update);
            mysqli_stmt_close($stmt_update);
        }

        echo '<script>alert("Rota cadastrada com sucesso!");</script>';
        echo '<script>window.location.href = "rota.php";</script>';
        exit();
    } else {
        echo "Erro ao cadastrar rota: " . mysqli_error($conn);
    }
}


$resultado2 = mysqli_query($conn, "SELECT * FROM trem"); 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Rota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
</head>

<body class="body3">
    <div class="corpo">
        <main>
            <div class="campo1">
                <div class="titulo3">
                    <i class="bi bi-pencil-square"></i>
                    <span>Cadastrar Rota</span>
                </div>

                <div class="corpo2">
                    <div class="titulo-sensor">
                        <i class="bi bi-broadcast-pin"></i>
                        <span>Informações da Rota</span>
                    </div>

                    <form method="POST">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="trem_id">Trem:</label>
                                <select name="trem_id" id="trem_id">
                                    <option value="">Ainda não possui trem</option>
                                <?php while ($trem = mysqli_fetch_assoc($resultado2)) { ?>
                                    <?php if($trem['id_rota'] === NULL){ ?> 
                                    <option value="<?php echo $trem['id']; ?>">
                                 <?php echo htmlspecialchars($trem['nome']); ?>
                                    </option>
                                 <?php  

                                    } else { 
                                    }
                                 } 
                                 ?>
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="partida">Partida:</label>
                            <input type="text" name="partida" id="partida" required>
                        </div>

                        <div class="form-group">
                            <label for="destino">Destino:</label>
                            <input type="text" name="destino" id="destino" required>
                        </div>

                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" required>
                        </div>

                        <div class="botoes-container">
                            <button type="button" class="btn-voltar" onclick="window.location.href='rota.php'">Voltar</button>
                            <button type="submit" class="btn-cadastrar">Cadastrar Rota</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <header><?php include '../../scripts/navbar2.php'; ?></header>
</body>

</html>