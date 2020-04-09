<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\produtofotocontroller;
use App\Http\Controllers\admin\ProductPhotoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/produto/{slug}', 'HomeController@single')->name('produto.single');
Route::get('/samples', 'samplesController@index')->name('samples');
Route::get('/categoria/{slug}', 'CategoriaController@index')->name('categoria.single');

Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){

    Route::get('/', 'CartController@index')->name('index');

    Route::post('add', 'CartController@add')->name('add');

    Route::get('remove/{slug}', 'CartController@remove')->name('remove');

    Route::get('cancel', 'CartController@cancel')->name('cancel');

});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/','CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
});

Route::get('my-orders', 'UserOrderController@index')->name('user.orders')->middleware('auth');

Route::group(['middleware' => ['auth', 'access.control.store.admin']], function(){

    Route::prefix('admin')->name('admin.')->namespace('admin')->group(function(){

        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');
        Route::resource('stores', 'storecontroller');
        Route::resource('produtos', 'produtocontroller');
        Route::resource('categorias', 'categoriacontroller');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');

        Route::get('orders/my', 'OrdersController@index')->name('orders.my');

    });
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');//->middleware('auth');

Route::get('/model', function(){

    // active records salvando dados no banco de dados
    //  $produtos = \App\Produto::all(); //select * from produtos
    //  $user = new \App\User();
    //  $user->name = 'Usuario teste';
    //  $user->email = 'usertese@teste.com';
    //  $user->password = bcrypt('12345678');
    //  $user->save();
    //  \App\User::all(); // retorna objeto collection e converte p json
    //  return \App\User::find(3); // retorna usuario com base no id.
    // return \App\User::where('name', 'Helena Feeney')->get(); //select * from users where name = 'Helena Feeney';
    // return \App\User::paginate(10); // paginando dados com laravel

    // Mass Assignment --- atribuicao em massa ---

   // $user = \App\User::create([
   //     'name' => 'joao jose',
   //     'email' => 'testejoao@email.com',
   //     'password'=> bcrypt('12345678')

   // ]);
  // retorno do objeto
  //dd($user);


  // Mass Update

  //$user =  \App\User::find(165);
  // caso nao sobrescreva retorno do objedo
  // sobrescrevendo $user para dar retorno booleano true ou false .. caso tenha inserido no banco ou nao .
  //$user = $user->update([
  //    'name' => 'Atualizado com Mass Update'
  //]); // true or false o retorno

  //dd($user);




  // como faria para pegar a loja de 1 usuario
  //$loja = \App\store::all();
  //return $loja; // retorna objeto unico pois e 1-1 nesse caso STORE //

  // chamando como metodo retorna uma estancia de hasOne para fazer algumas condicoes em cima dessa operacao.
  //dd($loja->store()->id('id')->name('name'));


  // pegar os produtos de uma loja
  // $loja =\App\store::find(1);
  //return $loja->produtos()->where('id', 9)->get();
  //dd($loja->produtos()); // return hasMany

  // pegar as lojas de 1 categoria
  //$categoria = \App\categoria::find(1);
  //$categoria->produtos;


  // criar uma loja para um usuario:

  //$user = \App\User::find(10);
  //$store = $user->store()->create([
  //    'name'=> 'loja teste',
  //    'description'=> 'Loja teste de Produtos de Informatica',
  //    'phone'=>'XX-XXXXX-XXXX',
  //    'slug'=> 'loja-teste'
  //]);

  //dd($store);


  // criar um produto para uma loja
  //$store = \App\store::find(41);
  //$produto = $store->produtos()->create([
  //    'name' => 'NotBook Dell',
  //    'description' => 'CORE I5 10GB',
  //    'body' => 'Qualquer coisa pode estar aqui ......',
  //    'price' => 2999.90,
  //    'slug' => 'notbook-dell',


  //]);


  // criando categoria

  //\App\categoria::create([
  //    'name' => 'Games',
  //    'descricao' => null,
  //    'slug' => 'games'
  //]);

  //\App\categoria::create([
  //    'name' => 'Notebooks',
  //    'descricao' => null,
  //    'slug' => 'notebooks'
  //]);

  //return \App\categoria::all();



  // dd($produto);

  // adicionar um protudo para uma categoria ou vice-versa

  // $produto = \App\produto::find(40);

  // dd($produto->categorias()->attach([1]));

  //removendo as associação

  //dd($produto->categorias()->detach([1]));

  // dd($produto->categorias()->sync([1,2])); // adiciona todos itens que tem no array e o array deve conter ids de linhas na tabela que esta utilizando ..


  //$produto = \App\produto::find(40);
  //return $produto;
  //return $produto->categorias;

    //return \App\User::all();
  });


  //Route::get('/admin/stores', 'admin\\storecontroller@index');

  //Route::get('/admin/stores/create', 'admin\\storecontroller@create');

  //Route::post('/admin/stores/store', 'admin\\storecontroller@store');

  // definindo apelidos com name

  //Route::prefix('admin')->name('admin.')->namespace('admin')->group(function(){

  //       Route::prefix('stores')->name('stores.')->group(function(){

  //           Route::get('/', 'storecontroller@index')->name('index');
  //           Route::get('/create', 'storecontroller@create')->name('create');
  //           Route::post('/store', 'storecontroller@store')->name('store');
  //           Route::get('/{store}/edit', 'storecontroller@edit')->name('edit');
  //           Route::post('/update/{store}', 'storecontroller@update')->name('update');
  //           Route::get('/destroy/{store}', 'storecontroller@destroy')->name('destroy');


   //   });
   //   Route::resource('stores', 'storecontroller');
   //   Route::resource('produtos', 'produtocontroller');


  //});

Route::get('not', function (){

    // $user = \App\User::find(1);
    //$user->notify(new \App\Notifications\StoreReceiveNewOrder());

    //$notification = $user->notifications->first();

    // $notification->markAsread();
    //$stores = [1, 2, 3];


    //return $stores->map(function($store){
    //    return $store->user;
    // });
    // dd($stores);




   // return $user->readNotifications->count();

});
