<?php

namespace AndreGumieri\LaravelSqliteLegacy;

use AndreGumieri\LaravelSqliteLegacy\Database\SQLiteLegacyConnection;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\SQLiteConnector;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        // @see https://github.com/yajra/laravel-oci8/blob/master/src/Oci8/Oci8ServiceProvider.php
        Connection::resolverFor('sqlite-legacy', function ($connection, $database, $prefix, $config) {
            $connector = new SQLiteConnector();
            $connection = $connector->connect($config);

            return new SQLiteLegacyConnection($connection, $database, $prefix, $config);
        });
    }
}