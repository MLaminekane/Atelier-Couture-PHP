<?php
namespace App\Controllers;
use App\Core\Session;
use App\Core\Controller;
use App\Models\VenteModel;
use App\Models\ClientModel;
use Rakit\Validation\Validator;
use App\Models\DetailVenteModel;
use App\Models\ArticleVenteModel;

class VenteController extends Controller{
    private ArticleVenteModel $artVenteModel;
    public int $reste;
    private VenteModel $venteModel;
    private DetailVenteModel $detailVenteModel;
    private ClientModel $clientModel;
    public function __construct(){
        parent::__construct();
        $this->artVenteModel=new ArticleVenteModel;
        $this->venteModel=new VenteModel;
        $this->detailVenteModel=new DetailVenteModel;
        $this->clientModel =new ClientModel;
    }
    public  function index(){
       $clients = $this->clientModel->findAll();
       $sms="";
        if(isset($_POST['etatPayement'])){
           
                    
                    $etatPayement=$_POST['etatPayement'];
                    
                    $this->setNbrePerPage($this->venteModel->coutQueryPayer($etatPayement));
                    $this->paginator ->setItemCount($this->venteModel->coutQueryPayer($etatPayement));
                    $ventes=$this->venteModel->findByPaginateByPayer($this->paginator ->getOffset(),$this->paginator ->getLength(),$etatPayement);
        }else{
            if(isset($_POST['client'])){
                $this->paginator->setPage($this->currentPage); 
                $client=$_POST['client'];
                
                $this->paginator ->setItemCount($this->venteModel->coutQueryClient($client));
                $ventes=$this->venteModel->findByPaginateByClient($this->paginator ->getOffset(),$this->paginator ->getLength(), $client);
                if($ventes==[]){
                    $sms="Ce client n'a pas de vente";
                }
            }else{ 
                if(isset($_POST['date'])){
                    $this->paginator->setPage($this->currentPage); 
                    $date=$_POST['date'];
                    if(isset($_GET['page'])){
                        $this->currentPage=$_GET['page'];
                    }
                    $this->paginator ->setItemCount($this->venteModel->coutQueryDate($date));
                    $ventes=$this->venteModel->findByPaginateByDate($this->paginator ->getOffset(),$this->paginator ->getLength(), $date);
                    if($ventes==[] || $ventes != ""){
                        $sms="Cette date n'a pas de vente";
                    }
                }else{
                    if(isset($_GET['page'])){
                        $this->currentPage=$_GET['page'];
                    }
                    $this->paginator->setPage($this->currentPage); 
                    $this->paginator ->setItemCount($this->venteModel->coutQuery());
                    $ventes=$this->venteModel->findByPaginate($this->paginator ->getOffset(),$this->paginator ->getLength());
                }
    
            }
                
               
            
        }
             
        Session::set("sms",$sms);
    
            $this->render("vente/liste.html.php",[
                "ventes"=>$ventes, 
                "clients"=>$clients,         
            ]);
        
           
          
       

    }
    public function listeVenteClient(){
        
        
        $sms="";
        if(isset($_POST['client'])){
            $cl= ($_POST['client']);
            Session::set("cl",$cl);
        }
        $client=Session::get("cl");
         if(isset($_GET['page'])){
             $this->currentPage=$_GET['page'];
         }
               
                 $this->paginator->setPage($this->currentPage); 
                 $this->paginator ->setItemCount($this->venteModel->coutQueryClient($client));
                 $ventes=$this->venteModel->findByPaginateByClient($this->paginator ->getOffset(),$this->paginator ->getLength(), $client);
                 if($ventes==[]){
                     $sms="Ce client n'a pas de vente";
                 }
           
         Session::set("sms",$sms);
         
             $this->render("client/listeVente.html.php",[
                 "ventes"=>$ventes, 
             ]);
      
    }
    public  function save(){
        $clients = $this->clientModel->findAll();
        $articles= $this->artVenteModel->findAll();
        if(isset($_POST['save-vente'])){
          
           //Ajouter l'appro
           if(Session::isset("detailsVente")){
               $detailsVente=Session::get("detailsVente");
               $total=  Session::get("total");
               $client=Session::get("client");
               
               $this->venteModel->montant=$total;
               $this->venteModel->reste=$total;
               $this->venteModel->detailVente= $detailsVente;
               $this->venteModel->idClient= $client;
        
               $this->venteModel->insert();
               $sms="Article  ajoutee avec succes pour la vente  ";
           }else{
               $sms="Veuillez ajouter au moins un article dans la vente  ";
           }
            Session::set("sms",$sms);
           //Vider Panier
            Session::unset("detailsVente"); 
            Session::unset("total"); 
        }
        
       $this->render("vente/form.html.php",[
            "clients"=>$clients, 
           'articles'=> $articles
       ]) ;
     }

     public function addDetail(){ 
        //Valider les informations du formulaire 
         $articleSelect= $this->artVenteModel->findById($_POST['articleID']);
          
          $validator = new Validator;
            $validation = $validator->make($_POST, [
                'qteVente'                 => 'required',
                
            ],[
                'required' => 'Le :attribute  est obligatoire',
             
            ]);
         $validation->validate();
         if((!$validation->fails()) &&  $_POST['qteVente']<=$articleSelect->getQteStock()){
            $montant=$_POST['qteVente']*$articleSelect->getPrixAchat();
            if(!Session::isset("detailsVente")){
                $total=0;
                $detailsVente=[];
              }else{
                $detailsVente= Session::get("detailsVente"); 
                $total= Session::get("total"); 
              }
              $pos=$this->getPositionDetail($detailsVente,$articleSelect->getId());
              if($pos==-1){
                  $unDetail=[
                    "articleId"=> $articleSelect->getId(),
                    "article"=> $articleSelect->getLibelle(),
                    "qteVente"=>$_POST['qteVente'],
                    "prix"=>$articleSelect->getPrixAchat(),
                    "montant"=>$montant,
                    "qteStock"=>$articleSelect->getQteStock(),
                   ];
                $detailsVente[]=$unDetail;
              }else{
                $detailsVente[$pos]["qteVente"]+=$_POST['qteVente'];
                $detailsVente[$pos]["montant"]+=$montant;
              }
           
             $total+=$montant;
           Session::set("detailsVente",$detailsVente);
           Session::set("total",$total);
           $this->redirect("/vente/create");
         }

         
       $errors = $validation->errors();
       Session::set("errors",  $errors); 
       Session::set("data",$_POST); 
       $this->redirect("/vente/create");
      // dd( $unDetail);
    }
    public function addClient(){         
         $client=$_POST['client'];
         
       Session::set("client",$client);
       $this->redirect("/vente/create");
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
    public  function validerPayement(){
       
        $venteId=$_GET['id-vente'];
       
        $this->venteModel->savePayement($venteId);
        $this->redirect("/vente");
    }

    public  function detailVente(){
        $venteId=$_POST['id-vente'];
        $vente= $this->venteModel->findById($venteId);
        $detailsVente =$this->detailVenteModel->findDetailByvente( $venteId);
        $this->render("vente/detail.html.php",[
            'vente'=> $vente,
            'detailsVente'=> $detailsVente
        ]) ;
      }
     
      
}