<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit();
}

include '../../infra/connect.php';

$resultado = mysqli_query($conn, "SELECT * FROM rota");

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="icon" type="image/png" href="../../assets/img/logoIconSemFundo.png">

    <title>Rotas</title>
</head>
   


<body>
    <div class="corpo">

    <main>
        <br>
        <br>
        <br>
        <br>
        <h1>Gerenciador de Rotas</h1>

<br>
         <a href="cadastro_rota.php"><button>Cadastrar Rotas</button></a>
         <br>
         <br>

        <div class="table_sensores">
            <div class="table_sensores_centro">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Partida</th>
                    <th>Destino</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    </div>
                    </div>
                    
                    <?php

                    while ($rota = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>{$rota['id']}</td>";
                        echo "<td>{$rota['nome']}</td>";
                        echo "<td>{$rota['partida']}</td>";
                        echo "<td>{$rota['destino']}</td>";
                        echo "<td>{$rota['descricao']}</td>";
                        echo "<td>
                                <a href='editar_rota.php?id={$rota['id']}'>Editar</a> |
                                <a href='excluir_rota.php?id={$rota['id']}' onclick=\"return confirm('Tem certeza que deseja excluir este registro?');\">Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>

    <br><br>
   
    </main>

</div>
   <header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>