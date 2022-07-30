<?php

namespace Azuriom\Plugin\Stats\Providers;

use Azuriom\Extensions\Plugin\BaseRouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function loadRoutes()
    {
        $this->mapPluginsRoutes();

        $this->mapAdminRoutes();
    }

    protected function mapPluginsRoutes()
    {
        Route::prefix("stats")
            ->middleware('web')
            ->name($this->plugin->id.'.')
            ->group(plugin_path($this->plugin->id.'/routes/web.php'));
        Route::prefix("playerstats")
            ->middleware('web')
            ->name($this->plugin->id.'.')
            ->group(plugin_path($this->plugin->id.'/routes/web.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('admin/'.$this->plugin->id)
            ->middleware('admin-access')
            ->name($this->plugin->id.'.admin.')
            ->group(plugin_path($this->plugin->id.'/routes/admin.php'));
    }
}
