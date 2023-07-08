<?php 
namespace App\Models; 
use App\Core\Model;


class ArticleModel extends Model{
    protected int $id;
    protected string $libelle;
    protected float $prixAchat;
    protected int $qteStock;
    protected int $ordre;
    protected string $type;
    //ManyToOne
    protected int $categorieId;
    private CategorieModel $catModel;

    public function __construct()
    {
        parent::__construct();
        $this->tableName="article"; 
        $this->catModel = new CategorieModel; 
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

    /**
     * Get the value of prixAchat
     */ 
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set the value of prixAchat
     *
     * @return  self
     */ 
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Get the value of qteStock
     */ 
    public function getQteStock()
    {
        return $this->qteStock;
    }

    /**
     * Set the value of qteStock
     *
     * @return  self
     */ 
    public function setQteStock($qteStock)
    {
        $this->qteStock = $qteStock;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
        /**
     * Get the value of categorieId
     */ 
    public function getCategorie()
    {
        return $this->catModel->findById($this->categorieId);
    }

    /**
     * Set the value of categorieId
     *
     * @return  self
     */ 
    public function setCategorieId($categorieId)
    {
        $this->categorieId = $categorieId;
        return $this;
    }
    public function insert($data):int{
        $sql="INSERT INTO $this->tableName VALUES (NULL,:libelle,:prixAchat,:qteStock,:type,:dateProduction, :fournisseur, :categorieId, :ordre)";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute(["libelle"=>$this->libelle,
                         "prixAchat"=>$this->prixAchat, 
                         "qteStock"=>$this->qteStock, 
                         "type"=>$this->type,
                         "dateProduction"=>$this->type=='ArticleVente'?$data: null,
                         "fournisseur"=>$this->type=='ArticleConfection'?$data: null,
                         "categorieId"=>$this->categorieId,
                         "ordre"=>$this->type=='ArticleConfection'? 1: 0,
                        ]);
        return $stmt->rowCount();
    }
    public function update():int{
        $sql="UPDATE $this->tableName SET qteStock = :qteStock WHERE id=:artcleID";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([
                         "qteStock"=>$this->qteStock, 
                         "artcleID"=>$this->id, 
                        ]);
        return $stmt->rowCount();
    }
    public function findAll():array{
        return $this->query("select * from $this->tableName where type like :type",["type"=>$this->type]);  
    }



    public function findByPaginate(int $offset,int $nbreParPage):array{
        $sql="select * from $this->tableName where  type  like :type limit $offset,$nbreParPage";  //Requete Non preparee
        return $this->query($sql,["type"=>$this->type]);
    }

    public function coutQuery():int{
        $sql="select count(*) as nbre  from $this->tableName where  type  like :type ";  //Requete Non preparee
        return $this->query($sql,["type"=>$this->type],true)->nbre;
    }

    public function getTypesArticle():array{
        return $this->query("SELECT Distinct `type`,ordre FROM `Article` ORDER by ordre desc"); 
    }



}