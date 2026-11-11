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
    $cargo = $_POST['cargo'];
    $status = $_POST['status'];
    $id = $_SESSION['id'] ?? null;

    include '../../scripts/analizar_senha.php';
    $seguranca = analisarSenha($senha);

    if ($seguranca !== true) {
        echo '<script>alert("A senha não atende aos requisitos mínimos: 1 Maiúscula, 4 Minúsculas, 2 Números, 1 Caractere Especial e 8 Caracteres.");</script>';
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    }

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

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, senha, email, telefone, cargo, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção do usuario: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'ssssss', $nome, $senhaHash, $email, $telefone, $cargo, $status);

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

                            <label for="cep">CEP de Joinville:</label>
                            <br>
                            <input type="text" id="cep" placeholder="89200-000" maxlength="9" onblur="validarCEPJoinville()">
  
  <div id="resultado"></div>

  <script>
    async function validarCEPJoinville() {
      const campoCep = document.getElementById('cep');
      const resultado = document.getElementById('resultado');
      
      // Remove caracteres não numéricos
      const cep = campoCep.value.replace(/\D/g, '');

      // 1. Validação de formato (8 dígitos)
      if (cep.length !== 8) {
        resultado.innerHTML = "<p style='color: red;'>Digite um CEP válido com 8 números.</p>";
        return;
      }

      resultado.innerHTML = "<p>Verificando...</p>";

      try {
        // 2. Consulta à API do ViaCEP
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        // 3. Validação de existência
        if (data.erro) {
          resultado.innerHTML = "<p style='color: red;'>CEP não encontrado na base de dados.</p>";
          return;
        }

        // 4. Trava de Cidade: Valida se é de Joinville - SC
        const ehJoinville = data.localidade.toLowerCase() === 'joinville' && data.uf === 'SC';

        if (!ehJoinville) {
          resultado.innerHTML = `<p style='color: red;'>CEP recusado. O CEP informado pertence a <strong>${data.localidade} - ${data.uf}</strong> (apenas Joinville é permitido).</p>`;
        } else {
          // Sucesso
          resultado.innerHTML = `
            <p style='color: green;'><strong>CEP Válido para Joinville!</strong></p>
            <p>Rua: ${data.logradouro}</p>
            <p>Bairro: ${data.bairro}</p>
            <p>Cidade: ${data.localidade} - ${data.uf}</p>
          `;
        }

      } catch (error) {
        resultado.innerHTML = "<p style='color: red;'>Erro ao consultar o serviço de CEP.</p>";
      }
    }
  </script>

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
                            <button type="button" class="btn-voltar" onclick="window.location.href='usuarios.php'">Cancelar</button>
                            <button type="submit" class="btn-cadastrar">Cadastrar Usuário</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <header><?php include '../../scripts/navbar.php'; ?></header>
</body>
</html>