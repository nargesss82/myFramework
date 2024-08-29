<?php

use App\Http\Controller\ArticleController;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\PanelController;
use Asus\Core\Application;
use Asus\Core\Router;
use Asus\Core\Views;
use App\Http\Controller\Auth\RegisterController;

Router::get('/articles/{id:\d+}/edit/{article}',[ArticleController::class,'index']);
Router::get('/article/create',[ArticleController::class,'create']);
Router::post('/article/createeee',[ArticleController::class,'store']);
Router::get('/insert/article',[ArticleController::class,'createArticle']);
Router::get('/edit/article',[ArticleController::class,'editArticle']);
Router::get('/delete/article',[ArticleController::class,'deleteArticle']);
Router::get('/get/articles',[ArticleController::class,'getArticles']);

Router::get('/auth/register',[RegisterController::class,'registerView']);
Router::post('/auth/register',[RegisterController::class,'register']);
Router::get('/auth/login',[LoginController::class,'loginView']);
Router::post('/auth/login',[LoginController::class,'login']);
Router::get('/user/panel', [PanelController::class,'index']);
Router::get('/auth/logout', [LoginController::class,'logout']);



// Router::get('/about','about');
Router::view('/about','about');


// Router::get('/article',function (){
//     return 'article page';
// });
// Router::get('/about',function (){
//     return 'about page';
// });
?>