<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Annee;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*', function ($view) 
    {
        if(\Session::get('anneeChoisie')===null)
            \Session::put('anneeChoisie', Annee::all()->last()->id);

        \Session::put('anneeDebut', Annee::all()->first()->annee);
        \Session::put('moisEnCours', Carbon::now()->month);
        
        $view->with('anneeChoisie', \Session::get('anneeChoisie')) 
             ->with('anneeDebut', \Session::get('anneeDebut'))
             ->with('moisEnCours', \Session::get('moisEnCours'));   
    });  

        Carbon::setLocale(config('app.locale'));

    }
}
