<?php
include '../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar usuários: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $rota = $_POST['rota'];
    $unidade = $_POST['unidade'];
    $status = $_POST['status'];
    $usuario_id = $_POST['usuario'];

    $sql = "INSERT INTO pratos (nome, rota, unidade, status, id_usuario) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a inserção de sensor: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'ssdsi', $nome, $rota, $unidade, $status, $usuario_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Sensor cadastrado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao cadastrar sensor: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
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
    <title>Cadastro de Sensores</title>
</head>

<body>
    <header>

        <nav class="navbar-principal">
            <span><img class="logo" src="../assets/img/ChatGPT_Image_11_de_mai._de_2026__11_19_38-removebg-preview.png"
                    alt=""></span>
        </nav>

        <nav class="menu-lateral">
            <div class="botoes">
                <div class="text-icon"> 
                    <a href="home.php">
                        <button class="botao">
                            <span class="icon"><i class="bi bi-house-fill"></i></span>
                            <span class="text">Home</span>
                        </button>
                    </a>
                </div>

                <div class="text-icon">
                    <a href="sensores.php">
                        <button class="botao">
                            <span class="icon"><i class="bi bi-broadcast-pin"></i></span>
                            <span class="text">Sensores</span>
                        </button>
                    </a>
                </div>
            </div>

            <div class="text-icon">
                <a href="trem.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-train-front"></i></span>
                        <span class="text">Trens</span>
                    </button>
                </a>

            </div>

            <div class="text-icon">
                <a href="relatorios.php">
                    <button class="botao">
                        <span class="icon"><i class="bi bi-envelope-paper-fill"></i></span>
                        <span class="text">Relatórios</span>
                    </button>
                </a>
            </div>

            <div class="text-icon">
                <a href=""></a>
                    <button class="botao">
                        <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                        <span class="text">Sair</span>
                    </button>

            </div>




            </div>

        </nav>

    </header>

    <main>

        ▼<form id="formCadastro" method="POST">
            <label for="Id">Id: </label>
            <input type="number" id="id" placeholder="Digite o id do sensor">
            <label for="Nome">Nome: </label>
            <input type="text" id="nome" placeholder="Digite o nome do sensor">
            <label for="Rota">Rota: </label>
            <input type="text" id="rota" placeholder="Digite a rota">
            <label for="unidade">Selecionea unidade: </label>
            ▸ <select name="unidade" id="unidade"> </select>
            <option value="Temperatura">celcius</option>
            <option value="Velocidade">km/h</option>
            <option value="Peso">kg</option>
            <label for="valor">Valor: </label>
            <label for="status">Selecionea o status: </label>
            ▸ <select name="status" id="statussensor"> </select>
            <option value="Funcionando">funcionando</option>
            <option value="Em funcionamento">em funcionamento</option>
            <option value="Defeituoso">defeituoso</option>
            <input type="number" id="valorsensor" placeholder="Digite o valor">
            <button type="submit">Enviar</button>
            <div id="resultado"></div>
        </form>

    </main>

    <footer></footer>
    <header>

        <nav class="navbar-principal">
            <span><img class="logo" src="../assets/img/ChatGPT_Image_11_de_mai._de_2026__11_19_38-removebg-preview.png"
                    alt=""></span>
        </nav>


        <nav class="menu-lateral">
            <div class="botoes">
                <div class="text-icon">
                    <button onclick="telaHome()" class="botao">
                        <span class="icon"><i class="bi bi-house-fill"></i></span>
                        <span class="text">Home</span>
                    </button>
                </div>

                <div class="text-icon">
                    <button onclick="telaSensores()" class="botao">
                        <span class="icon"><i class="bi bi-broadcast-pin"></i></span>
                        <span class="text">Sensores</span>
                    </button>
                </div>

                <div class="text-icon">
                    <button onclick="telaTrens()" class="botao">
                        <span class="icon"><i class="bi bi-train-front"></i></span>
                        <span class="text">Trens</span>
                    </button>
                </div>

                <div class="text-icon">
                    <button onclick="telaRelatorios()" class="botao">
                        <span class="icon"><i class="bi bi-envelope-paper-fill"></i></span>
                        <span class="text">Relatórios</span>
                    </button>
                </div>

                <div class="text-icon">
                    <button onclick="telaSair()" class="botao">
                        <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                        <span class="text">Sair</span>
                    </button>
                </div>




            </div>







        </nav>


    </header>


    <main>


            
            <div class="campo">
                <div class="sensor_titulo">
                    
                </div>

                <div class="campo1">
                    <div class="icone-texto">
                        <span class="icone"><i class="bi bi-broadcast"></i></span>
                        <span><p>Inforamções de Sensores</p></span>
                    </div>
                        <form id="CadastrarSensor1">
                            <div class="flex">

                            <div>
                                <label class="caixinha" for="NomeSensor"> Nome do sensor:</label>
                                <input type="text" id="NomeSensor" placeholder="nome sensor...">
                                <br>
                                <label class="caixinha" for="UnidadeMedida"> Unidade de medida:</label>
                                <select type="text" id="UnidadeMedida" placeholder="medida">
                                    <option value=""> Medida</option>
                                    <option value="opcao1">opção 1</option>
                                    <option value="opcao2">opção 2</option>
                                    </select>
                            </div>

                            <div>
                                <label class="caixinha" for="TipoSensor"> Tipo do sensor:</label>
                                <select type="text" id="TipoSensor" placeholder="tipo">
                                    <option value=""> Selecione Tipo</option>
                                    <option value="opcao1">opção 1</option>
                                    <option value="opcao2">opção 2</option>
                                    </select>
                                <br>
                                <label class="caixinha" for="FaixaMedida"> Faixa de medida:</label>
                                <input type="text" id="FaixaMedida" placeholder="min">
                                <span>a</span>
                                <input type="text" id="FaixaMedida" placeholder="max">
                            </div>

                            <div>
                                <label class="caixinha" for="EscolerID"> Escolher ID:</label>
                                <input type="text" id="EscolherID" placeholder="Ex. XXXX-XXXX">
                                <br>
                                <label class="caixinha" for="IntervaloLeitura"> Intervalo de Leitura</label>
                                <input type="text" id="IntervaloLeitura" placeholder="Ex. 10">
                            </div>

                            <div>
                                <label class="caixinha" for="Valor"> Valor:</label>
                                <input type="text" id="Valor" placeholder="EX. 40">
                                <br>
                                <label class="caixinha" for="Descricao"> Descrição: </label>
                                <input type="text" id="Descricao" placeholder="Opcional">
                            </div>

                            </div>
                        </form>
                </div>
                
                <div class="campo2">
                    <div class="icone-texto">
                        <span class="icone"><i class="bi bi-broadcast"></i></span>
                        <span><p>Associação</p></span>
                    </div>

                    <div class="flex">
                        <div>
                             <label class="caixinha" for="Equipamento"> Equipamento: </label>
                                <select type="text" id="Equipamento" placeholder="Equipamento">
                                    <option value=""> Selecione o Equipamento</option>
                                    <option value="opcao1">opção 1</option>
                                    <option value="opcao2">opção 2</option>
                                </select>
                        </div>
                        <div>
                            <label class="caixinha" for="Localização"> Localização: </label>
                                <select type="text" id="Localização" placeholder="Localização">
                                    <option value=""> Selecione a Localização</option>
                                    <option value="opcao1">opção 1</option>
                                    <option value="opcao2">opção 2</option>
                                </select>
                        </div>
                        <div>
                            <label class="caixinha" for="Grupo"> Grupo: </label>
                                <select type="text" id="Grupo" placeholder="Grupo">
                                    <option value=""> Opcional</option>
                                    <option value="opcao1">opção 1</option>
                                    <option value="opcao2">opção 2</option>
                                </select>
                        </div>
                    </div>
                </div>
                
                <div class="campo3">

                </div>

        <div class="campo">
            <div class="sensor_titulo">

            </div>

            <div class="campo1">
                <div class="icone-texto">
                    <span class="icone"><i class="bi bi-broadcast"></i></span>
                    <span>
                        <p>Inforamções de Sensores</p>
                    </span>
                </div>
                <form id="CadastrarSensor1">
                    <div class="flex">

                        <div>
                            <label class="caixinha" for="NomeSensor"> Nome do sensor:</label>
                            <input type="text" id="NomeSensor" placeholder="nome sensor...">
                            <br>
                            <label class="caixinha" for="UnidadeMedida"> Unidade de medida:</label>
                            <select type="text" id="UnidadeMedida" placeholder="medida">
                                <option value=""> Selecione</option>
                                <option value="opcao1">opção 1</option>
                                <option value="opcao2">opção 2</option>
                            </select>
                        </div>

                        <div>
                            <label class="caixinha" for="TipoSensor"> Tipo do sensor:</label>
                            <input type="text" id="TipoSensor" placeholder="Selecione">
                            <br>
                            <label class="caixinha" for="FaixaMedida"> Faixa de medida:</label>
                            <input type="text" id="FaixaMedida">
                        </div>






                    </div>
                </form>
            </div>

            <div class="campo2">

            </div>

            <div class="campo3">

            </div>


        </div>













    </main>


    <footer>

    </footer>

    <script src="../scripts/home.js"></script>

</body>

</html>