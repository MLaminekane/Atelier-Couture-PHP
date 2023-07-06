<?php 
namespace App\Controllers;
use App\Core\Controller;
class NotFoundController  extends Controller{
    public function __construct()
    {
        parent::__construct();
       
    }
    public function _404(){
        $not=new NotFoundController;
        $this->layout="connexion" ;
        if(isset($_GET['page'])){
            $this->currentPage=$_GET['page'];
         }
        
         $this->render("errors/_404.html.php",);
    }
}