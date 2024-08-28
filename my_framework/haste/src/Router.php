<?php  namespace Asus\Haste;
use App\Http\Controller\Auth\RegisterController;

class Router{

    protected Request $request;
    protected array $routerFiles=[];
    public function __construct() {
        $this->request=new Request();
    }
    static private $routesMap=[
        'get'=>[],
        'post'=>[]
    ];
    public function setRouterFiles($path) :Router
    {
        $this->routerFiles[$path]=$path;
        return $this;
    }
   static public function get($url,$callback):void
    {
        self::$routesMap['get'][$url]=$callback;
        
    }
    static public function post($url,$callback):void
    {
        self::$routesMap['post'][$url]=$callback;
        
    }
    static public function view($url,$callback):void
    {
        self::$routesMap['get'][$url]=$callback;
        
    }
    private function getCallbackFromDynamicRoute()
    {
            $values=[];
            $method=$this->request->getMethod();
            $url=$this->request->getUrl();
            $routsname=[];
            $routs=self::$routesMap[$method];
            foreach($routs as $rout=>$callback){
               if(! $rout){
                continue;
               }
               if(preg_match_all('/\{(\w+)(:[^}]+)?}/',$rout,$matches)){
                $routsname=$matches[1];
               }
               $routRegax=$this->convertRoutToRegax($rout);
               if(preg_match_all($routRegax,$url,$matches)){
                unset($matches[0]);
              
                foreach($matches as $match){
                $values[]=$match[0];
            }
                $routsParam=array_combine($routsname,$values);
                return [0=>$callback,1=>$routsParam];
               }
               
            }
            return false;
    }
    public function resolve()
    {


        foreach($this->routerFiles as $file){
            require_once $file;
        }

        $params=[];
            $method=$this->request->getMethod();
            $url=$this->request->getUrl();
            
            $callback=self::$routesMap[$method][$url] ?? false;
            if(! $callback){
               $routcallback=$this->getCallbackFromDynamicRoute();
            
            if(! $routcallback){
                throw new \Exception('not found');
            }
            $callback=$routcallback[0];
            $params=$routcallback[1];
        }

        if(is_string($callback)){
            return (new Views())->render($callback);
        }


        if(is_array($callback)){
            $controllerMethod= new \ReflectionMethod($callback[0],$callback[1]);



            $aoutoInjection=[];
            foreach($controllerMethod->getParameters() as $key=>$value){
                if($value->getType()) {
                    $class=$value->getType()->getName();
                    //var_dump($value->getType()->getName());die;
                    //$class = $value->getName();
                    if (class_exists($class)) {
                        $aoutoInjection[$value->getName()] = new $class;

                    }
                }
            
            }
            


            return ($controllerMethod->invoke(new $callback[0],...$aoutoInjection,...array_values($params)));
        }

            return call_user_func($callback,...array_values($params));
        
    }

    public function convertRoutToRegax($rout): string
    {
        return "@^".preg_replace_callback(
                '/\{\w+(:([^}]+))?}/',
               fn($matches)=> isset($matches[2]) ? "({$matches[2]})" : "([-\w]+)",
               $rout
               )."$@";
    }

}

?>