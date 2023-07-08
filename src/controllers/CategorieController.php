<?php
namespace App\Controllers;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Controller;
use Nette\Utils\Paginator;
use App\Models\CategorieModel;
//Service 
class CategorieController extends Controller{
    private CategorieModel $catModel;
    public function __construct()
    {
        parent::__construct();
        $this->catModel =new CategorieModel; 
    }
    public  function lister(){
        if(isset($_GET['page'])){
            $this->currentPage=$_GET['page'];
        }
        $this->paginator->setPage($this->currentPage); 
        $this->paginator ->setItemCount($this->catModel->coutQuery());
        $categories=$this->catModel->findByPaginate($this->paginator ->getOffset(),$this->paginator ->getLength());
        $this->render("categorie/liste.html.php",["categories"=>$categories,          
        ]);
    }

    public  function add(){
           extract($_POST);
        //  $validator=new Validator;
        Validator::isVide($libelle,"libelle","le libelle est obligatoire");  
        if(Validator::valide()){
        try {
            $this->catModel->setLibelle($libelle);
            $this->catModel->insert();
        } catch (\Throwable $th) {
         Validator::addError('libelle',"$libelle existe deja dans la BD");
        }    
    }

        Session::set("errors",Validator::getErrors());
        $this->redirect("/categorie");

}


}