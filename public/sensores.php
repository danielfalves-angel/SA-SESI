<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sensores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/styles/style.css">
  <link rel="icon" type="image/png" href="../assets/img/logoIconSemFundo.png">


</head>

<body class="min-vh-100" style="background: linear-gradient(rgba(255, 255, 255, 0.85), rgba(255, 255, 255, 0.85)), url('../assets/img/background.png') no-repeat center center fixed; background-size: cover;">
>
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



  <div class="gap" id="bodySensor">
    <div class="botaoTexto">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#id</th>
            <th scope="col">Sensores</th>
            <th scope="col">Rota</th>
            <th scope="col">Unidade </th>
            <th scope="col">Valor </th>
            <th scope="col">Status </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">#1</th>
            <td>Mark</td>
            <td>645</td>
            <td>Celcius</td>
            <td>42</td>
            <td>Funcionando</td>

          </tr>
          <tr>
            <th scope="row">#2</th>
            <td>Jacob</td>
            <td>5345</td>
            <td>Km/h</td>
            <td>145</td>
            <td>Funcionando</td>

          </tr>
          <tr>
            <th scope="row">#3</th>
            <td>John</td>
            <td>395</td>
            <td>Kg</td>
            <td>163000</td>
            <td>Em manutenção</td>

          </tr>

          <tr>
            <th scope="row">#4</th>
            <td>Alberto</td>
            <td>234</td>
            <td>Celcius</td>
            <td>45</td>
            <td>Funcionando</td>

          </tr>

          <tr>
            <th scope="row">#5</th>
            <td>Pele</td>
            <td>1281</td>
            <td>Km/h</td>
            <td>203</td>
            <td>Funcionando</td>

          </tr>

          <tr>
            <th scope="row">#6</th>
            <td>Plinio</td>
            <td>5776</td>
            <td>Kg</td>
            <td>144000</td>
            <td>Funcionando</td>

          </tr>

          <tr>
            <th scope="row">#7</th>
            <td>Colin</td>
            <td>1414</td>
            <td>Km/h</td>
            <td>214</td>
            <td>Funcionando</td>

          </tr>

          <tr>
            <th scope="row">#8</th>
            <td>Tomazia</td>
            <td>2222</td>
            <td>Km/h</td>
            <td>203</td>
            <td>Funcionando</td>

          </tr>

          <tr>
            <th scope="row">#9</th>
            <td>Freitas</td>
            <td>3131</td>
            <td>Peso</td>
            <td>189000</td>
            <td>Funcionando</td>

          </tr>

          <tr>
            <th scope="row">#10</th>
            <td>Lencina</td>
            <td>1313</td>
            <td>Celcius</td>
            <td>67</td>
            <td>Funcionando</td>

          </tr>

          <tr>
            <th scope="row">@#$@#</th>
            <td>$@#$%</td>
            <td>gfdgsa234</td>
            <td>45yfg5$%#</td>
            <td>3%#$%t</td>
            <td>Defeituoso</td>

          </tr>

        </tbody>
      </table>
      <a href="cadastro.php"><button onclick="telaCadastro()">Cadastro de Sensores</button></a>
      <a href="editar.php"><button onclick="telaEditar()">Editar Sensores</button></a>
      <a href="excluir.php"><button onclick="telaExcluir()">Excluir Sensores</button></a>
    </div>
  </div>
  </div>



  <script src="../scripts/home.js"></script>
</body>

</html>