## Instalar o projeto

1.- Execute composer install para instalar todas as dependências necessárias

2.- Crie o banco de dados executando o comando:
```
php vendor/bin/doctrine orm:schema-tool:create
```

3.- Execute o seguinte comando para criar um usuário com e-mail *email@example.com* e senha *123456*

```
php vendor/bin/doctrine dbal:run-sql "INSERT INTO usuarios (email, senha) VALUES ('email@example.com', '\$argon2i\$v=19\$m=65536,t=4,p=1\$WHpBb1FzTDVpTmQubU55bA\$jtZiWSSbmw1Ru4tYEq1SzShrMu0ap2PjblRQRubNPgo');"
```

4 Inicialize o projeto em um servidor web:

```
php -S 0.0.0.0:8080 -t public
```

5.- Testar o projeto no navegador na seguinte URL:

```
http://localhost:8080/login
```


### Aula 01 

* Aprendemos o que é uma User Story;
* Definimos uma funcionalidade utilizando User Story; 
* Aprendemos a definir cenários de testes;
* Entendemos a importância de definir cenários de testes para nossas funcionalidades;

### Aula 02

+ Vimos que a sintaxe que utilizamos para definir funcionalidades e cenários se chama Gherkin;
+ Aprendemos que o Behat automatiza testes escritos com Gherkin;
+ Inicializamos as configurações para começar a automatizar testes com Behat;
+ Behat automatiza os cenários que nós definirmos utilizando a sintaxe Gherkin.
+ Comandos utilizados:

```
// Para instalar o behat no projeto
composer require --dev behat/behat

// Para conferir a instação e versão do Behat
vendor/bin/behat -V

// Para inicializar o uso do betah.  
vendor/bin/behat --init

// Para tentar executar os testes com o behat
vendor/bin/behat

// Para visualizar o que será alterado com um comando update do doctrine. 
vendor/bin/doctrine orm:schema-tool:update --dump-sql

// Para atualizar o banco de dados
php vendor/bin/doctrine orm:schema-tool:update -fC
```

+ Ao executar o comando de inicializaação do betah, o behat cria uma pasta **features** e dentro dela uma pasta boostrap e uma classe de contexto que permitirá executar os cenários de teste
+ Foi criada a feature de adicionar formação (como desafio)

