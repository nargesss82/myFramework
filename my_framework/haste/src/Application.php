<?php namespace Asus\Haste;

use Asus\Haste\Database\Database;

class Application{
    public static $app;

    public Router $router;
    public static $ROOT_DIR;
    public Database $db;
    public Request $request;
    public Response $response;
    public Session $session;
    public function __construct(string $root_dir) {
        self::$app = $this;
        self::$ROOT_DIR=$root_dir;
        $this->router=new Router();
        $this->db=new Database();
        $this->request=new Request();
        $this->response=new Response();
        $this->session=new Session();
    }

   

    public function run()
    {
   
    echo $this->router->resolve();
    }
    
}


?>