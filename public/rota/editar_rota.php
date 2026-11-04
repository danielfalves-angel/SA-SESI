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

// 1. Obtém o ID da rota via parâmetro GET
$id_GET = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id_GET === 0) {
    die('ID da rota inválido ou não fornecido.');
}

// 2. Busca os dados da rota que será editada
$sql = "SELECT * FROM rota WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id_GET);
mysqli_stmt_execute($stmt);
$resultadorota = mysqli_stmt_get_result($stmt);
$rota = mysqli_fetch_assoc($resultadorota);
mysqli_stmt_close($stmt);

if (!$rota) {
    die('Rota não encontrada.');
}

// 3. Processa a atualização via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    $nome = trim($_POST['nome']);
    $trem_id = !empty($_POST['trem_id']) ? (int) $_POST['trem_id'] : null;
    $destino = trim($_POST['destino']);
    $partida = trim($_POST['partida']);
    $descricao = trim($_POST['descricao']);

    // A. Verifica se o nome digitado já está em uso por OUTRA rota
    $sql_check = "SELECT id FROM rota WHERE nome = ? AND id != ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "si", $nome, $id);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        mysqli_stmt_close($stmt_check);
        echo '<script>alert("O nome da rota já está em uso por outra rota. Por favor, escolha outro.");</script>';
        echo '<script>window.location.href = "editar_rota.php?id=' . $id . '";</script>';
        exit();
    }
    mysqli_stmt_close($stmt_check);

    // Obtém o nome descritivo do trem selecionado (para manter a coluna descritiva da tabela rota)
    $nome_trem_texto = "Ainda não possui trem";
    if ($trem_id) {
        $res_nome = mysqli_query($conn, "SELECT nome FROM trem WHERE id = " . $trem_id);
        if ($r = mysqli_fetch_assoc($res_nome)) {
            $nome_trem_texto = $r['nome'];
        }
    }

    // B. Atualiza a tabela ROTA
    $sql_update_rota = "UPDATE rota SET nome = ?, trem = ?, destino = ?, partida = ?, descricao = ? WHERE id = ?";
    $stmt_update = mysqli_prepare($conn, $sql_update_rota);
    mysqli_stmt_bind_param($stmt_update, "sssssi", $nome, $nome_trem_texto, $destino, $partida, $descricao, $id);

    if (mysqli_stmt_execute($stmt_update)) {
        mysqli_stmt_close($stmt_update);

        // C. Atualiza os vínculos da Chave Estrangeira (id_rota na tabela trem)
        
        // 1º Remove o vínculo desta rota de qualquer trem que a possuía anteriormente
        $sql_desvincular = "UPDATE trem SET id_rota = NULL WHERE id_rota = ?";
        $stmt_desv = mysqli_prepare($conn, $sql_desvincular);
        mysqli_stmt_bind_param($stmt_desv, "i", $id);
        mysqli_stmt_execute($stmt_desv);
        mysqli_stmt_close($stmt_desv);

        // 2º Se um novo trem foi selecionado, vincula ele a esta rota
        if ($trem_id) {
            $sql_vincular = "UPDATE trem SET id_rota = ? WHERE id = ?";
            $stmt_vinc = mysqli_prepare($conn, $sql_vincular);
            mysqli_stmt_bind_param($stmt_vinc, "ii", $id, $trem_id);
            mysqli_stmt_execute($stmt_vinc);
            mysqli_stmt_close($stmt_vinc);
        }

        echo '<script>alert("Rota atualizada com sucesso.");</script>';
        echo '<script>window.location.href = "rota.php";</script>';
        exit();
    } else {
        echo "Erro ao atualizar rota: " . mysqli_error($conn);
    }
}

// 4. Busca todos os trens e identifica qual trem está atualmente vinculado a esta rota
$resultado2 = mysqli_query($conn, "SELECT id, nome, id_rota FROM trem");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rota</title>
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
                    <span>Editar Rota</span>
                </div>

                <!-- Card Interno -->
                <div class="corpo2">
                    <div class="titulo-sensor">
                        <i class="bi bi-broadcast-pin"></i>
                        <span>Informações da Rota</span>
                    </div>

                    <form method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($rota['id']); ?>">

                        <div class="form-group mb-3">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($rota['nome']); ?>" required>
                        </div>

                        <!-- Menu suspenso de Seleção de Trem -->
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

                        <div class="form-group mb-3">
                            <label for="partida">Partida:</label>
                            <input type="text" name="partida" id="partida" class="form-control" value="<?php echo htmlspecialchars($rota['partida']); ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="destino">Destino:</label>
                            <input type="text" name="destino" id="destino" class="form-control" value="<?php echo htmlspecialchars($rota['destino']); ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="descricao">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo htmlspecialchars($rota['descricao']); ?>" required>
                        </div>

                        <div class="botoes-container">
                            <button type="button" class="btn-voltar" onclick="window.location.href='rota.php'">Voltar</button>
                            <button type="submit" class="btn-cadastrar">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <header><?php include '../../scripts/navbar2.php'; ?></header>
</body>

</html>