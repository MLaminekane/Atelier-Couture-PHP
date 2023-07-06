<?php 
namespace App\Models; 
use App\Core\Model;
class CategorieModel extends Model{
    private int $id;
    private string $libelle;
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="categorie"; 
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
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }
    public function insert():int{
        $sql="INSERT INTO $this->tableName (`id`, `libelle`) VALUES (NULL,:libelle)";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute(["libelle"=>$this->libelle]);
        return $stmt->rowCount();
    }

    public function update():int{
        //A Faire
        return 0;
    }
}