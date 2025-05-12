
# Produtos Laravel 6.2

Um simples CRUD, com Laravel 6.2 e VueJS2, demonstrando como um SPA (Single Page Application), pode ser útil para solucionar pequenos problemas.

O projeto mostra o quando o Laravel pode ser simples para fazer operações como cadastros, edições, listagens e exclusão, e usando o VueJS para simplificar em um single Page.

A arquitetura simples e limpa do Laravel, permite desde soluções simples, como esta, como também a flexibilidade em absorver mudanças, como por exemplo o uso de Service no caso de fornecer uma API externa para um app mobile por exemplo.


Neste caso foi usado o mais básico do Laravel, mas que já demonstra o quanto o framework consegue abstrair e eleva a produtividade.




## Configuração do ambiente

Para executar corretamente as migrations, copie as informações do .env.example e ger um arquio .env. 

Atualize as informações de conexão com o MySQL de acordo com suas configurações locais.

`DB_DATABASE`

`DB_HOST`

`DB_PORT`

`DB_USERNAME`

`DB_PASSWORD`


## Instalação

Requisitos: 

**PHP 7.4**

**Node 14**

**MySQL**

```bash
  composer install
  
  npm install
  
  php artisan migrate
  
  npm run dev
  
  php artisan serve
```
    
## Features

- Cadastrar
- Editar
- Listar
- Excluir

