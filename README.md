### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Docker](https://www.docker.com/), e docker-compose.
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/)

### Instalação

1. Clone o repositório

```sh
git clone git@github.com:josimardomingos/book-store-tj.git
```

2. Acesse a pasta do projeto no terminal/cmd

```sh
cd book-store-tj
```

3. Copie o arquivo de ambiente

```sh
cp .env.example .env
```

4. Caso não esteja usando o zsh, com atualização de variáveis de ambiente, atualize as variáveis

```sh
. .env
```

5. Compile o container

```sh
docker-compose build
```

6. Execute a aplicação

```sh
docker-compose up -d
```

### Uso

1. Por default, o servidor iniciará na porta `8000` - [http://localhost:8000](http://localhost:8000) e o banco de dados na porta `33080`

2. Para verificar o status dos containers

```sh
docker-compose ps
```

3. Para visualizar os logs

```sh
docker-compose logs
```

4. Para executar os testes

```sh
docker-compose exec php sh /scripts/test.sh
```

5. Para visualizar a documentação (swagger) : [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)

6. Para facilitar possíveis testes, foi adicionado ao projeto todos os endpoints do postman no arquivo [Store-Book.postman_collection.json](./Store-Book.postman_collection.json)
