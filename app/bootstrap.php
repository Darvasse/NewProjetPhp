<?php
namespace App;

use App\Src\App;
use App\Routing;
use App\Src\ServiceContainer\ServiceContainer;
//use Controller\SteamController;
use Database\Database;
use Model\SteamModel;

$container = new ServiceContainer();
$app = new App($container);

$app->setService('Database', new Database(
    "localhost",
    "connection",
    "root",
    ""
));

$app->setService('steamModel', new SteamModel(
    $app->getService('Database')
));

$routing = new Routing($app);
$routing->setup();


return $app;