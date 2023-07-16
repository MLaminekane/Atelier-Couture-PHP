<?php
namespace App\Models;
use App\Core\Model;

class ProductionModel extends Model{
   public int $id; 
   public string $date; 
   public float $montant; 

    //OneToMany 
    public $detailProdConf=[];
    public $detailProdVente=[];

    private DetailProdConfModel $detailConfModel;
    private DetailProdVenteModel $detailVenteModel;
    private ArticleModel $articleModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="production"; 
      
        $this->detailConfModel=new DetailProdConfModel;
        $this->detailVenteModel=new DetailProdVenteModel;
        $this->articleModel=new ArticleModel;
    }

    public function coutQueryDate(string $date):int{
        $sql="select count(*) as nbre from $this->tableName where date=:date";  //Requete Non preparee
        return $this->query($sql,["date"=>$date],true)->nbre;
    }
    public function findByPaginateByDate(int $offset,int $nbreParPage,string $date):array{
        $sql="select * from $this->tableName where date=:date limit $offset,$nbreParPage ";  //Requete Non preparee
        return $this->query($sql,["date"=>$date]);
    }
    public function insert()
    {
        if(count($this->detailProdVente) == 0 || count($this->detailProdConf) == 0){
            return -1;
        }
        $this->date = dateToString();
        $sql = "INSERT INTO $this->tableName VALUES (NULL, :date, :montant)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "date" => $this->date,
            "montant" => $this->montant,
        ]);
        $prodID = $this->pdo->lastInsertId();
        if($prodID == 0){
            return -1;
        }
        foreach ($this->detailProdVente as $unDetail) {
            $this->detailVenteModel->articleID = $unDetail['articleId'];
            $this->detailVenteModel->qteVente = $unDetail['qteVente'];
            $this->detailVenteModel->prodID = $prodID;
            if($this->detailVenteModel->insert() == 1){
                $this->articleModel->setId($unDetail['articleId']);
                $this->articleModel->setQteStock($unDetail['qteStock']+$unDetail['qteVente']) ; 
            }
        }
        foreach ($this->detailProdConf as $unDetail) {
            $this->detailConfModel->articleID = $unDetail['articleId'];
            $this->detailConfModel->qteConf = $unDetail['qteConf'];
            $this->detailConfModel->prodID = $prodID;
            if($this->detailConfModel->insert() == 1){
                $this->articleModel->setId($unDetail['articleId']);
                $this->articleModel->setQteStock($unDetail['qteStock']-$unDetail['qteConf']) ; 
            }
        }   
        return -1;
    }
}


    