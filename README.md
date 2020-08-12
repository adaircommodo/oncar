# ONCAR - Piloto1
Piloto 1 da Interface (Frontend) com Backend pronto para criação de RESTful API com PHP

## Arquivo BANCO DE DADOS (ONCAR.sql)
- Está na pasta raiz do projeto.
- Inporte este arquivo para seu MySQL (via phpMyAdmin ou via cliente mysql)
   - O nome do banco de dados (Base) é oncar;
   - Consiste de um tabela (tb_veiculos) e uma view (vw_veiculos);
   - MER (Modelo de Entidade-Relacionamento) foi feito via Mysql Workbench.

## Arquivos PHP (Classes do Projeto)
- Estão dentro do diretório /vendor/ajrc-solucoes/

## Arquivo de Configuração Geral do Projeto (Incluindo BD) 
- Estão dentro do diretório /vendor/ajrc-solucoes/Config/Config.php

## Rodar em máquina local:
- Instale o composer [Composer](https://getcomposer.org/):
- Dentro do diretório onde baixar os arquivos, rode o comando:

Para windows:
```sh
C:\pathdoprojeto> composer install
```

Para linux:
```sh
$ sudo php composer.phar install
```

- Após instalação, rode o comando:

Para windows:
```sh
C:\pathdoprojeto> composer server
```

Para linux:
```sh
$ sudo php composer.phar server
```

Subirá um servidor em locahost:8080

No mais... divirta-se!!!


