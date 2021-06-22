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

        $app = $this->app;
        $this->app->get('/magasin', function () use ($app){
            $controller = new SteamController($app);
            $controller->gamesHandler();
        });

        $this->app->post('/magasin', function () use ($app){
            $Controller = new SteamController($app);
            $Controller->gamesSearchByName();
        });

        $this->app->get('/magasin/(\w+)', function ($category) use ($app){
            $Controller = new SteamController($app);
            $Controller->gamesSearchByCategory($category);
        });

        $this->app->get('/jeu/(\w+)', function ($name) use ($app){
            $Controller = new SteamController($app);
            $Controller->gameHandler($name);
        });
        $this->app->get('/connection', function () use ($app){
            $Controller = new SteamController($app);
            $Controller->renderConnection();
        });
        $this->app->post('/connection/validation', function () use ($app){
            $Controller = new SteamController($app);
            $Controller->validationConnection();
        });
        $this->app->get('/inscription', function () use ($app){
            $Controller = new SteamController($app);
            $Controller->renderInscription();
        });
        $this->app->post('/inscription/validation', function () use ($app){
            $Controller = new SteamController($app);
            $Controller->validationInscription();
        });
        $this->app->get('/profile', function () use ($app){
            $Controller = new SteamController($app);
            $Controller->renderProfile();
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