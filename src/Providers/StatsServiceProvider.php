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
            'playerstats.admin' => 'playerstats::admin.permission',
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
            'playerstats.index' => trans('playerstats::messages.title'),
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
                'name'       => trans('playerstats::admin.title'), // Traduction du nom de l'onglet
                'type'       => 'dropdown',
                'icon'       => 'bi bi-person-lines-fill', // Icône FontAwesome
                'route'      => 'playerstats.admin.*', // Route de la page
                'permission' => 'playerstats.stats', // (Optionnel) Permission nécessaire pour voir cet onglet
                'items'      => [
                    'playerstats.admin.index'       => trans('playerstats::admin.stats.index'),
                    'playerstats.admin.games.index' => trans('playerstats::admin.game.index')
                ],
            ],
        ];
    }
}
