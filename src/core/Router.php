<?php 
namespace App\Core;
use App\Controllers\NotFoundController;

class Router{
    private static array $routes=[];
    public static  function route(string $uri,array $route){
        self::$routes[$uri]=$route;
    }

    public static function resolve(){
        
        $uri=explode("?",$_SERVER['REQUEST_URI'])[0];
        
        if(isset(self::$routes[$uri])){

            [$ctrlClasseName,$action]=self::$routes[$uri];
           
            if(class_exists($ctrlClasseName) && method_exists($ctrlClasseName,$action)){
                    
                  $ctrl=new $ctrlClasseName();
                  call_user_func([$ctrl,$action]);
            }else{
                 $error=new NotFoundController;
                 $error->_404();                
            }
            
        }else{
            $error=new NotFoundController;
            $error->_404();
        }
       
    }
}
