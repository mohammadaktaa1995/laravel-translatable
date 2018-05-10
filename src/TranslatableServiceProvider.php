<?php
/**
 * Created by Aktaa.
 * User: Mohammad Aktaa
 * Date: 5/6/2018
 * Time: 4:11 AM
 */

namespace Aktaa\translatable;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Route;
use Aktaa\translatable\Commands\TranslateCommand;

class TranslatableServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $namespace = 'Aktaa\translatable\Http\Controllers';

    protected $middleware;

    protected $command;

    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        parent::__construct($app);
        $this->command = $this->registerCommand();
    }

    /**
     * Bootstrap the application events.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $this->mapTranslateRoutes($router);
        $this->publishes([
            __DIR__ . '/Configs/config.php' => config_path('translatable.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/translate'),
        ], 'public');
        $this->publishes([
            __DIR__ . '/resource/views/index.blade.php' => base_path('resources/views/translates/index.blade.php'),
            __DIR__ . '/resource/views/translate.blade.php' => base_path('resources/views/translates/translate.blade.php'),
            __DIR__ . '/resource/views/table.blade.php' => base_path('resources/views/translates/table.blade.php'),
        ],'resources');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['modules.handler', 'modules'];
    }


    /**
     * @param $router
     */
    protected function mapTranslateRoutes($router)
    {
        $router->group([
            'prefix' => \Translatable::setLocale(),
            'namespace' => $this->namespace,
            'middleware' => $this->middleware
        ], function () {

            Route::post('translates/delete/{word?}', 'TranslateController@deleteWord');
            Route::get('translates/view', 'TranslateController@viewAddWord');
            Route::get('translates/get-table', 'TranslateController@getTable');
            Route::get('translates/get-table', 'TranslateController@getTable');

            Route::resource('translates', 'TranslateController',[
                'names' => [
                    'index' => 'translates',
                    'store' => 'add-translate',
                    'update' => 'update-translate',
                    'show' => 'show-translate',
                    'delete' => 'delete-translate',
                ]]);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $packageConfigFile = __DIR__ . '/Configs/config.php';
        $this->commands($this->command);
        $this->mergeConfigFrom(
            $packageConfigFile, 'translatable'
        );

        $this->app->singleton(Translatable::class, function () {
            return new Translatable();
        });

        $this->app->alias(Translatable::class, 'Translatable');
    }

    public function registerCommand()
    {
        return TranslateCommand::class;
    }
}
