<?php 
namespace App\Models; 
use App\Core\Model;
class ClientModel extends Model{
    public int $id;
    public string $nom;
    public  string $prenom;
    public  string $telephone;
   
    public  string $adresse;
    public int $etat;

    public  $ventes=[];

    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="client"; 
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

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of telephonePortable
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephonePortable
     *
     * @return  self
     */ 
    public function setTelephone($telephoneP)
    {
        $this->telephone = $telephoneP;

        return $this;
    }

    /**
     * Get the value of telephoneFixe
     */ 
    

    /**
     * Set the value of telephoneFixe
     *
     * @return  self
     */ 
   

    /**
     * Get the value of Adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of Adresse
     *
     * @return  self
     */ 
    public function setAdresse($Adresse)
    {
        $this->adresse = $Adresse;

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
        $sql="INSERT INTO $this->tableName  VALUES (NULL,:nom,:prenom,:telP,:ad,:etat) ";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute(["nom"=>$this->nom,
                         "prenom"=>$this->prenom, 
                         "telP"=>$this->telephone,
                         "ad"=>$this->adresse,
                         "etat"=>$this->etat,
                        ]);
        return $stmt->rowCount();
    }
    public function checkTel(string $tel){
        // if ($this->checkExistance())
        $client= $this->query("select * from $this->tableName where telephone=:x",["x"=>$tel],true);
    
        if($client==false){
            return false;
        }
        return true;
    }
}