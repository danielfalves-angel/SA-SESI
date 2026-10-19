O que é uma API?
APIs são mecanismos que permitem que dois componentes de software se comuniquem usando um conjunto de definições e protocolos. Por exemplo, o sistema de software do instituto meteorológico contém dados meteorológicos diários. A aplicação para a previsão do tempo em seu telefone “fala” com esse sistema por meio de APIs e mostra atualizações meteorológicas diárias no telefone.

O que significa API?
API significa Application Programming Interface (Interface de Programação de Aplicação). No contexto de APIs, a palavra Aplicação refere-se a qualquer software com uma função distinta. A interface pode ser pensada como um contrato de serviço entre duas aplicações. Esse contrato define como as duas se comunicam usando solicitações e respostas. A documentação de suas respectivas APIs contém informações sobre como os desenvolvedores devem estruturar essas solicitações e respostas.

Como as APIs funcionam?
A arquitetura da API geralmente é explicada em termos de cliente e servidor. A aplicação que envia a solicitação é chamada de cliente e a aplicação que envia a resposta é chamada de servidor. Então, no exemplo do clima, o banco de dados meteorológico do instituto é o servidor e o aplicativo móvel é o cliente. 

O que são APIs REST?
REST significa Transferência Representacional de Estado. REST define um conjunto de funções como GET, PUT, DELETE e assim por diante, que os clientes podem usar para acessar os dados do servidor. Clientes e servidores trocam dados usando HTTP.

A principal característica da API REST é a ausência de estado. A ausência de estado significa que os servidores não salvam dados do cliente entre as solicitações. As solicitações do cliente ao servidor são semelhantes aos URLs que você digita no navegador para visitar um site. A resposta do servidor corresponde a dados simples, sem a renderização gráfica típica de uma página da Web.

O que é API Web?
Uma API Web ou API de serviço da Web é uma interface de processamento de aplicações entre um servidor da Web e um navegador da Web. Todos os serviços da Web são APIs, mas nem todas as APIs são serviços da Web. A API REST é um tipo especial de API Web que usa o estilo de arquitetura padrão explicado acima.

Quais são os diferentes tipos de API?

APIs privadas
Elas são internos a uma empresa e são usadas apenas para conectar sistemas e dados dentro da empresa.

APIs públicas 
Estas são abertas ao público e podem ser usadas por qualquer pessoa. Pode ou não haver alguma autorização e custo associado a esses tipos de APIs.

APIs de parceiros 
Estas são acessíveis apenas por desenvolvedores externos autorizados para auxiliar as parcerias entre empresas.

APIs compostas 
Estas combinam duas ou mais APIs distintas para atender a requisitos ou comportamentos complexos do sistema. 

O que é um endpoint de API e por que ele é importante?
Os endpoints da API são os pontos de contato finais no sistema de comunicação da API. Estes incluem URLs de servidores, serviços e outros locais digitais específicos de onde as informações são enviadas e recebidas entre sistemas. Os endpoints da API são fundamentais para as empresas por dois motivos principais: 

1. Segurança
Os endpoints da API tornam o sistema vulnerável a ataques. O monitoramento da API é crucial para impedir o uso indevido.

2. Performance
Os endpoints da API, especialmente os de alto tráfego, podem causar gargalos e afetar a performance do sistema.

Quais são os Métodos HTTP (GET, POST, PUT, DELETE):

O que é HTTP?
HTTP (Protocolo de Transferência de Hipertexto) é a base da comunicação na World Wide Web. É um protocolo que define como os dados são transmitidos entre um cliente e um servidor. GET, POST, PUT, PATCH e DELETE são os métodos mais comumente usados e formam a base da comunicação entre clientes e servidores sobre o protocolo HTTP. Esses métodos definem as ações que podem ser realizadas sobre um recurso identificado por uma URL durante a comunicação cliente-servidor na World Wide Web.

Requisição
GET significa o método HTTP utilizado, algumas vezes também chamado de verbo HTTP. Ele diz que ação o cliente espera que seja executada pelo servidor. Neste caso, que lhe traga algo.

Após GET vemos um que é o caminho para o recurso que estamos buscando no servidor. Por exemplo, se desejamos acessar a página de contatos de um site esse caminho poderia se parecer com algo como /contatos.html.

Resposta
Resposta
Uma resposta contém a seguinte estrutura:

HTTP/1.1 200 OK
  Cache-Control: no-cache, must-revalidate
  Content-Type: text/html; charset=ISO-8859-1
  ...
A primeira informação que identificamos na linha 1 contém a versão do protocolo HTTP, HTTP/1.1.

Após isso vemos seguido do código de retorno e seu significado. 200 significa que a requisição foi recebida e processada pelo servidor com sucesso.

Temos abaixo desta linha os headers da resposta, a exemplo de Cache-Control e Content-Type.

GET
GET é um método HTTP usado para recuperar dados. É conhecido por suas características idempotentes e seguras e é comumente usado para buscar informações de recursos do servidor. As solicitações GET geralmente passam parâmetros na forma de uma string de consulta, e a resposta retorna o resultado no corpo da entidade para o cliente.

POST
O Método POST é um método HTTP comumente usado para enviar dados a uma API. Ao contrário dos métodos PUT e DELETE, o POST é geralmente usado para criar novos recursos e não requer que o cliente forneça uma representação completa do recurso.

PUT
O método PUT é usado para atualizar ou substituir um recurso existente no servidor. Ele requer que o cliente envie a representação completa do recurso a ser atualizado.

DELETE
O método DELETE é um método HTTP usado para remover ou excluir um recurso de um servidor. É comumente usado para instruir o servidor a excluir um recurso específico identificado pela URL ou identificador de recurso fornecido. Ao contrário de outros métodos HTTP, como GET e POST, que recuperam ou criam recursos, o método DELETE é especificamente projetado para a exclusão de recursos.

O que é JSON e para que serve?
O JSON é um formato de texto leve para troca de dados entre sistemas, estruturado em pares chave-valor. Sua sintaxe simples permite que humanos leiam as informações facilmente, enquanto máquinas as processam com alta eficiência e baixo consumo de recursos.

Ele serve prioritariamente para comunicação entre servidores e aplicações via APIs, permitindo que diferentes tecnologias troquem dados sem incompatibilidades. Além disso, é o padrão para arquivos de configuração e armazenamento flexível em bancos de dados NoSQL, garantindo portabilidade e organização.

O que significa “JSON”?
JSON é a sigla para JavaScript Object Notation (Notação de Objeto JavaScript, em português), termo criado em 2001 pela State Software. O nome foi escolhido para evitar conflitos com padrões existentes e baseia-se na sintaxe de objetos de linguagem JavaScript para facilitar a comunicação em aplicações web.

Uma aplicação PHP pode consumir uma API principalmente de três formas: usando a extensão nativa cURL (a mais recomendada e flexível), a função nativa file_get_contents() (para requisições simples do tipo GET) ou bibliotecas de terceiros via Composer (como Guzzle ou Unirest)

Importância da autenticação, autorização e segurança no consumo de APIs;
A autenticação, autorização e segurança no consumo de APIs são essenciais para proteger dados sensíveis, evitar acessos indesejados e garantir que apenas usuários e sistemas legítimos realizem operações permitidas.

Exemplos de utilização de APIs em sistemas empresariais:
1. API de voz
Que tal liberar seus colaboradores de alguns atendimentos que pouco agregam aos resultados com o apoio dessa API? Devido a ela, chamadas telefônicas, conversas via chat ou aplicativos e outras mensagens de voz são automatizadas pelo uso de Inteligência Artificial, que cria, entende ou responde a comunicações de modo independente.

2. API para SMS
Os disparos em massa de SMS são uma ferramenta capaz de melhorar o marketing e aumentar as vendas, não é mesmo? Mas também demandam muito tempo se feitos manualmente pelo seu time.

Uma API para isso amplia a produtividade, uma vez que atua como interface de conexão das operadoras de telecomunicações com os sistemas empresariais que automatizam processos, personalizando e aumentando o número de mensagens enviadas em simultâneo.

3. API para Instagram
A API para Instagram também atua para viabilizar um tipo de conexão. Nesse caso, entre essa rede social e outros sistemas — CRMs, plataformas de marketing e atendimento, aplicações financeiras e comerciais. Isso é positivo para a produtividade ao escalar a publicação de conteúdos e dar independência aos fluxos de comunicação ou de vendas.

4. API para WhatsApp
A solução para WhatsApp é outro dos exemplos de APIs de integração. Ela liga esse canal com diversas plataformas comerciais, financeiras ou de marketing. No quesito produtividade, essa tecnologia dá uma baita força, automatizando os fluxos e os registros das transações que passam por essa via.



Fontes:
https://aws.amazon.com/pt/what-is/api/
https://www.devmedia.com.br/http-requisicao-e-resposta/41217
https://tecnoblog.net/responde/o-que-e-json-conheca-o-formato-padrao-para-a-troca-de-dados-na-web/
https://www.pars.com.br/blogs/autenticacao-e-autorizacao-de-api/
https://blog.engdb.com.br/exemplos-de-api/