<?php

namespace Azuriom\Plugin\Stats\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;
use Azuriom\Models\Permission;
use Azuriom\Plugin\Stats\Models\Setting;
use Azuriom\Plugin\Stats\Models\Stats;
use Azuriom\Plugin\Stats\Models\Games;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;

class StatsServiceProvider extends BasePluginServiceProvider
{
    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMiddlewares();

        //
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        Relation::morphMap([
            'stats' => Stats::class,
            'games' => Games::class,
        ]);

        if (Schema::hasTable('stats_settings')) {
            if (!Setting::first()) {
                $setting = new Setting();
                $setting->name = 'global';
                $setting->settings = array();
                $setting->save();
            }
        }

        Permission::registerPermissions([
            'stats.admin' => 'stats::admin.permission',
        ]);
    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            'stats.index' => trans('stats::messages.title'),
        ];
    }

    /**
     * Return the admin navigations routes to register in the dashboard.
     *
     * @return array
     */
    protected function adminNavigation()
    {
        return [
            'stats' => [
                'name'       => trans('stats::admin.title'), // Traduction du nom de l'onglet
                'type'       => 'dropdown',
                'icon'       => 'bi bi-person-lines-fill', // Icône FontAwesome
                'route'      => 'stats.admin.*', // Route de la page
                'permission' => 'stats.stats', // (Optionnel) Permission nécessaire pour voir cet onglet
                'items'      => [
                    'stats.admin.index'       => trans('stats::admin.stats.index'),
                    'stats.admin.games.index' => trans('stats::admin.game.index')
                ],
            ],
        ];
    }
}
