<?php namespace Asus\Core;

use Asus\Core\Database\Database;

class Application{
    public static $app;

    public Router $router;
    public static $ROOT_DIR;
    public Database $db;
    public Request $request;
    public Response $response;
    public Session $session;
    public Views $views;
    public function __construct(string $root_dir) {
        self::$app = $this;
        self::$ROOT_DIR=$root_dir;
        $this->router=new Router();
        $this->db=new Database();
        $this->request=new Request();
        $this->response=new Response();
        $this->session=new Session();
        $this->views=new Views();
    }

   

    public function run()
    {
        try {
            echo $this->router->resolve();
        }catch (\Exception $e){
            if($e->getCode()){
                echo $this->views->render("errors.{$e->getCode()}",['errors'=>$e]);
                return;
            }
            echo $this->views->render("errors.500",['errors'=>$e]);

        }
    }
    
}


?>