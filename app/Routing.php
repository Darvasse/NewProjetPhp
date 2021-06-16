<?php

namespace App;

use Controller\SteamController;
use Controller\CountryController;
use App\Src\App;

class Routing
{
    private $app;

    /**
     * Routing constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function setup()
    {
        $app = $this->app;
        $this->app->get('/', function () use ($app){
            $controller = new SteamController($app);
            $controller->homeHandler();
        });

        /*$this->app->get('/city/(\d+)', function ($id) use ($app){
            $Controller = new CityController($app);
            $Controller->cityHandler($id);
        });

        $this->app->get('/countries', function () use ($app){
            $Controller = new CountryController($app);
            $Controller->countriesHandler();
        });

        $this->app->get('/country/(\w+)', function ($name) use ($app){
            $Controller = new CountryController($app);
            $Controller->countryHandler($name);
        });*/
    }
}