<?php namespace Hgy\Facades;

use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/5/15
 * Time: 2:32 AM
 */

class TemplateFuncServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register 'underlyingclass' instance container to our UnderlyingClass object
        $this->app['helper'] = $this->app->share(function($app)
        {
            return new Helper;
        });

        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Helper', 'Hgy\Facades\TemplateFunc');
        });
    }
}