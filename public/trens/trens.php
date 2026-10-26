<?php

session_start();

if (!isset($_SESSION['tipo'])) {
    header('Location: ../../index.php');
    exit();
}

include '../../infra/connect.php';

// Consulta os trens trazendo o nome da rota associada via LEFT JOIN
$sql = "SELECT trem.*, rota.nome AS nome_rota 
        FROM trem 
        LEFT JOIN rota ON trem.id_rota = rota.id";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="icon" type="image/png" href="../../assets/img/logoIconSemFundo.png">

    <title>Trens</title>
</head>

<body>
    <div class="corpo">

        <main>
            <h1 class="titulo_home2">Gerenciador de Trens</h1>
            <br>
            <a href="cadastro_trens.php"><button>Cadastrar Trens</button></a>
            <br><br>

            <div class="table_sensores">
                <div class="table_sensores_centro">
                    <table>
                        <thead>
                            <tr>
                                <th>ID do Trem</th>
                                <th>Nome</th>
                                <th>Rota</th>
                                <th>Velocidade (km/h)</th>
                                <th>Peso (kg)</th>
                                <th>Temperatura (°C)</th>
                                <th>Tempo (min)</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($trem = mysqli_fetch_assoc($resultado)) {
                                $rota_nome = !empty($trem['nome_rota']) ? htmlspecialchars($trem['nome_rota']) : 'Sem rota atribuída';

                                echo "<tr>";
                                echo "<td>{$trem['id']}</td>";
                                echo "<td>" . htmlspecialchars($trem['nome']) . "</td>";
                                echo "<td>{$rota_nome}</td>";
                                echo "<td>{$trem['velocidade']}</td>";
                                echo "<td>{$trem['peso']}</td>";
                                echo "<td>{$trem['temperatura']}</td>";
                                echo "<td>{$trem['tempo']}</td>";
                                echo "<td>{$trem['status']}</td>";
                                echo "<td>
                                        <a href='editar_trens.php?id={$trem['id']}'>Editar</a> |
                                        <a href='excluir_trens.php?id={$trem['id']}' onclick=\"return confirm('Tem certeza que deseja excluir este registro?');\">Excluir</a>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </div>

    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>