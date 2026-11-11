
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

// Obtém o ID do administrador pela URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

$resultadoUsuario = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultadoUsuario);

if (!$usuario) {
    die('Administrador não encontrado.');
}

$id_GET = $id;

// Busca todos os usuários
$sql = "SELECT * FROM usuarios";
$resultado2 = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = (int) $_POST['id'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $cargo = $_POST['cargo'];
    $status = $_POST['status'];

    include '../../scripts/analizar_senha.php';
    $seguranca = analisarSenha($senha);

    if ($seguranca !== true) {
        echo '<script>alert("A senha não atende aos requisitos mínimos: 1 Maiúscula, 4 Minúsculas, 2 Números, 1 Caractere Especial e 8 Caracteres.");</script>';
        echo '<script>window.location.href = "administradores.php";</script>';
        exit();
    }

    // Verifica se email e telefone já estão cadastrados
    while ($usuario1 = mysqli_fetch_assoc($resultado2)) {

        if ($id_GET != $usuario1['id'] && $email === $usuario1['email']) {
            echo '<script>alert("O email já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "administradores.php";</script>';
            exit();
        }

        if ($id_GET != $usuario1['id'] && $telefone === $usuario1['telefone']) {
            echo '<script>alert("O telefone já está em uso. Por favor, escolha outro.");</script>';
            echo '<script>window.location.href = "administradores.php";</script>';
            exit();
        }
    }

    // Criptografa a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Atualiza os dados incluindo o CEP
    $sql = "UPDATE usuarios
            SET nome = ?, senha = ?, email = ?, telefone = ?, cep = ?, cargo = ?, status = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        'sssssssi',
        $nome,
        $senhaHash,
        $email,
        $telefone,
        $cep,
        $cargo,
        $status,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        if (mysqli_stmt_affected_rows($stmt) >= 0) {
            echo '<script>alert("Administrador atualizado com sucesso.");</script>';
            echo '<script>window.location.href = "administradores.php";</script>';
            exit();
        }

    } else {
        echo '<script>alert("Erro ao atualizar administrador.");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Administrador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../../assets/styles/style.css">

    <link rel="icon" type="image/png" href="../../assets/img/logoIconSemFundo.png">

</head>

<body class="body3">

    <div class="corpo_2">

        <main>

            <div class="campo1">

                <div class="titulo3">
                    <i class="bi bi-pencil-square"></i>
                    <span>Editar Administrador</span>
                </div>

                <div class="corpo2">

                    <div class="titulo-sensor">
                        <i class="bi bi-broadcast-pin"></i>
                        <span>Informações do Administrador</span>
                    </div>

                    <form method="POST" id="formulario">

                        <input
                            type="hidden"
                            name="id"
                            id="id"
                            value="<?php echo htmlspecialchars($usuario['id']); ?>"
                        >

                        <div>
                            <label for="nome">Nome:</label>
                            <br>

                            <input
                                type="text"
                                name="nome"
                                id="nome"
                                value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>"
                                required
                            >
                        </div>

                        <div>
                            <label for="email">Email:</label>
                            <br>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="<?= htmlspecialchars($usuario['email'] ?? '') ?>"
                                required
                            >
                        </div>

                        <div>
                            <label for="senha">Senha:</label>
                            <br>

                            <input
                                type="password"
                                name="senha"
                                id="senha"
                                required
                            >
                        </div>

                        <div>
                            <label for="telefone">Telefone:</label>
                            <br>

                            <input
                                type="text"
                                name="telefone"
                                id="telefone"
                                value="<?= htmlspecialchars($usuario['telefone'] ?? '') ?>"
                            >
                        </div>

                        <!-- CEP -->

                        <div>
                            <label for="cep">CEP de Joinville:</label>
                            <br>

                            <input
                                type="text"
                                name="cep"
                                id="cep"
                                placeholder="89200-000"
                                maxlength="9"
                                value="<?= htmlspecialchars($usuario['cep'] ?? '') ?>"
                                onblur="validarCEPJoinville()"
                                required
                            >

                            <div id="resultado"></div>
                        </div>

                        <script>

                            async function validarCEPJoinville() {

                                const campoCep = document.getElementById('cep');
                                const resultado = document.getElementById('resultado');

                                // Remove caracteres não numéricos
                                const cep = campoCep.value.replace(/\D/g, '');

                                // 1. Validação de formato (8 dígitos)
                                if (cep.length !== 8) {
                                    resultado.innerHTML = "<p style='color: red;'>Digite um CEP válido com 8 números.</p>";
                                    return false;
                                }

                                resultado.innerHTML = "<p>Verificando...</p>";

                                try {

                                    // 2. Consulta à API do ViaCEP
                                    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                                    const data = await response.json();

                                    // 3. Validação de existência
                                    if (data.erro) {
                                        resultado.innerHTML = "<p style='color: red;'>CEP não encontrado na base de dados.</p>";
                                        return false;
                                    }

                                    // 4. Trava de Cidade: Valida se é de Joinville - SC
                                    const ehJoinville =
                                        data.localidade.toLowerCase() === 'joinville' &&
                                        data.uf === 'SC';

                                    if (!ehJoinville) {

                                        resultado.innerHTML = `
                                            <p style='color: red;'>
                                                CEP recusado. O CEP informado pertence a
                                                <strong>${data.localidade} - ${data.uf}</strong>
                                                (apenas Joinville é permitido).
                                            </p>
                                        `;

                                        return false;

                                    } else {

                                        // Sucesso
                                        resultado.innerHTML = `
                                            <p style='color: green;'><strong>CEP Válido para Joinville!</strong></p>
                                            <p>Rua: ${data.logradouro}</p>
                                            <p>Bairro: ${data.bairro}</p>
                                            <p>Cidade: ${data.localidade} - ${data.uf}</p>
                                        `;

                                        return true;
                                    }

                                } catch (error) {

                                    resultado.innerHTML = "<p style='color: red;'>Erro ao consultar o serviço de CEP.</p>";

                                    return false;
                                }
                            }

                            // Valida o CEP antes de enviar o formulário
                            document.getElementById('formulario').addEventListener('submit', async function(event) {

                                event.preventDefault();

                                const valido = await validarCEPJoinville();

                                if (valido) {
                                    this.submit();
                                } else {
                                    alert('Verifique se o CEP informado é válido e pertence a Joinville - SC.');
                                }

                            });

                            // Valida o CEP que já está preenchido ao abrir a página
                            window.addEventListener('DOMContentLoaded', function() {
                                validarCEPJoinville();
                            });

                        </script>

                        <div>
                            <label for="cargo">Cargo:</label>
                            <br>

                            <select name="cargo" id="cargo">

                                <option value="administrador" <?= (isset($usuario['cargo']) && $usuario['cargo'] === 'administrador') ? 'selected' : '' ?>>
                                    Administrador
                                </option>

                                <option value="usuario" <?= (isset($usuario['cargo']) && $usuario['cargo'] === 'usuario') ? 'selected' : '' ?>>
                                    Usuário
                                </option>

                            </select>
                        </div>

                        <div>
                            <label for="status">Status:</label>
                            <br>

                            <select name="status" id="status">

                                <option value="ativo" <?= (isset($usuario['status']) && $usuario['status'] === 'ativo') ? 'selected' : '' ?>>
                                    Ativo
                                </option>

                                <option value="inativo" <?= (isset($usuario['status']) && $usuario['status'] === 'inativo') ? 'selected' : '' ?>>
                                    Inativo
                                </option>

                            </select>
                        </div>

                        <div class="botoes-container">

                            <button
                                type="button"
                                class="btn-voltar"
                                onclick="window.location.href='administradores.php'">
                                Voltar
                            </button>

                            <button type="submit" class="btn-cadastrar">
                                Salvar Alterações
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </main>

    </div>

    <header>
        <?php include '../../scripts/navbar.php'; ?>
    </header>

</body>
</html>
