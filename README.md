<p align="center">
  <h1 align="center">
    ESSOR Teste João Paulo
  </h1>
</p>

## 🖥️ Descrição do Projeto

Aplicação para cadastro de pessoas (CRUD) com validação de CEP e CPF:

- Create:
  - Validação de CEP via VIACEP.
  - Validação de CPF válido.
  - Validação de CPF único.
- Read:
  - Lista todas as pessoas.
  - Lista pessoa por ID específico.
- Update:
  - Validação de CEP via VIACEP.
  - Validação de CPF válido.
  - Validação de CPF único para impedir atualização que duplicaria CPF no banco de dados.
- Delete:
  - Exclusão de pessoa por ID específico.

## 💻 Tecnologias e Ferramentas

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Git](https://img.shields.io/badge/GIT-E44C30?style=for-the-badge&logo=git&logoColor=white)


---


## 🚀 API:

```yml
POST /pessoa
    - Rota para cadastro de pessoa
    - headers: {}
    - body: {
        "nome": String | required
        "sobrenome": String | required
        "celular": String | required
        "logradouro": String | required
        "cep": String | required | 11 caracteres | cep válido
        "cpf": String | required | 8 caracteres | cpf válido
    }
```

```yml
GET /pessoa
    - Rota que retorna todas as pessoas
    - headers: {}
    - body: {}
```

```yml
GET /pessoa/{id}
    - Rota que retorna pessoa com ID específico
    - headers: {}
    - body: {}
```

```yml
PUT /pessoa/{id}
    - Rota para atualizar dados de pessoa com ID específico
    - headers: {}
    - body: {
        "nome": String | nullable
        "sobrenome": String | nullable
        "celular": String | nullable
        "logradouro": String | nullable
        "cep": String | nullable | 11 numeros | cep válido
        "cpf": String | nullable | 8 numeros | cpf válido
    }
```

```yml
DELETE /pessoa/{id}
    - Rota que deleta pessoa com ID específico
    - headers: {}
    - body: {}
```
---
## 💁🏻‍♂️ Instalação Manual

```bash
$ git clone https://github.com/OliveiraaJP/teste-junior.git
```

- Crie o um arquivo .env seguindo o modelo do .env.example

- Crie um banco de dados relacional de preferência (MySql, PostgreSQL, MariaDB) de acordo com os dados do .env 
(projeto desenvolvido e testado usando MySql)

- Faça as migrações:

```bash
$ php artisan migrate
```

- Gere a chave APP_KEY com o .env já criado:
```bash
$ php artisan key:generate
```

- Rode o servidor com:
```bash
$ php artisan serve
```

---
