<?php
namespace App\Controllers;
use App\Core\Session;
use App\Core\Controller;
use App\Models\VenteModel;
use App\Models\ClientModel;
use Rakit\Validation\Validator;

class ClientController extends Controller{

    private ClientModel $clientModel;
    private VenteModel $venteModel;
    public function __construct()
    {
        parent::__construct();
        $this->clientModel =new ClientModel;
        $this->venteModel=new VenteModel;
    }


   

    
    public  function lister(){
        // $users=  $this->userModel->findAll();
     
        if(isset($_GET['page'])){
            $this->currentPage=$_GET['page'];
         }
         $this->paginator->setPage($this->currentPage); 
         $this->paginator ->setItemCount($this->clientModel->coutQuery());
         $client=$this->clientModel->findByPaginate($this->paginator ->getOffset(),$this->paginator ->getLength());
        $this->render("client/liste.html.php",[
          "client"=>$client
      ]);
    
    }
    public  function showForm(){
        $client= $this->clientModel->findAll();
        $this->render("client/addClient.html.php",[
        "client"=>$client,
        
        ]);
    }
   

    
    
    

    public  function save(){
        // dd($this->clientModel->checkTel($_POST['telephoneP']));
        if($this->clientModel->checkTel($_POST['telephone'])){
           
            $this->redirect("/client/add");
        }else{
            $validator = new Validator;
            $validation = $validator->make($_POST, [
                 'nom'                 => 'required',
                 'prenom'              => 'required',
                 'telephone'              => 'required|numeric|min:9',

                 'adresse'              => 'required',
                 'etat'              => 'required',
             ],[
                 'required' => 'Le :attribute  est obligatoire',
                 'numeric'=>'le :attribute doit etre un numero',
                 'min'=>'le :attribute doit etre un numero',
                
             ]);
             $validation->validate();
             if(!$validation->fails()){
                $this->clientModel->setNom($_POST['nom']);
                $this->clientModel->setPrenom($_POST['prenom']);
                $this->clientModel->setTelephone($_POST['telephone']);
             
                $this->clientModel->setAdresse($_POST['adresse']);
                $this->clientModel->setEtat($_POST['etat']);
                $this->clientModel->insert();
                 $this->redirect("/client");
             }
             $errors = $validation->errors();
             Session::set("errors",  $errors); 
             Session::set("data",$_POST); 
             $this->redirect("/client/add");
            
            
        }
        
    }
}