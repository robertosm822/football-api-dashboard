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

## Estrutura das tabelas a serem criadas

```sql
-- TABELA 1: leagues
CREATE TABLE `leagues` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `createdAt` dateƟme DEFAULT NULL,
 `referal_league_id` int(11) NOT NULL,
 `name` varchar(45) CHARACTER SET laƟn1 DEFAULT NULL,
 `country` varchar(45) CHARACTER SET laƟn1 DEFAULT NULL,
 `logo` varchar(255) CHARACTER SET laƟn1 DEFAULT NULL,
 `flag` varchar(255) CHARACTER SET laƟn1 DEFAULT NULL,
 `updatedAt` dateƟme DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=uƞ8;
```
OBS: criar índices para o campo referal_league_id
```sql
-- TABELA 2: teams
CREATE TABLE `teams` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `createdAt` dateƟme DEFAULT NULL,
 `referal_team_id` int(11) DEFAULT NULL,
 `league` int(11) DEFAULT NULL,
 `name` varchar(255) DEFAULT NULL,
 `logo` varchar(255) DEFAULT NULL,
 `country` varchar(45) DEFAULT NULL,
 `updatedAt` dateƟme DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET= uƞ8;
```
OBS: criar índices para o campo league

## Rodar componente para formatar e ajustar aos padrões da PSR-12

Pacote do composer que roda somente em ambiente de desenvolvimento que corrige formatação e identação segundo as normas da PSR-12:

```bash
    vendor/bin/phpcbf --standard=psr12 src/
```

## Rodar testes Unit e Feature com PHPUnit

```bash
    vendor/bin/phpunit tests
```

Testar uma classe especifica criada de testes:

```bash
    ./vendor/bin/phpunit tests --filter 'tests\\Feature\\HomeControllerTest'
```

## Requerimentos necessários e  padrões adotados

 - Ter instalado o <a href="https://getcomposer.org/download/" target="_blank">`Composer`</a> em seu ambiente de desenvolvimento;
 - Usar servidor PHP, Apache ou Nginx com Mysql ou MariaDB;
 - Seguir as boas práticas do <a href="https://www.php-fig.org/psr/psr-4/examples/" target="_blank">PSR-4</a> e <a href="https://www.php-fig.org/psr/psr-12/" target="_blank">PSR-12</a>
 - Front-end baseado em BootStrap 4;