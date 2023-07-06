<?php 
namespace App\Models; 
use App\Core\Model;
class UserModel extends Model{
    public int $id;
    public string $nomComplet;
    public  string $login;
    public  string $password;
    public  string $role;
    public int $etat;

    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="users"; 
    }
    
    public function findUserByLoginAndPassword(string $login,string $password){
       return  $this->query("select * from users 
                             where login like :login and password like :password",
                        ["login"=>$login,"password"=>$password],
                        true
                );
    }

    /**
     * Set the value of nomComplet
     *
     * @return  self
     */ 
    public function setNomComplet($nomComplet)
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    /**
     * Set the value of nomComplet
     *
     * @return  self
     */ 
   
    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of nomComplet
     */ 
    public function getNomComplet()
    {
        return $this->nomComplet;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of etat
     */ 
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set the value of etat
     *
     * @return  self
     */ 
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }
    public function insert():int{
        $sql="INSERT INTO $this->tableName  VALUES (NULL,:nomComplet,:password,:role,:login,:etat) ";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute(["nomComplet"=>$this->nomComplet,
                        "password"=>$this->password, 
                         "login"=>$this->login, 
                         "role"=>$this->role,
                         "etat"=>$this->etat,
                        ]);
        return $stmt->rowCount();
    }
  
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

}
   