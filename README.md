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

 - Ter instalado o <a href="https://getcomposer.org/download/" target="_blank">`Composer`</a> em seu ambiente de desenvolvimento;
 - Usar servidor PHP, Apache ou Nginx com Mysql ou MariaDB;
 - Seguir as boas práticas do <a href="https://www.php-fig.org/psr/psr-4/examples/" target="_blank">PSR-4</a> e <a href="https://www.php-fig.org/psr/psr-12/" target="_blank">PSR-12</a>
 - Front-end baseado em BootStrap 4;