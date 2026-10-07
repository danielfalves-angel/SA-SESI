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
    <title>Relatório</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="../assets/img/logoIconSemFundo.png">

</head>

<body class="min-vh-100" style="background: linear-gradient(rgba(255, 255, 255, 0.85), rgba(255, 255, 255, 0.85)), url('../assets/img/background.png') no-repeat center center fixed; background-size: cover;">
>
    <header><?php include '../scripts/navbar.php'; ?></header>

    <main class="mainm">
        <div class="gap"></div>
        <div class="caixa-p">
            <div>
                <h1>Escrever Relatório</h1>

    <?php if (!empty($erro)): ?>
        <div class="erro"><?= $erro; ?></div>
    <?php endif; ?>

    <!-- Formulário para envio -->
    <form method="POST" action="">
        <div>
            <label for="nome">Seu Nome:</label>
            <input type="text" id="nome" name="nome" required placeholder="Digite seu nome...">
        </div>
        <div>
            <label for="texto">Relatório / Comentário:</label>
            <textarea id="texto" name="texto" required placeholder="Escreva seu relatório aqui..."></textarea>
        </div>
        <button type="submit">Enviar Relatório</button>
    </form>

    <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

    <h2>Relatórios Salvos</h2>

    <!-- Lista de Relatórios -->
                <div class="lista-comentarios">
                    <?php if (empty($relatorios)): ?>
                        <p class="sem-relatorios">Nenhum relatório cadastrado ainda. Seja o primeiro a escrever!</p>
                    <?php else: ?>
                        <?php foreach ($relatorios as $r): ?>
                            <div class="comentario">
                                <div class="comentario-header">
                                    <strong><?= $r['nome']; ?></strong>
                                    <span><?= $r['data']; ?></span>
                                </div>
                                <div class="comentario-texto"><?= $r['texto']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <footer>

    </footer
</body>

</html>