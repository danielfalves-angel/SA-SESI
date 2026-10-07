<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

include '../../infra/connect.php';

$resultado = mysqli_query($conn, "SELECT * FROM usuarios WHERE cargo = 'administrador'");

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

    <title>Usuários Cadastrados</title>
</head>
   


<body>
    <div class="corpo">

    <main>
        <h1>Gerenciador de Sensores</h1>


    
        <br>
        <br>
        <form method="POST">
                
            </select>
           
        </form>
        <div class="table_usuarios">
            <div class="table_usuarios_centro">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Cargo</th>
                    <th>Status</th>
                    <th>ID do Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    </div>
                    </div>
                    
                    <?php

                    while ($usuario = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>{$usuario['nome']}</td>";
                        echo "<td>{$usuario['email']}</td>";
                        echo "<td>{$usuario['telefone']}</td>";
                        echo "<td>{$usuario['cargo']}</td>";
                        echo "<td>{$usuario['status']}</td>";
                        echo "<td>{$usuario['id']}</td>";
                        echo "<td>
                                <a href='editar_usuarios.php?id={$usuario['id']}'>Editar</a> |
                                <a href='excluir_usuarios.php?id={$usuario['id']}' onclick=\"return confirm('Tem certeza que deseja excluir este usuario?');\">Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>
        
              <a href="cadastro_usuarios.php"><button">Cadastrar Usuários</button></a>

    </main>
    
   
</div>
<header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>