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
            <span><img class="logo" src="../assets/img/ChatGPT_Image_11_de_mai._de_2026__11_19_38-removebg-preview.png"
                    alt=""></span>
        </nav>

        <nav class="menu-lateral">
            <div class="botoes">
                <div class="text-icon">
                    <a href="<?= $base_url ?>home.php">
                        <button class="botao">
                            <span class="icon"><i class="bi bi-house-fill"></i></span>
                            <span class="text">Home</span>

                        </button>
                    </a>
                </div>

                <div class="text-icon">
                    <a href="<?= $base_url ?>sensores/sensores.php">
                        <button class="botao">
                            <span class="icon"><i class="bi bi-broadcast-pin"></i></span>
                            <span class="text">Sensores</span>
                        </button>
                    </a>
                </div>
            </div>

            <div class="text-icon"> 
                <a href="<?= $base_url ?>usuarios/usuarios.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-person"></i></span>
                        <span class="text">Usuários</span>
                    </button>
                </a>
            </div>
            </div>

            <div class="text-icon">
                <a href="<?= $base_url ?>administradores/administradores.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-person"></i></span>
                        <span class="text">ADMs</span>
                    </button>
                </a>
            </div>
            </div>

            <div class="text-icon">
                <a href="<?= $base_url ?>trem.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-train-front"></i></span>
                        <span class="text">Trens</span>
                    </button>
                </a>

            </div>

            <div class="text-icon">
                <a href="<?= $base_url ?>relatorios.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-envelope-paper-fill"></i></span>
                        <span class="text">Relatórios</span>
                    </button>
                </a>
            </div>

            <div class="text-icon">
                <a href="<?= $base_url ?>../scripts/logout.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                        <span class="text">Sair</span>
                    </button>
                </a>

            </div>
            </div>
        </nav>

    <?php
        exit();
    } else {
    ?>
        <nav class="navbar-principal">
            <span><img class="logo" src="../assets/img/ChatGPT_Image_11_de_mai._de_2026__11_19_38-removebg-preview.png"
                    alt=""></span>
        </nav>

        <nav class="menu-lateral">
            <div class="botoes">
                <div class="text-icon">
                    <a href="<?= $base_url ?>home.php">
                        <button class="botao">
                            <span class="icon"><i class="bi bi-house-fill"></i></span>
                            <span class="text">Home</span>

                        </button>
                    </a>
                </div>

                <div class="text-icon">
                    <a href="<?= $base_url ?>sensores/sensores.php">
                        <button class="botao">
                            <span class="icon"><i class="bi bi-broadcast-pin"></i></span>
                            <span class="text">Sensores</span>
                        </button>
                    </a>
                </div>
            </div>

            <div class="text-icon">
                <a href="<?= $base_url ?>trem.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-train-front"></i></span>
                        <span class="text">Trens</span>
                    </button>
                </a>

            </div>

            <div class="text-icon">
                <a href="<?= $base_url ?>relatorios.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-envelope-paper-fill"></i></span>
                        <span class="text">Relatórios</span>
                    </button>
                </a>
            </div>

            <div class="text-icon">
                <a href="<?= $base_url ?>logout.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                        <span class="text">Sair</span>
                    </button>
                </a>

            </div>
            </div>
        </nav>


<?php
        exit();
    }
}


exit();


?>