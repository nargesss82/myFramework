<?php
require_once __DIR__ . "./../vendor/autoload.php";
use Asus\Core\Application;

$app=new Application(dirname(__DIR__));
switch($argv[1] ?? false){
    case '--rollback':$app->db->migrations->rollbackMigrations();break;
    default:$app->db->migrations->applyMigrations();
}



?>