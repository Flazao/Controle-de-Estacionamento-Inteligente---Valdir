# Controle de Estacionamento
Gabriel Flazão Polleti - 1990590
Juliana Moreno - 1994729
João Vitor 
Maria Fernanda De Andrade - 1998066

Projeto acadêmico em PHP 8.2+, PSR-4, SQLite e boas práticas.

O sistema permite:

Registrar entrada de veículos (carro, moto, caminhão)

Registrar saída e calcular o valor com base no tempo

Gerar relatório de quantidade e faturamento por tipo de veículo

## Executando

1. `composer install`
2. Criar o banco: `mkdir -p database && touch database/app.sqlite`
3. Executar migrations: `sqlite3 database/app.sqlite < database/migrations.sql`
4. Rodar: `php -S localhost:8000 -t public/`
5. Acessar entradas, saídas e relatórios pelo navegador

## Estrutura

- src/: código fonte (Domain, Application, Infra)
- public/: interface simples
- database/: SQL de criação do banco
