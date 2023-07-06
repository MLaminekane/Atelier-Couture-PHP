<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Session;
use App\Models\ArticleConfectionModel;
use App\Models\ApprovisionnementModel;
use App\Models\DetailApproModel;
class ApproController extends Controller{
  private ArticleConfectionModel $artConfModel;
  private ApprovisionnementModel $approModel;
  private DetailApproModel $detailApproModel;
  public function __construct(){
    parent::__construct();
    $this->artConfModel=new ArticleConfectionModel;
    $this->approModel=new ApprovisionnementModel;
    $this->detailApproModel=new DetailApproModel;
  }
  public  function validerPayement(){
    $approId=$_GET['id-appro'];
    $this->approModel->savePayement($approId);
    $this->redirect("/appro");
  }
  public function save(){
    $articles = $this->artConfModel->findAll();
    if(isset($_POST['save-appro'])){
      if(Session::isset("detailsAppro")){
        $detailsAppro=Session::get("detailsAppro");
        $total=  Session::get("total");
        $this->approModel->montant=$total;
        $this->approModel->detailAppro= $detailsAppro;
        
        $this->approModel->insert();
        $sms="Ajout avec succes";
      }else{
        $sms="Veuillez ajouter au moins un article dans l'approvisionnement  ";
      }
        Session::set("sms",$sms);
        Session::unset("detailsAppro"); 
        Session::unset("total"); 
    }
    $this->render("appro/form.html.php",['articles'=> $articles]) ;
  }
  public function index(){
    $etatPayement=0;
    if(isset($_POST['etatPayement'])){
      $etatPayement=$_POST['etatPayement'];
    }
    $appros=$this->approModel->findApproByPaiement($etatPayement);
    $this->render("appro/liste.html.php",[
        'appros'=>  $appros
    ]) ;
  }
      public function addDetail(){ 
            //Valider les informations du formulaire 
             $articleSelect= $this->artConfModel->findById($_POST['articleID']);
              $montant=$_POST['qteAppro']*$articleSelect->getPrixAchat();
             
             if(!Session::isset("detailsAppro")){
                $total=0;
                $detailsAppro=[];
              }else{
                $detailsAppro= Session::get("detailsAppro"); 
                $total= Session::get("total"); 
              }
              $pos=$this->getPositionDetail($detailsAppro,$articleSelect->getId());
              if($pos==-1){
                  $unDetail=[
                    "articleId"=> $articleSelect->getId(),
                    "article"=> $articleSelect->getLibelle(),
                    "qteAppro"=>$_POST['qteAppro'],
                    "prix"=>$articleSelect->getPrixAchat(),
                    "montant"=>$montant,
                    "qteStock"=>$articleSelect->getQteStock(),
                   ];
                $detailsAppro[]=$unDetail;
              }else{
                $detailsAppro[$pos]["qteAppro"]+=$_POST['qteAppro'];
                $detailsAppro[$pos]["montant"]+=$montant;
              }
           
             $total+=$montant;
           Session::set("detailsAppro",$detailsAppro);
           Session::set("total",$total);
           $this->redirect("/appro/create");
          // dd( $unDetail);
      }

      //Lister les details un Approvisionnement
      public  function detailAppro(){
        $approId=$_POST['id-appro'];
        $appro= $this->approModel->findById($approId);
        $detailsAppro =$this->detailApproModel->findDetailByAppro(  $approId);
        $this->render("appro/detail.html.php",[
            'appro'=> $appro,
            'detailsAppro'=> $detailsAppro
        ]) ;
      }

      private function  getPositionDetail(array $data,int $articleId):int{
         foreach ($data  as  $key=>$value) {
              if($value['articleId']==$articleId){
                  return $key;
              }
         }
         return -1;
        
      }
      
}