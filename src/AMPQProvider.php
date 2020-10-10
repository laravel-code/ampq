<?php

namespace LaravelCode\AMPQ;

use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AMPQProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'oauth');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('ampq.php')], 'ampq');
        }

        app()->bind(Connector::class, function () {
            $validator = \Validator::make(config('ampq'), [
                'host' => 'required',
                'port' => 'required',
                'user' => 'required',
                'pass' => 'required',
                'vhost' => 'required',
            ]);

            if ($validator->fails()) {
                throw new ConfigException($validator->errors(), 400);
            }

            return new Connector(
                config('ampq.host'),
                config('ampq.port'),
                config('ampq.user'),
                config('ampq.pass'),
                config('ampq.vhost'),
                config('ampq.consumer')
            );
        });

        app()->bind(Consumer::class, function () {
            return new Consumer(app()->get(Connector::class));
        });

        app()->bind(Publisher::class, function () {
            return new Publisher(app()->get(Connector::class));
        });
    }

    protected function configPath()
    {
        return __DIR__.'/../config/ampq.php';
    }
}
