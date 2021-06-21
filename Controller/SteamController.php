<?php

namespace Controller;

use Controller\ControllerBase;
use App\Src\App;

class SteamController extends ControllerBase
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function homeHandler()
    {
        $games = $this->app->getService('steamModel')->getLastGames();
        $this->render('MainView', ["games" => $games]);
    }

    public function gamesHandler()
    {
        $games = $this->app->getService('steamModel')->getAllGames();
        $this->render('magasin', ["games" => $games]);
    }

    public function gameHandler($name)
    {
        $game = $this->app->getService('steamModel')->getOneGame($name);
        $this->render('jeu', $game);
    }

    public function gamesSearchByName()
    {
        $name = $_POST['name'];
        $games = $this->app->getService('steamModel')->searchByName($name);
        $this->render('magasin', ["games" => $games]);
    }

    public function gamesSearchByCategory($category)
    {
        $games = $this->app->getService('steamModel')->searchByCategory($category);
        $this->render('magasin', ["games" => $games]);
    }
    public function deleteGame()
    {


    }
    public function renderConnection()
    {
        $this->render('connection');
    }
    public function renderInscription()
    {
        $this->render('inscription');
    }
    public function validationInscription()
    {
        $user = $this->app->getService('steamModel')->validationInscription($_POST["email"], $_POST["mdp"], $_POST["pseudo"]);
    }
}