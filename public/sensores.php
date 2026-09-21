</head>

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