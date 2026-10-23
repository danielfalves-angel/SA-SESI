<?php

session_start();

if (isset($_SESSION['usuario'])) {
    header('location: public/home.php');
    exit();
}

include "infra/connect.php";
$usuarios = mysqli_query($conn, "SELECT * FROM usuarios");


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/styles/style.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Login</title>


</head>


<body class="body3" id="bodyLogin">

    


    <div class="corpo">
        <main>
            <div class="campo1">
                <div class="titulo3">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </div>
                <div class="corpo2">
                    <form  action="scripts/login.php" method="POST">
                        <div class="form-group">
                            <label  for="email">Email: </label>
                            <input type="email" name="email" id="email" placeholder="Email" required>
                        </div>
                            <div class="form-group">
                                <label class="senha" for="senha">Senha: </label>
                                <input type="password" name="senha" id="senha" placeholder="Senha" required>
                            </div>
                            <div class="botoes-container">
                                <button class="btn-cadastrar"  type="submit">
                                    <h6 >Enviar</h6>
                                </button>
                            </div>
                            <div id="resultado"></div>
                        </form>
                </div>
                    <div>
                        <h2 id="mensagem"></h2>
                        <div class="toggle" id="toggle">
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>



    <footer>
    </footer>



</body>


</html>