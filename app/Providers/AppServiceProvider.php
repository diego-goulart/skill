<?php

namespace Skill\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Relation::morphMap([
		    'users' => 'Skill\User',
	    ]);

        View::share('DASHBOARD_OPERADOR_URL', '/admin/operador');
        View::share('DASHBOARD_SUPERVISOR_URL', '/admin/supervisors');
        View::share('DASHBOARD_LIDER_URL', '/admin/lider');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
