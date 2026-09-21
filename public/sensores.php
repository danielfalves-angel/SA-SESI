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
    <div class="">

    <main>
        <h1>Gerenciador de Animais</h1>
        <button><a href="public/cadastrar_animal.php"> Novo Animal</a></button>
        <button><a href="public/cadastrar_usuario.php"> Novo Usuário</a></button>
        <br>
        <br>
        <form method="POST">
            <label for="usuario">Filtro por Usuário</label>
            <select id="usuario" name="usuario">
                <option value="">Todos</option>
                <?php
                $sqlUsuarios = "SELECT * FROM usuarios";
                $resultadoUsuarios = mysqli_query($conn, $sqlUsuarios);
                while ($usuario = mysqli_fetch_assoc($resultadoUsuarios)) {
                    echo "<option value='{$usuario['id']}'>{$usuario['nome']}</option>";
                }

                ?>
            </select>
            <button type="submit">Filtrar</button>
            <br>
            <br>
        </form>
        <div class="table_animais">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>rota</th>
                    <th>Raça</th>
                    <th>Porte</th>
                    <th>Idade</th>
                    <th>ID do Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    </div>
                    <?php

                    while ($animal = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>{$animal['nome']}</td>";
                        echo "<td>{$animal['especie']}</td>";
                        echo "<td>{$animal['raca']}</td>";
                        echo "<td>{$animal['porte']}</td>";
                        echo "<td>{$animal['idade']}</td>";
                        echo "<td>{$animal['id_usuario']}</td>";
                        echo "<td>
                                <a href='public/editar_animal.php?id={$animal['id']}'>Editar</a> |
                                <a href='public/excluir_animal.php?id={$animal['id']}'>Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </main>

</div>
</body>

</html>