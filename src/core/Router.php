<?php 
namespace App\Core;
use App\Controllers\NotFoundController;

class Router{
    //Enregister les routes de l'application
    private static array $routes=[];
    public static  function route(string $uri,array $route){
        self::$routes[$uri]=$route;
    }

    public static  function resolve(){
        
        $uri=explode("?",$_SERVER['REQUEST_URI'])[0];
        
        if(isset(self::$routes[$uri])){
            //Route existe
            //$ctrl=self::$routes[$uri][0];
            //$action=self::$routes[$uri][1];
            [$ctrlClasseName,$action]=self::$routes[$uri];
           
            if(class_exists($ctrlClasseName) && method_exists($ctrlClasseName,$action)){
                    
                  $ctrl=new $ctrlClasseName();
                  call_user_func([$ctrl,$action]);
            }else{
                 $error=new NotFoundController;
                 $error->_404();
                 //Route Pas existe ==> Page Note Found
                
            }
            
        }else{
            $error=new NotFoundController;
            $error->_404();
             //Route Pas existe ==> Page Note Found
        }
       
    }
}
