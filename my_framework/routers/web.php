<?php

use App\Http\Controller\ArticleController;
use Asus\Haste\Application;
use Asus\Haste\Router;
use Asus\Haste\Views;


Router::get('/articles/{id:\d+}/edit/{article}',[ArticleController::class,'index']);
Router::get('/article/create',[ArticleController::class,'create']);
Router::post('/article/createeee',[ArticleController::class,'store']);

Router::get('/insert/article',[ArticleController::class,'createArticle']);

// Router::get('/about','about');
Router::view('/about','about');


// Router::get('/article',function (){
//     return 'article page';
// });
// Router::get('/about',function (){
//     return 'about page';
// });
?>