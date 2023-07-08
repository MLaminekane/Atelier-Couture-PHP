<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Session;
use App\Core\Validator;
use App\Models\ArticleConfectionModel;
use App\Models\CategorieModel;
use App\Models\ArticleModel;
use App\Models\ArticleVenteModel;
//Service 
class ArticleController extends Controller{
    private CategorieModel $catModel;
    private ArticleModel $articleModel;
    public function __construct()
    {
      parent::__construct();
      $this->catModel =new CategorieModel;  
      $this->articleModel =new ArticleModel; 
       
    }
  public function lister(){
    if (isset($_POST['article'])) {
        if ($_POST['article'] == "ArticleVenteModel") {
            $articleModel = new ArticleVenteModel;
        } else {
            $articleModel = new ArticleConfectionModel;
        }
    } else {
        $articleVenteModel = new ArticleVenteModel;
        $articleConfectionModel = new ArticleConfectionModel;
        $articlesVente = $articleVenteModel->findAll();
        $articlesConfection = $articleConfectionModel->findAll();
        $articles = array_merge($articlesVente, $articlesConfection);
    }
    if (isset($_GET['page'])) {
        $this->currentPage = $_GET['page'];
    }
    $this->paginator->setPage($this->currentPage);
    $this->paginator->setItemCount(count($articles));
    $articles = array_slice($articles, $this->paginator->getOffset(), $this->paginator->getLength());
    $this->render("article/liste.html.php", ["articles" => $articles]);
  }

  public function showForm(){
    $categories=  $this->catModel->findAll();
    $this->render("article/form.html.php",[
      "categories"=>$categories,
      "types"=>  $this->articleModel->getTypesArticle()
    ]);
  }
  public function save(){   
    Validator::isVide($_POST['libelle'],"libelle");
    Validator::isNumber($_POST['qteStock'],"qteStock");
    Validator::isVide($_POST['categorie'],"categorie");
    if(Validator::valide()){
      $this->articleModel->setLibelle($_POST['libelle']); 
      $this->articleModel->setQteStock($_POST['qteStock']); 
      $this->articleModel->setPrixAchat($_POST['prixAchat']);
      $this->articleModel->setType($_POST['type']);
      $this->articleModel->setCategorieId($_POST['categorie']);
      if($_POST['type']=="ArticleConfection"){
          $data=$_POST['fournisseur'];
      }elseif($_POST['type']=="ArticleVente"){
          $data=dateToEn($_POST['dateProduction']);  
      }
        $this->articleModel->insert($data);     
        $this->redirect("/article");
    }else{
    Session::set("errors",Validator::getErrors()); 
    Session::set("data",$_POST); 
    $this->redirect("/article/form");
    }   
  }
}