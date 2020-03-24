<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //$categorias = \App\categoria::all(['name', 'slug']);

        // compartilhando as categorias em todas as views
        //view()->share('categorias', $categorias);
        // compartilhando em views especificas descriminar as views dentro de um array
        //view()->composer(['welcome', 'single'],  function($view){
            //passando para todas as views usando "*";
        //view()->composer('*',  function($view) use ($categorias){
        //    $view->with('categorias', $categorias);
        //
        //});
        // organizando o escrito acima em classe criada abaixo
        view()->composer('*', 'App\Http\Views\CategoriaViewComposer@compose');
    }
}
