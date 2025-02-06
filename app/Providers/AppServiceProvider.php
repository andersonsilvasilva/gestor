<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use League\CommonMark\Extension\Footnote\Event\GatherFootnotesListener;
use App\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
            //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        //-------------
        // GATES
        //-------------
        Gate::define('admin', function(){
          return auth()->user()->role === 'admin'; 
        });

        Gate::define('rh', function(){
            return auth()->user()->role === 'rh'; 
          });
        
         Gate::define('tp', function(){
            return auth()->user()->role === 'tp'; 
          });  
    }
}
