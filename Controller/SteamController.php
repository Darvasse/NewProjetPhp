<?php

namespace Controller;

use Controller\ControllerBase;
use App\Src\App;
use function mysql_xdevapi\getSession;

class SteamController extends ControllerBase
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function homeHandler()
    {
        session_start();
        $games = $this->app->getService('steamModel')->getLastGames();
        $this->render('MainView', ["games" => $games]);
    }

    public function gamesHandler()
    {
        session_start();
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

    public function renderProfile()
    {
        session_start();
        $games = $this->app->getService('steamModel')->getDownloadedGames($_SESSION['id']);
        $this->render('profile', ['games' => $games]);
    }

    public function actionOnGame($name, $action)
    {
        if ($action === "modifier")
        {
            $this->renderModify($name);
        }
        if ($action === "supprimer")
        {
            $this->renderDelete($name);
        }
    }

    private function renderModify($name)
    {
        $game = $this->app->getService('steamModel')->getOneGame($name);
        $this->render('modifier', $game);
    }

    public function modifyGame()
    {
        $id = $_POST['id'];
        $newName = $_POST['name'];
        $newDesc = $_POST['desc'];
        $newCategory = $_POST['category'];
        $newLink = $_POST['link'];

        $this->app->getService('steamModel')->modifyGame($id, $newName, $newDesc, $newCategory, $newLink);
        $this->renderProfile();
    }

    private function renderDelete($name)
    {
        $game = $this->app->getService('steamModel')->getOneGame($name);
        $this->render('supprimer', $game);
    }

    public function deleteGame($name)
    {
        $this->app->getService('steamModel')->deleteGame($name, $_SESSION['id']);
        $this->homeHandler();
    }

    public function renderPostePage()
    {
        $this->render('poster');
    }

    public function posteGame()
    {
        session_start();
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $category = $_POST['category'];
        $link = $_POST['link'];
        $creatorID = $_SESSION['id'];
        $this->app->getService('steamModel')->uploadGame($name, $desc, $category, $link, $creatorID);
        $this->gamesHandler();
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
        $user = $this->app->getService('steamModel')->validationInscription(htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["mdp"]), htmlspecialchars($_POST["pseudo"]));
        $this->homeHandler();
    }
    public function validationConnection()
    {
        $user = $this->app->getService('steamModel')->validationConnection(htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["mdp"]));
        $this->homeHandler();
    }
    public function downloadGame()
    {
        session_start();
        $user = $this->app->getService('steamModel')->downloadGame(htmlspecialchars($_SESSION['id']), $_POST['idjeu']);
        $this->redirectToDlLink($_POST['dllink']);
    }
    public function redirectToDlLink($link) {
        header('Location:'.$link);
    }
}