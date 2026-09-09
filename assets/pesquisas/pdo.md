O PDO é uma extensão do PHP que faz uma interface leve e consistente pra acessar o banco de dados, ele não reescreve o SQL nem emula os recursos que não tem. Ele é usado para conectar e manipular bancos de dados em aplicações PHP de forma segura e padronizada.

Para a conexão utilizando PDO, tem que instanciar a classe PDO informando o DSN (Data Source Name, que contém o driver, o host e o nome do banco), o usuario e a senha, dentro de um bloco try/catch pra tratar os erros.

Suas principais características são: é estruturado, com um padrao de orientação a objetos, e facilita a manipulação dos dados; protege a aplicação contra ataques de SQL injection ao separar o codigo SQL dos dados enviados pelo usuario; carrega o driver especifico do banco de dados em tempo de execução, da pra trocar de SGBD sem precisar reescrever toda logica de conexão; e tem o uso de exceções (try/catch) pra gerenciar falhas de conexção ou de execução de comandos SQL de forma organizada.

Sobre as diferenças entre PDO e MySQLi, o PDO funciona em varios tipos de bancos de dados, enquanto o MySQLi serve apenas para o MySQL e o MariaDB. O PDO é orientadad a objetos. O MySQLi voce pode escolher entre o estilo orientado a objetos e o estilo procedural.

Em relação às vantagens e desvantagens de utilizar PDO:

Vantagens:
interface leve e consistente pra acessar banco de dados; suporte a multiplos bancos de dados como MySQL, PostgreSQL, SQLite e Oracle; seguranca contra SQL injection; ultiliza exceções do PHP try/catch o deixa mais eficienta a identificação e o gerenciamento de falhas.

Desvantagens:
menos performace pra centarios especificos voltados apenas para o MySQL, e extemsões dedicadas ao MYSQLi podem ter uma perda minima de desempenho; ele não expões funcionalidades exclusiva ou avançadas de um vanco de dados particular tao facilmente quanto uma API nativa; desenvolvedores iniciantes que não dominam orientação a objetos podem encontrar dificuldades no uso dos metodos de mapeamento de dados.

Prepared Statements é um recurso de banco de dados usado pra executar comandos SQL de forma pré-compilada, separando a estrutura do codigo SQL dos dados enviados pelo usuario.

O PDO pode ser uma boa escolha pra projetos em php q envolvem banco de dados relacionais e em projetos com diferentes banco de dados.