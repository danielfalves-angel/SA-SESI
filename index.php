<?php
include 'infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';
    $email = $_POST['email'] ?? '';

    $sql = "INSERT INTO usuarios (senha, email) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a consulta: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'ss', $senha, $email);

    if (mysqli_stmt_execute($stmt)) {
        echo "Usuário cadastrado com sucesso!";
        echo "<br><a href='public/home.php'>Voltar</a>";
        mysqli_stmt_close($stmt);
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

?>






<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/styles/style.css">
    <title>Login</title>

</head>


<body class="" id="bodyLogin">

    <header>
    </header>



    <main id="mainLogin">
        <div class="col">
            <div class="formLogin">
                <h1 id="titulo">Login</h1>
                <form id="formLogin" action="public/home.php" method="POST">
                    <div class="C-email">
                        <label class="email" for="email">Email: </label>
                        <input type="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="C-senha">
                        <label class="senha" for="senha">Senha: </label>
                        <input type="password" id="senha" placeholder="Senha" required>
                    </div>
                    <div class="d-botao">
                        <button class="btn btn-primary" class="botao" type="submit">
                            <h6 class="submit">Enviar</h6>
                        </button>
                    </div>
                    <div id="resultado"></div>
                </form>
                <div>
                    <h2 id="mensagem"></h2>
                    <div class="toggle" id="toggle">
                        <p>Não tem conta? cadastre-se</p>
                    </div>
                </div>
            </div>
        </div>


    </main>



    <footer>
    </footer>



    <script src="scripts/login.php"></script>
</body>


</html>