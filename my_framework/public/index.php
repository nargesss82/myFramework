<?php
require __DIR__ . "./../vendor/autoload.php";
use Asus\Haste\Application;
use App\Http\Controller\ArticleController;
use Asus\Haste\H;
use Asus\Haste\Request;
use Asus\Haste\Router;


// $app=new Application;
// var_dump($app);
// $h=new H();
// var_dump($h); 
$app=new Application(dirname(__DIR__));
$app->router
->setRouterFiles(__DIR__.'/../routers/web.php')
->setRouterFiles(__DIR__.'/../routers/api.php');
$app->run();

?>