# Manual do Usuário - Orbital Trilhos

## 1. Introdução

Este manual explica de forma simples como usar o sistema Orbital Trilhos. O projeto foi desenvolvido para facilitar o gerenciamento de sensores, rotas, trens e acesso do usuário ao painel administrativo.

Ao entrar no sistema, o usuário pode:

- Fazer login
- Acessar a página inicial
- Visualizar sensores cadastrados
- Cadastrar novos sensores
- Editar informações existentes
- Excluir registros
- Encerrar a sessão com segurança

---

## 2. Login no sistema

### Página: index.php

A página de login é a primeira tela do sistema.

### Como acessar

1. Abra o sistema no navegador.
2. Digite seu e-mail no campo indicado.
3. Digite sua senha.
4. Clique no botão "Enviar".

### Se o login for válido

O usuário será direcionado para a página inicial do sistema, que é a tela principal de acesso.

### Se o login falhar

O sistema não permite o acesso às páginas internas. O usuário deve verificar:

- E-mail correto
- Senha correta
- Sessão ativa

> Caso não esteja autenticado, o sistema redireciona automaticamente para a página de login.

---

## 3. Página inicial

### Página: home.php

A página inicial funciona como painel principal do sistema.

Nela você encontra:

- Nome do sistema: Orbital Trilhos
- Acesso rápido para áreas do sistema
- Mapeamento de sensores
- Registro de rotas
- Registro de sensores
- Registro de trens
- Informações climáticas da região de Joinville
- Mensagem de boas-vindas com o nome do usuário logado

### Áreas principais disponíveis

- Mapeamento de sensores
- Registro de rotas
- Registro de sensores
- Registro de trens

### Informações climáticas

A página também mostra dados do clima em tempo real, como:

- Temperatura
- Umidade
- Velocidade do vento

Essas informações são úteis para acompanhar condições externas e contextos de operação.

---

## 4. Gestão de sensores

### Página: sensores.php

Esta é a tela onde ficam listados todos os sensores cadastrados no sistema.

### Campos exibidos na tabela

- ID do sensor
- Nome
- Unidade de medida
- Valor
- Localização
- Rota
- Descrição
- Status
- Ações

### Como consultar sensores

1. Acesse a página de sensores.
2. A tabela será carregada com os dados cadastrados.
3. Verifique nome, localização, rota, valor e status do sensor.

### Botões de ação

- Editar: abre o formulário para alterar os dados do sensor
- Excluir: remove o sensor após confirmação

---

## 5. Cadastro de sensores

### Página: cadastro_sensores.php

Nesta tela é possível registrar um novo sensor no sistema.

### Campos que devem ser preenchidos

- Nome do sensor
- Localização
- Unidade de medida
- Valor
- Status
- Rota
- Descrição

### Como cadastrar

1. Clique em "Cadastrar Sensores" na tela de listagem.
2. Preencha todos os campos obrigatórios.
3. Selecione a unidade de medida correta.
4. Informe o valor do sensor.
5. Escolha o status do equipamento.
6. Se necessário, selecione a rota correspondente.
7. Descreva o sensor de forma clara.
8. Clique em "Cadastrar Sensor".

### Validações do sistema

- O nome do sensor não pode ser duplicado.
- Campos obrigatórios precisam estar preenchidos.
- Caso já exista um sensor com o mesmo nome, o sistema avisa o usuário e bloqueia o cadastro.

### Após o cadastro

O sistema mostra uma mensagem de sucesso e retorna para a página de sensores.

---

## 6. Edição de sensores

### Página: editar_sensores.php

Essa tela permite alterar informações de um sensor já cadastrado.

### Como editar

1. Na lista de sensores, clique em "Editar".
2. O sistema abre o formulário com os dados atuais do sensor.
3. Modifique os campos que forem necessários.
4. Clique em "Salvar Alterações".

### O que pode ser alterado

- Nome
- Localização
- Unidade de medida
- Valor
- Status
- Rota
- Descrição

### Regras importantes

- O nome do sensor não pode coincidir com o de outro registro.
- Se houver duplicidade, o sistema exibe uma mensagem de alerta.
- As alterações só são concluídas após salvar corretamente.

---

## 7. Exclusão de sensores

### Página: excluir_sensores.php

A exclusão remove um sensor do banco de dados.

### Como excluir

1. Na tabela de sensores, clique em "Excluir".
2. O sistema pede confirmação.
3. Confirme a ação.
4. O registro será removido.

### Atenção

- A exclusão é permanente.
- Antes de confirmar, verifique se o sensor realmente deve ser removido.
- O sistema retorna à página de sensores após a exclusão.

---

## 8. Logout

### Página: logout.php

A opção de logout serve para encerrar a sessão do usuário.

### Como sair do sistema

1. Acesse a opção de logout disponível na interface.
2. O sistema destrói a sessão atual.
3. O usuário é redirecionado para a página de login.

### Importância do logout

- Protege os dados do usuário
- Evita acesso indevido após o uso
- Garante maior segurança da aplicação

---

## 9. Fluxo recomendado de uso

1. Acesse a tela de login.
2. Faça login com usuário válido.
3. Entre na página inicial.
4. Acesse a área de sensores.
5. Cadastre novos sensores quando necessário.
6. Edite informações sempre que houver alteração.
7. Exclua sensores que não forem mais utilizados.
8. Faça logout ao terminar o uso do sistema.

---

## 10. Dicas importantes

- Use nomes de sensores únicos.
- Sempre confirme a rota correta antes de salvar.
- Verifique o status do sensor antes de finalizar a edição.
- Não exclua registros sem confirmar a necessidade.
- Sempre faça logout ao encerrar a sessão.

---

## 11. Conclusão

O sistema Orbital Trilhos foi pensado para facilitar o monitoramento e a administração de sensores no ambiente ferroviário. Com o uso correto das telas de login, painel principal, cadastro, edição, exclusão e logout, o usuário consegue controlar os registros de forma simples e eficiente.

Se a rotina for seguida corretamente, o sistema oferece uma experiência prática e segura para o gerenciamento operacional.
