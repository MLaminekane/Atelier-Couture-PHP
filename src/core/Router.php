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
/*
//ArticleController
   /article
   /article/form
   /article/create
   //Enregister les routes de l'application
     $router::route("/article",[ArticleController::class,'lister'])
     $router::route("/article/form",[ArticleController::class,'lister'])
   
     $router::resolve() //Rechercher une route taper sur l'url ou a partir d'un form
   
     
//CategorieController
   /categorie
   /categorie/create
//AuthController
   /login
   /logout
//ApproController
/appro/save
  /appro/detail/show
  /appro/detail/add
  /appro/payement

*/


/*use App\Controllers\AuthController;
use App\Controllers\ApproController;
use App\Controllers\ArticleController;
use App\Controllers\CategorieController;

//Router ==> Choisir le controller et d'executer une Methode du controlleur
$ctrlCat=new CategorieController;
$ctrlArt=new ArticleController;
$ctrlAuth=new AuthController;
$ctrlAppro=new ApproController;

//if(isset($_GET['page']) || isset($_POST['page'])){  ==> $_REQUEST['page']
    //$page = isset($_GET['page'])?$_GET['page']: $_POST['page'];
    if(isset($_REQUEST['page']) )  {
        
    if( $_REQUEST['page']=='article'){
        $ctrlArt->lister(); 
    }elseif ( $_REQUEST['page']=='categorie') {
        $ctrlCat->lister(); 
    } elseif ( $_REQUEST['page']=='add-categorie') {
        $ctrlCat->add(); 
    } 
    elseif ($_REQUEST['page']=='show-form-article') {
        $ctrlArt->showForm(); 
    } 
     elseif ($_REQUEST['page']=='save-article') {
        $ctrlArt->save(); 
    }
    elseif ($_REQUEST['page']=='show-login-form') {
        $ctrlAuth->showFormLogin(); 
    }
    elseif ($_REQUEST['page']=='login') {
        $ctrlAuth->login(); 
    }elseif ($_REQUEST['page']=='logout') {
           $ctrlAuth->logout(); 
    }elseif ($_REQUEST['page']=='save-appro') {
          $ctrlAppro->save();
    }elseif ($_REQUEST['page']=='add-detail') {
        $ctrlAppro->addDetail();
  }elseif ($_REQUEST['page']=='show-appro') {
         $ctrlAppro->index();
   }
   elseif ($_REQUEST['page']=='valider-payement') {
         $ctrlAppro->validerPayement();
   }
   elseif ($_REQUEST['page']=='show-detail-appro') {
    $ctrlAppro->detailAppro();
}
//
    //
     
}else{
    $ctrlAuth->showFormLogin(); 
}
*/