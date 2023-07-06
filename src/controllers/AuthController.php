<?php
namespace App\Controllers;
use App\Core\Session;
use App\Core\Controller;
use App\Models\UserModel;
use Rakit\Validation\Validator;

class AuthController extends Controller{

    private UserModel $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel =new UserModel;
    }


    public function showFormLogin(){
          $this->layout="connexion" ;
          $this->render("auth/login.html.php");
    }

    
    public  function lister(){
        // $users=  $this->userModel->findAll();
        if(isset($_GET['page'])){
            $this->currentPage=$_GET['page'];
         }
         $this->paginator->setPage($this->currentPage); 
         $this->paginator ->setItemCount($this->userModel->coutQuery());
         $users=$this->userModel->findByPaginate($this->paginator ->getOffset(),$this->paginator ->getLength());
        $this->render("auth/liste.html.php",[
          "users"=>$users
      ]);
    
    }
    public  function showForm(){
        $users=  $this->userModel->findAll();
        $this->render("auth/addUser.html.php",[
        "users"=>$users,
        
        ]);
    }
    public function login()
    { 
      // Validator::isEmail($_POST['login'],"login") ;
       //Validator::isVide($_POST['password'],"password","Le Mot de Passe est obligatoire") ;
       $validator = new Validator;
       $validation = $validator->make($_POST, [
        'login'                 => 'required|email',
        'password'              => 'required|min:3',
      ],[
         'required' => 'Le :attribute  est obligatoire',
         'email' => 'Le :attribute doit etre un email',
         'min' => 'Le :attribute doit avoir au minimun :min caracteres',
     ]);
      $validation->validate();
       if(!$validation->fails()){
           $user= $this->userModel->findUserByLoginAndPassword($_POST['login'],$_POST['password']);   
           if($user==null){
              // Validator::addError("error_connexion","Login ou Mot de Passe incorrect");
           }else{
               //La session ne stocke pas d'objet
               //La session peut stoker soit des donnees de type elementaire
               //soit un tableau
               //Authentification stateFull 
               //Connexion ==> Authentification + Autorisation 
                 Session::set("userconnect",toArray($user) );
                 $this->redirect("/categorie");
           }
       }
         $errors = $validation->errors();
         Session::set("errors",  $errors); 
         Session::set("data",$_POST); 
         $this->redirect("/login/form");
    }

    
    
    public function logout() {
        Session::unset("userconnect");
        Session::destroySession();
        $this->redirect("/login/form");
    }

    public  function save(){
          
        // Validator::isVide($_POST['libelle'],"libelle");
        // Validator::isNumber($_POST['qteStock'],"qteStock");
        // Validator::isVide($_POST['categorie'],"categorie");
        $validator = new Validator;
       $validation = $validator->make($_POST, [
        'nomComplet'                 => 'required',
        'login'                 => 'required|email',
        'password'              => 'required|min:3',
        'role'                   => 'required',
        'etat'                   => 'required',
        ],[
            'required' => 'Le :attribute  est obligatoire',
            'email' => 'Le :attribute doit etre un email',
            'min' => 'Le :attribute doit avoir au minimun :min caracteres',
        ]);
        $validation->validate();
        if(!$validation->fails()){
            $this->userModel->setNomComplet($_POST['nomComplet']);
            $this->userModel->setLogin($_POST['login']);
            $this->userModel->setPassword($_POST['password']);
            $this->userModel->setRole($_POST['role']);
            $this->userModel->setEtat($_POST['etat']);
            $this->userModel->insert();
            $this->redirect("/user");
        }else{
            $errors = $validation->errors();
            Session::set("errors",  $errors); 
            Session::set("data",$_POST); 
            $this->redirect("/user/add");
           
        }
     
       
    }
}