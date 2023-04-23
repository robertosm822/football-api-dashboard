## Instruções para instalação e uso do sistema

 - Executar o comando do Composer para instalar os pacotes de dependências do projeto:

```bash
    composer install
```
 - O comando acima irá criar a pasta `vendor/` contendo as biblioteca auxiliares do projeto e faremos uso das boas práticas de uso da PSR-4 com o arquivo `autoload.php` onde poderemos trabalhar com instanciamento de classes gerenciados pelo autoload e organizar o código com `namespace`.
 - Para Limpar e reorganizar classes geradas de forma personalizadas usamos o comando:

```bash
    composer dump
```

 - Para inicializar o sistema usando o servidor embutido em linha de comando do PHP apontando para a pasta `/public/`: 

```bash
    php -sS localhost:9091  -t 'public/'
```

## Requerimentos necessários e  padrões adotados

 - Ter instalado o [`Composer`](https://getcomposer.org/download/) em seu ambiente de desenvolvimento;
 - Usar servidor PHP, Apache ou Nginx com Mysql ou MariaDB;
 - Seguir as boas práticas do [PSR-4](https://www.php-fig.org/psr/psr-4/examples/) e [PSR-12](https://www.php-fig.org/psr/psr-12/);
 - Front-end baseado em BootStrap 4;