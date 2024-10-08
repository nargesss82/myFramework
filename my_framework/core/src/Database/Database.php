<?php namespace Asus\Core\Database;

use Asus\Core\Database\Migrations;
use Exception;
use PDO;

class Database{
    public PDO $pdo;
    public Migrations $migrations;
    public function __construct() {
        try{
        $this->pdo=new PDO("mysql:host=localhost;dbname=mvc_project","root","-------");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);}catch(Exception $e){
            echo $e->getMessage();
        }
        $this->migrations=new Migrations($this);
    }
}

?>
