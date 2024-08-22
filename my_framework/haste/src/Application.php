<?php namespace Asus\Haste;

use Asus\Haste\Database\Database;

class Application{
    public static $app;

    public Router $router;
    public static $ROOT_DIR;
    public Database $db;
    public function __construct(string $root_dir) {
        self::$app;
        self::$ROOT_DIR=$root_dir;
        $this->router=new Router();
        $this->db=new Database();
    }

   

    public function run()
    {
   
    echo $this->router->resolve();
    }
    
}


?>