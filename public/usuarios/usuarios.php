<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../index.php');
    exit();
}

include '../../infra/connect.php';

$resultado = mysqli_query($conn, "SELECT * FROM usuarios WHERE cargo = 'usuario'");

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
        <div>
            <h2>Usuários Cadastrados</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
                <?php while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $usuario["id"] ?></td>
                        <td><?php echo $usuario["nome"] ?></td>
                        <td><?php echo $usuario["email"] ?></td>
                        <td><?php echo $usuario["telefone"] ?></td>
                        <td>
                            <a href="public/editar.php?id=<?php echo $usuario["id"] ?>">Editar</a>
                            <a href="public/excluir.php?id=<?php echo $usuario["id"] ?>">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <button><a href="cadastro_usuarios.php">Adicionar Novo Usuário</a></button>
    </main>
    
   
</div>
<header><?php include '../../scripts/navbar.php'; ?></header>
</body>

</html>