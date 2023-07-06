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
            //throw $th;
             //Erreur Unicite
            // $errors['libelle']="$libelle existe deja dans la BD";
            Validator::addError('libelle',"$libelle existe deja dans la BD");
        }    
    }
    /**
     * Variable de Requete ==> Il n'existe que durant traitement la requete 
     * ces variables sont reinitialisees a chaque requete
     * ces variables sont Crees et detruites par le server   
     * $_GET ==> request GET
     * $_POST ==> request POST
     * $_REQUEST ==> request  GET ou POST
     * 
     * 
     *   Session : une variable qui existe entre plusieurs requetes  ==>$_SESSION
     *   Le tableau  $_SESSION est gere par le developpeur
     *     ==Creer le Tableau ==> session_start()
     *     ==stocke des valeurs dans le Tableau ==> $_SESSION['key']=valeur
     *     ==detruit le Tableau ==> session_destroy()
     */
       Session::set("errors",Validator::getErrors());
        //Redirection
      // header("location:".BASE_URL."/?page=categorie");//GET
      $this->redirect("/categorie");

}


}