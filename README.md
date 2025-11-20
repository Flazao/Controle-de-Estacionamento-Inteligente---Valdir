# Controle de Estacionamento
Gabriel Flazão Polleti - 1990590
Juliana Moreno - 1994729
João Vitor Alves - 
Maria Fernanda De Andrade - 1998066

# Controle de Estacionamento Inteligente

## Descrição
Este projeto é um sistema de controle de estacionamento que registra entradas e saídas de veículos, calcula tarifas baseadas no tempo e tipo do veículo, e gera relatórios de uso e faturamento por tipo.  
Desenvolvido em PHP 8.2+ utilizando SQLite para persistência e seguindo princípios de Clean Code como SOLID, DRY, KISS.

---

## Tecnologias Utilizadas

- PHP 8.2+
- SQLite
- Composer (autoload PSR-4)
- Estrutura modular com pastas Application, Domain e Infra
- HTML simples para interface mínima (sem frameworks)

---

## Requisitos do Sistema

Para executar o projeto, você precisa:

- PHP 8.2 ou superior instalado
- Composer instalado
- SQLite instalado e habilitado na extensão PHP

---

## Instalação e Configuração

1. Clone o repositório e acesse a pasta:

git clone https://github.com/Flazao/Controle-de-Estacionamento-Inteligente---Valdir.git
abra a pasta
troque o caminho por CMD

2. Instale dependências e autoload do Composer:

composer install

3. Crie o banco de dados SQLite e as tabelas rodando a migration:

sqlite3 database/estacionamento.db < Infra/Database/migration.sql

---

## Estrutura do Projeto

- **Application/**: Camada de serviços e lógica de aplicação
- **Domain/**: Entidades, interfaces e regras de negócio
- **Infra/**: Implementações de persistência, configuração do banco
- **public/**: Arquivos públicos para acesso via navegador (formulários, scripts PHP)

---

## Como Usar

### Registrar Entrada

- Acesse `public/index.php`
- Preencha a placa e selecione o tipo do veículo (carro, moto ou caminhão)
- Clique em "Registrar Entrada"

### Registrar Saída

- Acesse o formulário de saída ou envie via POST para `public/registrar_saida.php`
- Informe a placa do veículo para registrar a saída e calcular o valor a pagar

### Relatório

- Acesse `public/relatorio.php` para gerar relatório resumido com total de veículos por tipo e faturamento total

---

## Regras de Negócio

- Veículos categorizados em 3 tipos: carro, moto e caminhão
- Tarifas por hora (arredondado para cima):
  - Carro: R$ 5,00 / hora
  - Moto: R$ 3,00 / hora
  - Caminhão: R$ 10,00 / hora
- Relatórios com totais e faturamento por tipo de veículo