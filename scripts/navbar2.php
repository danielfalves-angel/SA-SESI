<?php

// Captura o caminho atual da URL (ex: /nome_do_usuario/SA-SESI/public/sensores/sensores.php)
$caminho_atual = $_SERVER['REQUEST_URI'];

// Pega a parte da URL até a pasta 'public/'
if (strpos($caminho_atual, '/public/') !== false) {
    // Isola o caminho desde a pasta do usuário até 'public/'
    $base_url = explode('/public/', $caminho_atual)[0] . '/public/';
} else {
    // Fallback caso a pasta public não esteja na URL
    $base_url = '/SA-SESI/public/';
}

if (isset($_SESSION['usuario'])) {

    if ($_SESSION['tipo'] === 'administrador') {

?>
        <nav class="navbar-principal">
            <div class="logo-container">
                
            <span><img class="logo" src="<?= $base_url ?>../assets/img/ChatGPT_Image_11_de_mai._de_2026__11_19_38-removebg-preview.png"
                    alt=""></span>
</div>
        </nav>
     
    <?php
        exit();
    } else {
    ?>
        <nav class="navbar-principal">
            <span><img class="logo-container" src="<?= $base_url ?>../assets/img/ChatGPT_Image_11_de_mai._de_2026__11_19_38-removebg-preview.png"
                    alt=""></span>
        </nav>

       

<?php
        exit();
    }
}


exit();


?>