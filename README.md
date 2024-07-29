
Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize o username de ambiente do arquivo .env para algum de sua preferência
```dosini

de:
DB_USERNAME=root

para:
DB_USERNAME=conan
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```


Acesse o projeto
[http://localhost:89](http://localhost:89)
