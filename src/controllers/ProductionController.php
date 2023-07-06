<?php
namespace App\Controllers;
use App\Core\Session;
use App\Core\Controller;
use App\Models\ClientModel;
use App\Models\ProductionModel;

use Rakit\Validation\Validator;
use App\Models\ArticleVenteModel;
use App\Models\DetailProdConfModel;
use App\Models\DetailProdVenteModel;
use App\Models\ArticleConfectionModel;

class ProductionController extends Controller{
    private ArticleVenteModel $artVenteModel;
    private ArticleConfectionModel $artConfModel;
    private ProductionModel $prodModel;
    private DetailProdConfModel $detailConfModel;
    private DetailProdVenteModel $detailVenteModel;
    
    public function __construct(){
        parent::__construct();
        $this->artVenteModel=new ArticleVenteModel;
        $this->artConfModel=new ArticleConfectionModel;
        $this->prodModel=new productionModel;
        $this->detailVenteModel=new DetailProdVenteModel;
        $this->detailConfModel=new DetailProdConfModel;
        
    }
    public  function index(){
      
       $sms="";
            if(isset($_GET['page'])){
                $this->currentPage=$_GET['page'];
            }
            if(isset($_POST['date'])){
              $this->paginator->setPage($this->currentPage); 
              $date=$_POST['date'];
              if(isset($_GET['page'])){
                  $this->currentPage=$_GET['page'];
              }
              $this->paginator ->setItemCount($this->prodModel->coutQueryDate($date));
               $prods=$this->prodModel->findByPaginateByDate($this->paginator ->getOffset(),$this->paginator ->getLength(),$date);
              if($prods==[]){
                  $sms="Cette date n'a pas de Production";
              }
          }else{
            $this->paginator->setPage($this->currentPage); 
            $this->paginator ->setItemCount($this->prodModel->coutQuery());
            $prods=$this->prodModel->findByPaginate($this->paginator ->getOffset(),$this->paginator ->getLength());
          }
            Session::set("sms",$sms);
            $this->render("prod/liste.html.php",[
                "prods"=>$prods, 
            ]);
        }   
       

    
    
    public  function save(){
        $articleVentes=$this->artVenteModel->findAll();
        $articleConf=$this->artConfModel->findAll();
        
        if(isset($_POST['save-Prod'])){
          
            //Ajouter l'appro
            if(Session::isset("detailsProdVente") && Session::isset("detailsProdConf")){
                $detailsProdVente=Session::get("detailsProdVente");
                $detailsProdConf=Session::get("detailsProdConf");
                $total=  Session::get("total");
               
                $this->prodModel->montant=$total;
                $this->prodModel->detailProdVente = $detailsProdVente;
                $this->prodModel->detailProdConf =  $detailsProdConf;
        
                $this->prodModel->insert();
                $sms="Production ajoutee avec succes   ";
            }else{
                $sms="Erreur d'ajout ";
            }
             Session::set("sms",$sms);
           // Vider Panier
             Session::unset("detailsProdVente");
             Session::unset("detailsProdConf"); 
             Session::unset("total"); 
         }        
       $this->render("prod/form.html.php",[
           'articleVentes'=> $articleVentes,
           'articleConf'=>  $articleConf
       ]) ;
     }

     public function addDetailVente(){ 
        //Valider les informations du formulaire 
         $articleSelect= $this->artVenteModel->findById($_POST['articleID']);
          
          $validator = new Validator;
            $validation = $validator->make($_POST, [
                'qteVente'                 => 'required',
                
            ],[
                'required' => 'Le :attribute  est obligatoire',
             
            ]);
         $validation->validate();
         if((!$validation->fails())){
            $montant=$_POST['qteVente']*$articleSelect->getPrixAchat();
            if(!Session::isset("detailsProdVente")){
                $total=0;
                $detailsProdVente=[];
              }else{
                $detailsProdVente= Session::get("detailsProdVente"); 
                $total= Session::get("total"); 
              }
              $pos=$this->getPositionDetail($detailsProdVente,$articleSelect->getId());
              if($pos==-1){
                  $unDetail=[
                    "articleId"=> $articleSelect->getId(),
                    "article"=> $articleSelect->getLibelle(),
                    "qteVente"=>$_POST['qteVente'],
                    "prix"=>$articleSelect->getPrixAchat(),
                    "montant"=>$montant,
                    "qteStock"=>$articleSelect->getQteStock(),
                   ];
                $detailsProdVente[]=$unDetail;
              }else{
                $detailsProdVente[$pos]["qteVente"]+=$_POST['qteVente'];
                $detailsProdVente[$pos]["montant"]+=$montant;
              }
           
             $total+=$montant;
           Session::set("detailsProdVente",$detailsProdVente);
           Session::set("total",$total);
           $this->redirect("/prod/create");
         }

         
       $errors = $validation->errors();
       Session::set("errors",  $errors); 
       Session::set("data",$_POST); 
       $this->redirect("/prod/create");
      // dd( $unDetail);
    }
    public function addDetailConf(){ 
        //Valider les informations du formulaire 
         $articleSelect= $this->artConfModel->findById($_POST['articleID']);
        
          $validator = new Validator;
            $validation = $validator->make($_POST, [
                'qteProd'                 => 'required',
                
            ],[
                'required' => 'Le :attribute  est obligatoire',
             
            ]);
          
            $validation->validate();
            if(($validation->fails())){
                
            if(!Session::isset("detailsProdConf")){
                
                $detailsProdConf=[];
              }else{
                $detailsProdConf= Session::get("detailsProdConf"); 
              }
              $pos=$this->getPositionDetail($detailsProdConf,$articleSelect->getId());
              if($pos==-1){
                  $unDetail=[
                    "articleId"=> $articleSelect->getId(),
                    "article"=> $articleSelect->getLibelle(),
                    "qteConf"=>$_POST['qteConf'],
                    "prix"=>$articleSelect->getPrixAchat(),
                    "qteStock"=>$articleSelect->getQteStock(),
                   ];
                $detailsProdConf[]=$unDetail;
              }else{
                $detailsProdConf[$pos]["qteConf"]+=$_POST['qteConf'];
                
              }
             
           
           Session::set("detailsProdConf",$detailsProdConf);
  
           $this->redirect("/prod/create");
         }

         
       $errors = $validation->errors();
       Session::set("errors",  $errors); 
       Session::set("data",$_POST); 
       $this->redirect("/prod/create");
      // dd( $unDetail);
    }
   
    private function  getPositionDetail(array $data,int $articleId):int{
        foreach ($data  as  $key=>$value) {
             if($value['articleId']==$articleId){
                 return $key;
             }
        }
        return -1;
       
    }
    

    public  function detail(){
        $prodId=$_POST['id-prod'];
        $prods= $this->prodModel->findById($prodId);
        $detailsVente =$this->detailVenteModel->findDetailByProd( $prodId);
        $detailsconf =$this->detailConfModel->findDetailByProd( $prodId);
        
        $this->render("prod/detail.html.php",[
            'vente'=> $prods,
            'detailsVente'=> $detailsVente,
            'detailsconf'=>$detailsconf,
        ]) ;
      }
     
      
}