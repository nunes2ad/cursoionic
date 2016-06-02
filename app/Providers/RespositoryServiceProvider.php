<?php

namespace CodeDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RespositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $models = ['Category','Product','Client','Order','OrderItem'];
        foreach($models as $model){

            $rep = "CodeDelivery\\Repositories\\{$model}Repository";
            $eloq = "CodeDelivery\\Repositories\\{$model}RepositoryEloquent";

            $this->app->bind($rep,$eloq);
        }
    }
}
