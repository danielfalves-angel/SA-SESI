<?php

include '../infra/connect.php';

$resultado = mysqli_query($conn, "SELECT * FROM sensor");

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="icon" type="image/png" href="../assets/img/logoIconSemFundo.png">

    <title>Sensores</title>
</head>
   
   <header><?php include '../scripts/navbar.php'; ?></header>

<body>
    <div class="corpo">

    <main>
        <h1>Gerenciador de Sensores</h1>


        <button><a href="public/cadastrar_sensor.php"> Novo Sensor</a></button>
        <br>
        <br>
        <form method="POST">
                
            </select>
           
        </form>
        <div class="table_sensores">
            <div class="table_sensores_centro">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>rota</th>
                    <th>unidade</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>ID do Sensor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    </div>
                    </div>
                    
                    <?php

                    while ($sensor = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>{$sensor['nome']}</td>";
                        echo "<td>{$sensor['rota']}</td>";
                        echo "<td>{$sensor['unidade']}</td>";
                        echo "<td>{$sensor['valor']}</td>";
                        echo "<td>{$sensor['status']}</td>";
                        echo "<td>{$sensor['id_sensor']}</td>";
                        echo "<td>
                                <a href='public/editar_sensor.php?id={$sensor['id']}'>Editar</a> |
                                <a href='public/excluir_sensor.php?id={$sensor['id']}'>Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>
        
              <a href="cadastro_sensores.php"><button onclick="telaCadastro()">Cadastro de Sensores</button></a>
      <a href="editar_sensores.php"><button onclick="telaEditar()">Editar Sensores</button></a>
      <a href="excluir_sensor.php"><button onclick="telaExcluir()">Excluir Sensores</button></a>
    </main>

</div>
</body>

    </div>
  </div>
  </div>
  <script src="../scripts/home.js"></script>
</body>
</html>