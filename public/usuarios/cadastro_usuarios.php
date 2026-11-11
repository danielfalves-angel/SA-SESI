
<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'administrador') {
    header('Location: ../../index.php');
    exit();
}

include '../../infra/connect.php';

if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$sql = "SELECT * FROM usuarios";
$usuarios = mysqli_query($conn, $sql);

if ($usuarios === false) {
    die('Erro ao consultar usuarios: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = preg_replace('/\D/', '', $_POST['cep'] ?? '');
    $cargo = $_POST['cargo'];
    $status = $_POST['status'];
    $id = $_SESSION['id'] ?? null;

    // Validação do formato do CEP
    if (!preg_match('/^\d{8}$/', $cep)) {
        echo '<script>alert("CEP inválido. Informe um CEP com 8 números.");</script>';
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    }

    // Consulta à API ViaCEP
    $url = "https://viacep.com.br/ws/" . $cep . "/json/";

    $contexto = stream_context_create([
        'http' => [
            'timeout' => 5,
            'ignore_errors' => true
        ]
    ]);

    $resposta = @file_get_contents($url, false, $contexto);

    if ($resposta === false) {
        echo '<script>alert("Não foi possível consultar o CEP. Tente novamente.");</script>';
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    }

    $dadosCep = json_decode($resposta, true);

    // Verifica se o CEP existe
    if (!is_array($dadosCep) || isset($dadosCep['erro'])) {
        echo '<script>alert("CEP não encontrado.");</script>';
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    }

    // Verifica se pertence a Joinville - SC
    if (
        strtoupper(trim($dadosCep['localidade'] ?? '')) !== 'JOINVILLE' ||
        strtoupper(trim($dadosCep['uf'] ?? '')) !== 'SC'
    ) {
        echo '<script>alert("O CEP informado não pertence a Joinville - SC.");</script>';
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    }

    // Validação da senha
    include '../../scripts/analizar_senha.php';
    $seguranca = analisarSenha($senha);

    if ($seguranca !== true) {
        echo '<script>alert("A senha não atende aos requisitos mínimos: 1 Maiúscula, 4 Minúsculas, 2 Números, 1 Caractere Especial e 8 Caracteres.");</script>';
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    }

    // Verifica email e telefone duplicados
    while ($usuario = mysqli_fetch_assoc($usuarios)) {
        if ($email === $usuario['email']) {
            echo '<script>alert("O email já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "usuarios.php";</script>';
            exit();
        }

        if ($telefone === $usuario['telefone']) {
            echo '<script>alert("O telefone já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "usuarios.php";</script>';
            exit();
        }
    }

    // Criptografa a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere os dados, incluindo o CEP
    $sql = "INSERT INTO usuarios (nome, senha, email, telefone, cep, cargo, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do usuario: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        'sssssss',
        $nome,
        $senhaHash,
        $email,
        $telefone,
        $cep,
        $cargo,
        $status
    );

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Usuário cadastrado com sucesso.");</script>';
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Usuários</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../../assets/styles/style.css">

    <link rel="icon" type="image/png" href="../../assets/img/logoIconSemFundo.png">

</head>

<body class="body3">

    <div class="corpo">

        <main>

            <div class="campo1">

                <div class="titulo3">
                    <i class="bi bi-pencil-square"></i>
                    <span>Cadastrar Usuário</span>
                </div>

                <div class="corpo2">

                    <div class="titulo-sensor">
                        <i class="bi bi-broadcast-pin"></i>
                        <span>Informações do Usuário</span>
                    </div>

                    <form method="POST">

                        <div>
                            <label for="nome">Nome:</label>
                            <br>
                            <input type="text" name="nome" id="nome" required>
                        </div>

                        <div>
                            <label for="email">Email:</label>
                            <br>
                            <input type="email" name="email" id="email" required>
                        </div>

                        <div>
                            <label for="senha">Senha:</label>
                            <br>
                            <input type="password" name="senha" id="senha" required>
                        </div>

                        <div>
                            <label for="telefone">Telefone:</label>
                            <br>
                            <input type="text" name="telefone" id="telefone" required>
                        </div>

                        <!-- Campo CEP -->
                        <div>
                            <label for="cep">CEP:</label>
                            <br>
                            <input
                                type="text"
                                name="cep"
                                id="cep"
                                maxlength="9"
                                placeholder="00000-000"
                                autocomplete="postal-code"
                                required
                            >
                            <small id="statusCep" class="text-muted"></small>
                        </div>

                        <div>
                            <label for="cargo">Cargo:</label>
                            <br>

                            <select name="cargo" id="cargo" required>
                                <option value="">selecione</option>
                                <option value="usuario">Usuário</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>

                        <div>
                            <label for="status">Status:</label>
                            <br>

                            <select name="status" id="status" required>
                                <option value="">selecione</option>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>

                        <div class="botoes-container">

                            <button
                                type="button"
                                class="btn-voltar"
                                onclick="window.location.href='usuarios.php'">
                                Cancelar
                            </button>

                            <button type="submit" class="btn-cadastrar">
                                Cadastrar Usuário
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </main>

    </div>

    <!-- POP-UP COM INFORMAÇÕES DO CEP -->
    <div class="modal fade" id="modalCep" tabindex="-1" aria-labelledby="tituloModalCep" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="tituloModalCep">
                        <i class="bi bi-geo-alt-fill"></i>
                        Informações do CEP
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fechar">
                    </button>

                </div>

                <div class="modal-body">

                    <div id="carregandoCep" class="text-center d-none">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Consultando CEP...</p>
                    </div>

                    <div id="informacoesCep" class="d-none">

                        <p>
                            <strong>CEP:</strong>
                            <span id="infoCep"></span>
                        </p>

                        <p>
                            <strong>Logradouro:</strong>
                            <span id="infoLogradouro"></span>
                        </p>

                        <p>
                            <strong>Bairro:</strong>
                            <span id="infoBairro"></span>
                        </p>

                        <p>
                            <strong>Cidade:</strong>
                            <span id="infoCidade"></span>
                        </p>

                        <p>
                            <strong>Estado:</strong>
                            <span id="infoEstado"></span>
                        </p>

                        <div id="resultadoCep" class="alert mt-3 mb-0"></div>

                    </div>

                    <div id="erroCep" class="alert alert-danger d-none">
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Fechar
                    </button>

                </div>

            </div>

        </div>

    </div>

    <header>
        <?php include '../../scripts/navbar.php'; ?>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        const campoCep = document.getElementById('cep');
        const statusCep = document.getElementById('statusCep');

        const modalElemento = document.getElementById('modalCep');
        const modalCep = new bootstrap.Modal(modalElemento);

        const carregandoCep = document.getElementById('carregandoCep');
        const informacoesCep = document.getElementById('informacoesCep');
        const erroCep = document.getElementById('erroCep');

        let ultimoCepConsultado = '';
        let consultaAtual = 0;

        // Máscara automática do CEP
        campoCep.addEventListener('input', function () {

            let cep = this.value.replace(/\D/g, '');

            if (cep.length > 8) {
                cep = cep.substring(0, 8);
            }

            if (cep.length > 5) {
                cep = cep.replace(/^(\d{5})(\d)/, '$1-$2');
            }

            this.value = cep;

            statusCep.textContent = '';
            ultimoCepConsultado = '';

        });

        // Consulta o CEP quando o usuário termina de digitar
        campoCep.addEventListener('blur', consultarCep);

        async function consultarCep() {

            const cep = campoCep.value.replace(/\D/g, '');

            if (cep.length !== 8) {
                return;
            }

            if (cep === ultimoCepConsultado) {
                return;
            }

            ultimoCepConsultado = cep;

            const numeroConsulta = ++consultaAtual;

            // Limpa as informações anteriores
            informacoesCep.classList.add('d-none');
            erroCep.classList.add('d-none');
            carregandoCep.classList.remove('d-none');

            statusCep.textContent = 'Consultando CEP...';

            // Abre o pop-up
            modalCep.show();

            try {

                const resposta = await fetch(
                    `https://viacep.com.br/ws/${cep}/json/`
                );

                if (!resposta.ok) {
                    throw new Error('Não foi possível consultar o CEP.');
                }

                const dados = await resposta.json();

                // Evita mostrar o resultado de uma consulta antiga
                if (numeroConsulta !== consultaAtual) {
                    return;
                }

                carregandoCep.classList.add('d-none');

                // Verifica se o CEP existe
                if (dados.erro) {

                    erroCep.textContent = 'CEP não encontrado. Verifique os números informados.';

                    erroCep.classList.remove('d-none');

                    statusCep.textContent = 'CEP não encontrado.';

                    return;
                }

                // Preenche as informações do pop-up
                document.getElementById('infoCep').textContent = dados.cep || '-';

                document.getElementById('infoLogradouro').textContent =
                    dados.logradouro || 'Não informado';

                document.getElementById('infoBairro').textContent =
                    dados.bairro || 'Não informado';

                document.getElementById('infoCidade').textContent =
                    dados.localidade || 'Não informado';

                document.getElementById('infoEstado').textContent =
                    dados.uf || 'Não informado';

                const resultado = document.getElementById('resultadoCep');

                // Verifica se pertence a Joinville - SC
                if (
                    (dados.localidade || '').trim().toUpperCase() === 'JOINVILLE' &&
                    (dados.uf || '').trim().toUpperCase() === 'SC'
                ) {

                    resultado.className = 'alert alert-success mt-3 mb-0';

                    resultado.textContent =
                        'CEP válido! Este endereço pertence a Joinville - SC.';

                    statusCep.textContent = 'CEP válido!';

                } else {

                    resultado.className = 'alert alert-danger mt-3 mb-0';

                    resultado.textContent =
                        'CEP inválido para cadastro. O endereço não pertence a Joinville - SC.';

                    statusCep.textContent = 'CEP fora de Joinville - SC.';

                }

                informacoesCep.classList.remove('d-none');

            } catch (erro) {

                if (numeroConsulta !== consultaAtual) {
                    return;
                }

                carregandoCep.classList.add('d-none');

                erroCep.textContent =
                    'Erro ao consultar o CEP. Verifique sua conexão e tente novamente.';

                erroCep.classList.remove('d-none');

                statusCep.textContent = 'Erro na consulta do CEP.';

                ultimoCepConsultado = '';

            }

        }

    </script>

</body>

</html>
