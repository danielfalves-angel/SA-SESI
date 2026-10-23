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
            <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif; font-size: 2.3rem; letter-spacing: 1px;">
                O futuro da inteligência ferroviária!!
            </h2>
            <p class="fs-5 text-light lh-base" style="max-width: 650px; font-weight: 300;">
                Na <strong class="fw-bold">Orbital Trilhos</strong>, transformamos dados em segurança e eficiência para o setor ferroviário. Somos uma plataforma especialista no monitoramento contínuo e inteligente de sensores para malhas e trilhos de trem.
            </p>

        </div>
    </div>

    <div class="d-flex flex-wrap justify-content-between align-items-stretch gap-3 mt-5 pt-2">
        
        <a href="../scripts/logout.php" class="text-decoration-none text-dark flex-fill" style="max-width: 180px;">
            <div class="card text-center p-3 rounded-4 shadow-sm h-100 border-0" style="background-color: #f5f5f5;">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background-color: #8c8c8c;">
                    <i class="bi bi-box-arrow-right fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1">Sair</h6>
                <ul class="list-unstyled text-muted mb-3" style="font-size: 0.7rem;">
                    <li>• Realizar o Logout</li>
                </ul>
                <div class="btn w-100 rounded-pill mt-auto" style="background-color: #4a4a4a; color: white;">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </div>
        </a>

        <a href="../public/relatorios.php" class="text-decoration-none text-dark flex-fill" style="max-width: 180px;">
            <div class="card text-center p-3 rounded-4 shadow-sm h-100 border-0" style="background-color: #f5f5f5;">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background-color: #8c8c8c;">
                    <i class="bi bi-file-earmark-text fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1">Relatorios</h6>
                <ul class="list-unstyled text-muted mb-3" style="font-size: 0.7rem;">
                    <li>• Relatorios <strong>Trem</strong></li>
                </ul>
                <div class="btn w-100 rounded-pill mt-auto" style="background-color: #4a4a4a; color: white;">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </div>
        </a>

        <a href="../public/mapa.php" class="text-decoration-none text-dark flex-fill" style="max-width: 180px;">
            <div class="card text-center p-3 rounded-4 shadow-sm h-100 border-0" style="background-color: #f5f5f5;">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background-color: #8c8c8c;">
                    <i class="bi bi-train-front fs-2"></i>
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

        <a href="../public/usuarios/usuarios.php" class="text-decoration-none text-dark flex-fill" style="max-width: 180px;">
            <div class="card text-center p-3 rounded-4 shadow-sm h-100 border-0" style="background-color: #f5f5f5;">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; background-color: #8c8c8c;">
                    <i class="bi bi-person fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1" style="font-size: 0.8rem;">Registro de usuario</h6>
                <ul class="list-unstyled text-muted mb-3" style="font-size: 0.6rem;">
                    <li>• CADASTRE / EDITE / EXCLUA<br><strong>usuarios</strong></li>
                </ul>
                <div class="btn w-100 rounded-pill mt-auto" style="background-color: #4a4a4a; color: white;">
                    <i class="bi bi-arrow-right"></i>
                </div>
            </div>
        </a>
<br>



<div class="APiClima">
<?php
$url = 'https://api.open-meteo.com/v1/forecast?latitude=-26.3044&longitude=-48.8487&current=temperature_2m,relative_humidity_2m,wind_speed_10m&timezone=America%2FSao_Paulo';

$contexto = stream_context_create([
    'http' => [
        'timeout' => 10,
        'ignore_errors' => true
    ]
]);

$resposta = file_get_contents($url, false, $contexto);

echo '<div class="clima">';
echo '<h2>Clima atual - Joinville</h2>';

if ($resposta === false) {
    $erro = error_get_last();
    echo '<p>Erro de conexão: ' .
        htmlspecialchars($erro['message'] ?? 'Erro desconhecido') .
        '</p>';
} else {
    $dados = json_decode($resposta, true);

    if (isset($dados['current'])) {
        echo '<p>🌡️ Temperatura: ' .
            htmlspecialchars((string)$dados['current']['temperature_2m']) .
            ' °C</p>';

        echo '<p>💧 Umidade: ' .
            htmlspecialchars((string)$dados['current']['relative_humidity_2m']) .
            '%</p>';

        echo '<p>💨 Vento: ' .
            htmlspecialchars((string)$dados['current']['wind_speed_10m']) .
            ' km/h</p>';
    } else {
        echo '<p>Resposta recebida, mas os dados não foram encontrados.</p>';
        echo '<pre>' . htmlspecialchars(substr($resposta, 0, 1000)) . '</pre>';
    }
}

echo '</div>';
?>
</div>



    </div>
</main>

    
    <footer>
    </footer>

    
<header><?php include '../scripts/navbar.php'; ?></header>
</body>

</html>