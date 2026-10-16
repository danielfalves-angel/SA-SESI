<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}
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

    <title>Home</title>
</head>


<body >




    <main>
        <h1 class="titulo_home">Bem-vindo, <?php echo $_SESSION['usuario']; ?>! <br> ao   <br > <span class="titulo_home2"> Orbital Trens</span> </h1>
        <p>Tipo de usuário: <?php echo $_SESSION['tipo']; ?></p>

    </main>

    
    <footer>
    </footer>

    

</body>

</html>