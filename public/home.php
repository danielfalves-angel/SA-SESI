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




  <main class="text-white py-4 px-5" style="margin-left: 130px; margin-top: 100px; margin-right: 90px">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Seção Superior: Título e Apresentação -->
    <div class="row align-items-center my-4">
        <div class="col-lg-5 col-md-6 mb-4 mb-md-0">
            <h1 class="fw-bold" style="font-family: 'Playfair Display', serif; font-size: 10rem; line-height: 1.05; letter-spacing: 1px;">
                Orbital<br>Trilhos
            </h1>
        </div>

        <!-- Descrição à direita -->
        <div class="col-lg-7 col-md-6 ps-md-4">
                    <div>
            <p class="fw-bold mb-4" style="font-family: 'Playfair Display', serif; font-size: 2.3rem; letter-spacing: 1px;">
                <?php $nome = $_SESSION['nome']; ?>
                    <br>
                <?php echo "Olá, " . $nome . "!"?>
            </p>
            </div>
            <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif; font-size: 2.3rem; letter-spacing: 1px;">
                Conheça o futuro da inteligência ferroviária!
            </h2>
            <p class="fs-5 text-light lh-base" style="max-width: 650px; font-weight: 300;">
                Na <strong class="fw-bold">Orbital Trilhos</strong>, transformamos dados em segurança e eficiência para o setor ferroviário. Somos uma plataforma especialista no monitoramento contínuo e inteligente de sensores para malhas e trilhos de trem.
            </p>

        </div>
    </div>

    <div class="d-flex flex-wrap justify-content-between align-items-stretch gap-3 mt-5 pt-2">
<!-- Mapa -->
        <a href="../public/mapa.php" class="text-decoration-none text-dark flex-fill" style="max-width: 180px;">
            <div class="card text-center p-3 rounded-4 shadow-sm h-100 border-0" style="background-color: #f5f5f5;">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background-color: #8c8c8c;">
                    <i class="bi bi-globe-americas fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1" style="font-size: 0.8rem;">Mapeamento de sensores</h6>
                <ul class="list-unstyled text-muted mb-3" style="font-size: 0.65rem;">
                    <li>• MAPA <strong>Trem</strong></li>
                </ul>
                <div class="btn w-100 rounded-pill mt-auto" style="background-color: #4a4a4a; color: white;">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </div>
        </a>
<!-- Rota -->
         <a href="../public/rota/rota.php" class="text-decoration-none text-dark flex-fill" style="max-width: 180px;">
            <div class="card text-center p-3 rounded-4 shadow-sm h-100 border-0" style="background-color: #f5f5f5;">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background-color: #8c8c8c;">
                    <i class="bi bi-signpost-split fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1" style="font-size: 0.8rem;">Registro de rotas</h6>
                <ul class="list-unstyled text-muted mb-3" style="font-size: 0.6rem;">
                    <li>• CADASTRE / EDITE / EXCLUA<br><strong>rotas</strong></li>
                </ul>
                <div class="btn w-100 rounded-pill mt-auto" style="background-color: #4a4a4a; color: white;">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </div>
        </a>
<!-- Sensor -->
        <a href="../public/sensores/sensores.php" class="text-decoration-none text-dark flex-fill" style="max-width: 180px;">
            <div class="card text-center p-3 rounded-4 shadow-sm h-100 border-0" style="background-color: #f5f5f5;">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background-color: #8c8c8c;">
                    <i class="bi bi-broadcast fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1" style="font-size: 0.8rem;">Registro de sensores</h6>
                <ul class="list-unstyled text-muted mb-3" style="font-size: 0.6rem;">
                    <li>• CADASTRE / EDITE / EXCLUA<br><strong>sensores</strong></li>
                </ul>
                <div class="btn w-100 rounded-pill mt-auto" style="background-color: #4a4a4a; color: white;">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </div>
        </a>

        <!-- Trem -->
        <a href="../public/trens/trens.php" class="text-decoration-none text-dark flex-fill" style="max-width: 180px;">
            <div class="card text-center p-3 rounded-4 shadow-sm h-100 border-0" style="background-color: #f5f5f5;">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background-color: #8c8c8c;">
                    <i class="bi bi-train-front fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1" style="font-size: 0.8rem;">Registro de trens</h6>
                <ul class="list-unstyled text-muted mb-3" style="font-size: 0.6rem;">
                    <li>• CADASTRE / EDITE / EXCLUA<br><strong>trens</strong></li>
                </ul>
                <div class="btn w-100 rounded-pill mt-auto" style="background-color: #4a4a4a; color: white;">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </div>
        </a>

       <div class="card p-3 rounded-4 shadow-sm border-0 flex-fill" style="background-color: #f5f5f5; max-width: 220px; min-width: 190px;">
    <?php
    $url = 'https://api.open-meteo.com/v1/forecast?latitude=-26.3044&longitude=-48.8487&current=temperature_2m,relative_humidity_2m,wind_speed_10m&timezone=America%2FSao_Paulo';


    $contexto = stream_context_create([
        'http' => [
            'timeout' => 10,
            'ignore_errors' => true
        ]
    ]);


    $resposta = file_get_contents($url, false, $contexto);
    ?>


    <h6 class="fw-bold mb-3 text-dark text-start" style="font-size: 1.5rem;">
        Clima atual - Joinville
    </h6>


    <?php if ($resposta !== false): 
        $dados = json_decode($resposta, true);
        if (isset($dados['current'])): ?>
            <div class="d-flex flex-column gap-2 text-dark text-start" style="font-size: 1rem;">
                <div>
                    🌡️ Temperatura: <strong><?php echo htmlspecialchars((string)$dados['current']['temperature_2m']); ?> °C</strong>
                </div>
                <div>
                    💧 Umidade: <strong><?php echo htmlspecialchars((string)$dados['current']['relative_humidity_2m']); ?>%</strong>
                </div>
                <div>
                    💨 Vento: <strong><?php echo htmlspecialchars((string)$dados['current']['wind_speed_10m']); ?> km/h</strong>
                </div>
            </div>
        <?php else: ?>
            <p class="text-muted" style="font-size: 0.75rem;">Dados indisponíveis</p>
        <?php endif; ?>
    <?php else: ?>
        <p class="text-danger" style="font-size: 0.75rem;">Erro de conexão</p>
    <?php endif; ?>
</div>
<br>



<div class="APiClima">

</div>



    </div>
</main>

    
    <footer>
        

    </footer>

    
<header><?php include '../scripts/navbar.php'; ?></header>
</body>

</html>