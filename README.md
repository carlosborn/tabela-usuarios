# Tabela de Usuários


## Objetivo do software
### Listar usuários cadastrados no banco de dados.


## Programas necessários
* Git versão 2 ou superior;
* Apache Server versão 2 ou superior ;
* MySQL versão 5.31 ou superior ;
* PHP versão 5.6 ou superior ;
* Navegador de internet (preferência do usuário).

## **Instalação**

### **Linux**

> É extremamente recomendado que, antes de realizar a instalação de quaisquer softwares, utilize os comandos *update* e *upgrade* para garantir as versões mais recentes de todos programas instalados.

### **Instalação do Git**
Antes de mais nada, vamos realizar a instalação do Git, para conseguirmos clonar nosso repositório para a máquina local. Para isto, execute o seguinte comando:

    sudo apt install git git-core

Podemos verificar se a instalação foi feita de forma correta, usando o comando --version:

    git --version

Deverá lhe exibir algo como:

    git version 2.25.1

### **Configuração do usuário Git**
Para configurarmos o usuário:
    
    git config --global user.name '<nome_usuario>'
    git config --global user.email '<email>'

> Substitua as tags **nome_usuario** e **email** pelos seus dados.

### **Instalação do Apache Server**

Para executarmos nosso programa, precisamos instalar o Apache Server. Abra o terminal e digite o seguinte comando:

    sudo apt install apache2

> Caso aja algum problema na instalação do Apache, consulte sua documentação oficial [clicando aqui](https://httpd.apache.org/docs-project/).

### **Verificar instalação do Apache**

Após a instalação do Apache, abra seu navegador e, na parte superior, digite:
    
    localhost
ou

    127.0.0.1

Caso tudo ocorreu corretamente, ele irá abrir uma tela semelhante a esta:

![Ubuntu localhost](https://s1.dmcdn.net/v/Aijbi1LhsKC6KQ_XD/x1080)

### **Instalação do MySQL**

Ainda no terminal do Ubuntu, vamos instalar o MySQL.

    sudo apt install mysql-server

> Caso aja algum problema na instalação do MySQL, consulte sua documentação oficial [clicando aqui](https://dev.mysql.com/doc/).

O MySQL deverá iniciar de forma automática após a instalação, mas para garantia, vamos verificar seu status.

    sudo systemctl status mysql

Exemplo de saída

    mysql.service - MySQL Community Server
    Loaded: loaded (/lib/systemd/system/mysql.service; enabled; vendor preset: enabled)
    Active: active (running) since Wed 2018-06-20 11:30:23 PDT; 5min ago
    Main PID: 17382 (mysqld)
    Tasks: 27 (limit: 2321)
    CGroup: /system.slice/mysql.service
           `-17382 /usr/sbin/mysqld --daemonize --pid-file=/run/mysqld/mysqld.pid

### **Configuração do MySQL**
Para configurarmos o MySQL, vamos rodar o comando ***mysql_secure_installation*** no terminal.

    sudo mysql_secure_installation

Na primeira opção, ele pedirá para se deseja validar senhas do usuário do MySQL. Para os fins do programa, podemos negar esta validação pressionando ENTER.

Em seguida, você definirá a senha do usuário root. Como ele ainda não possui nenhuma senha, você primeiramente pressionará ENTER, e após o programa solicitará uma nova senha para root.

Nas demais questões, pode-se marcar sim (Y) para todas.

### **Login no MySQL como usuário root**

Para entrar no MySQL, digite no console:
  
    sudo mysql

Ele abrirá o shell do MySQL, como no exemplo:

    Welcome to the MySQL monitor.  Commands end with ; or \g.
    Your MySQL connection id is 10
    Server version: 8.0.22-0ubuntu0.20.04.2 (Ubuntu)

    Copyright (c) 2000, 2020, Oracle and/or its affiliates. All rights reserved.

    Oracle is a registered trademark of Oracle Corporation and/or its
    affiliates. Other names may be trademarks of their respective
    owners.

    Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

### **Configurar usuário root**
Para conseguirmos utilizar o usuário root na nossa aplicação, precisamos realizar algumas alterações. Rode o comando abaixo realizando as substituições:

    ALTER USER '<nome_de_usuario>'@'localhost' IDENTIFIED WITH mysql_native_password BY '<senha_do_usuario>';
    FLUSH PRIVILEGES;
    exit;

Este comando fará com que o MySQL permita a utilização do usuário desejado em aplicações externas.


### **Criação do banco de dados e inserção dos dados**

Ao acessar o MySQL, vamos criar a base do banco de dados.

    CREATE DATABASE trabalho;

> Crie o nome da base de dados exatamente igual ao repassado!

Após isto, crie a tabela que usaremos para armazenar as informações:

    CREATE TABLE usuarios (id INTEGER AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(50), status CHAR(1));

Desta forma, vamos aplicar dados nestas tabela.

    INSERT INTO usuarios (nome,status) VALUES ('Carlos' , 'i'),('Pedro' , 'a'),('João' , 'a'),('Afonso' , 'a'),('Rafaela' , 'a'),('Maria' , 'i');

Para garantirmos que os dados foram gravados com sucesso, vamos realizar um comando de ***select***:

    SELECT * FROM usuarios;

Sua saída deve ser semelhante a esta:

    +----+---------+--------+
    | id | nome    | status |
    +----+---------+--------+
    |  1 | Carlos  | i      |
    |  2 | Pedro   | a      |
    |  3 | João    | a      |
    |  4 | Afonso  | a      |
    |  5 | Rafaela | a      |
    |  6 | Maria   | i      |
    +----+---------+--------+

### **Instalação do PHP e driver PHP-MySQL**
Agora, por último, vamos realizar a instalação do PHP e o driver que utilizaremos para conexão com o banco de dados.
Para Instalar, abra seu terminal e digite:

    sudo apt install php php-mysql

Após a instalação de ambos, vamos reiniciar o Apache.

    service apache2 restart
    
Caso queira garantir que o PHP foi instaladom com êxito, execute o comando:

    php -v

Sua saída deve ser semelhante a esta:

    PHP 7.4.3 (cli) (built: Oct 6 2020 15:47:56) ( NTS )
    Copyright (c) The PHP Group
    Zend Engine v3.4.0, Copyright (c) Zend Technologies
    with Zend OPcache v7.4.3, Copyright (c), by Zend Technologies

### **Clonagem do projeto**
Vamos ir até a pasta onde o Apache realiza a execução dos projetos.

    cd /var/www/html/

Dentro da pasta html, crie uma pasta com o nome que preferir. Como exemplo, vou criar uma pasta chamado clone-git

    sudo mkdir clone-git

Ao criar a pasta, pode entrar nela.

    cd clone-git

> Coloquei no exemplo *clone-git* pois foi a criada no exemplo. Neste caso, entre na pasta que você criou.

Agora, precisamos inicializar nosso repósitorio git dentro. Para isso, vamos rodar o comando git init.

    sudo git init

Pronto, temos nossa pasta configurada para futuramente realizarmos commits deste projeto. Precisamos agora incluir os arquivos do repositório remoto para nossa máquina.

    sudo git clone https://github.com/carlosborn/trabalho

> O Git pedirá sua autenticação. Confirme seu usuário e senha conforme for solicitado.

Poderá ver que o Git criou uma nova pasta com o nome *trabalho*. Ao entrar nela, verá dois arquivos: README.md e index.php.

### **Execução do projeto**
Para executarmos nosso projeto, basta abrir seu navegador de preferência. O sistema usa três parâmetros para funcionar:

* Usuário do banco de dados;
* Senha do banco de dados;
* IP do banco de dados.

Estes três parâmetros são passados via GET na URL do programa, como exemplo abaixo:

    localhost/git-clone/trabalho/index.php?usuario=root&senha=mysql&host=localhost

> Lembrando que no lugar de **git-clone** deverá ser substituído pela pasta que você criou no tópico anterior!
> Os parâmetros de usuário, senha e host deverão ser colocados conforme você configurou na sua máquina. Os apresentados acima somente servem de exemplo.


Caso tudo tenha rodado corretamente, verá esta tela:

![Tabela Criada](https://i.ibb.co/GW3PyQX/imagem-2020-11-03-202405.png)
