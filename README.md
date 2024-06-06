# LingProg
LP
#Instalação Laravel
docker context use default curl -s "https://laravel.build/example-app?with=mysql,redis" | bash

#iniciando
cd {pasta}

 [*.]github.dev   - iniciar o container
 ./vendor/bin/sail php artisan migrate  -iniciar o BD


 instalar o plugin Docker

 instalar o pacote breeze
 
 composer require laravel/breeze --dev
 php artisan breeze:install

    php artisan migrate
Configurar Vendor para rota localhost vendor/laravel/framework/src/Illuminate/Http/Middleware/TrustProxies.php

protected $proxies='*';

#Views (layouts de páginas)
   nome.blade.php

#Routes - rotas - fluxos da aplicação
 com/sem parâmetros ( enviar/ receber dados )


#Migrations - Banco de dados
cria e gerencia o banco de dados da aplicação
php artisan make:model -mrc produto

Este comando criará três arquivos para você:

app/Models/produto.php- O modelo Eloquente. database/migrations/_create_produto_table.php- A migração do banco de dados que criará sua tabela de banco de dados. app/Http/Controller/ProdutoController.php- O controlador HTTP que receberá solicitações recebidas e retornará respostas.

MIGRATIONS
=======

Criar
php artisan make:migration create_users_table

php artisan make:migration create_users_table --create=users

Executar
php artisan migrate

Ver o status
php artisan migrate:status

Reverter
php artisan migrate:rollback php artisan migrate:rollback --step=5 reverterá as últimas cinco migrações php artisan migrate:rollback --batch=3 everterá todas as migrações do lote três php artisan migrate:reset reverterá todas as migrações do seu aplicativo

Reverter e migrar em um único comando

php artisan migrate:refresh php artisan migrate:refresh --seed

php artisan migrate:fresh php artisan migrate:fresh --seed

Criando Tabelas
use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;

Schema::create('users', function (Blueprint $table) { $table->id(); $table->string('name'); $table->string('email'); $table->timestamps(); });

Criando Colunas
Schema::table('users', function (Blueprint $table) { $table->string('email'); });

Atualizando Tabelas
use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;

Schema::table('users', function (Blueprint $table) { $table->integer('votes'); });

Renomeando tabelas
Schema::rename($from, $to);

php artisan make:migration add_paid_to_users_table --table=users

SEEDS popular tabelas de BD
Criando uma Seed
php artisan make:seeder nomeTableSeeder php artisan: Execução do helper artisan com o PHP
make:seeder: Use o artisan para criar uma seeder nomeTableSeeder: Nome da seeder (TableSeeder)

A seeds criadas vão para o diretório database/seeds/

Dentro do arquivo, você encontrará uma classe com o nome da seeder criada, essa classe extende a classe Seeder, dentro da classe criada terá um método chamado run, esse é o método que será executado quando rodarmos a seed.

Para inserir os dados na tabela, nós usaremos uma Facade: Facades são recursos que o Laravel fornece e que nos ajudam a ganhar tempo quando queremos realizar alguma operação na aplicação, nesse caso usaremos uma facade que nos permita inserir registros no Banco de Dados

<?php use Illuminate\Support\Facades\DB; use App\Models\Categoria:

    public function run()
 {
      DB::table('nome')->insert(['coluna'=>conteudo
                                                   ])

 }

       php artisan db:seed
dentro de DatabaseSeeder, vamos especificar a classe da nossa seed:

public function run() { // Chamando o método call, e especificando a classe $this->call(NomeTableSeeder::class) } Sem configurar o DataBaseSeeder

  php artisan db:seed --class=NomesTableSeeder     
Podemos também, quando formos criar a base de dados, ao rodar uma migration podemos também executar uma seed para a tabela criada:

Rodar migrations e inserir dados php artisan migrate --seed Dar um refresh no DB e inserir os dados php artisan migrate:refresh --seed Dropar todas as tabelas e criar novamente com os registros php artisan migrate:fresh --seed

MODELS- ELOQUENT
Criando a tabela Categoria
php artisan make:model -mrc Categoria

Na migration: public function up() { Schema::create('categorias', function (Blueprint $table) { $table->increments('id'); $table->string('nome'); $table->string('descricao'); $table->timestamps(); }); }

php artisan migrate
php artisan make:seed CategoriaSeed
 No CategoriaSeed:
use App\Models\Categoria; public function run() { Categoria::insert(['nome' => 'categ1', 'descricao' => 'teste']); Categoria::insert(['nome' => 'categ2', 'descricao' => 'teste']); Categoria::insert(['nome' => 'categ3', 'descricao' => 'teste']); } }

php artisan db:seed --class="CategoriaSeed"

Caso ocorra o erro dizendo que a classe não exista: composer dump-autoload e execute o seed novamente

Alterando a tabela de produtos
Aqui vamos adicionar id_categoria a tabela produtos, então volte ao terminal e execute o seguinte comando: php artisan make:migration --table="produtos" alter_produtos_table

public function up() { Schema::table('produtos', function (Blueprint $table) { $table->integer('categoria_id')->unsigned()->nullable(); $table->foreign('categoria_id')->references('id')->on('categorias'); }); }

public function down()
{
    Schema::table('produtos', function (Blueprint $table) {
        $table->dropForeign('produtos_categoria_id_foreign');
    $table->dropColumn('categoria_id');
    });
}

php artisan migrate

# Adicionando relação entre o model Produto e Categoria

Em nosso exemplo a relação de cardinalidades entre as tabelas produto e categoria é de 1:N, ou seja, o produto pode ter uma categoria, e a categoria pode ter vários produtos.
Eloquente: Relacionamentos
no model produto:

class Contato extends Model { public function categoria(){ return $this->belongsTo(Categoria::class); } }

Recuperar Dados
$categoria = $produto->categoria;

use App\Models\Produtos;

foreach (Produtos::all() as $prod) { echo $prod->name; }

