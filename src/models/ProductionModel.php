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
        //Transaction  ==> ACID
        if(count($this->detailProdVente)!=0 && count($this->detailProdConf)!=0){
            $this->date=dateToString();
            //Au minimun on un detail 
            $sql="insert into $this->tableName values(NULL,:date,:montant)";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute([
                             "date"=>$this->date,  
                             "montant"=>$this->montant,
                            ]);
             $prodID=$this->pdo->lastInsertId() ;  
            if($prodID!=0){
                foreach ($this->detailProdVente as $unDetail) {
                    $this->detailVenteModel->articleID=$unDetail['articleId'];
                    $this->detailVenteModel->qteVente=$unDetail['qteVente'];
                    $this->detailVenteModel->prodID= $prodID;
                    if($this->detailVenteModel->insert()==1){
                        $this->articleModel->setId($unDetail['articleId']);
                        $this->articleModel->setQteStock($unDetail['qteStock']+$unDetail['qteVente']) ; 
                        $this->articleModel->update();
                    }
                }

                foreach ($this->detailProdConf as $unDetail) {
                    $this->detailConfModel->articleID =$unDetail['articleId'];
                    $this->detailConfModel->qteConf =$unDetail['qteConf'];
                    $this->detailConfModel->prodID= $prodID;
                    if($this->detailConfModel->insert()==1){
                        $this->articleModel->setId($unDetail['articleId']);
                        $this->articleModel->setQteStock($unDetail['qteStock']-$unDetail['qteConf']) ; 
                        $this->articleModel->update();
                    }
                }
                //qteStock =10   qteAppro=30   ==>  qteStock=40
            }
           return -1;                
        }

        return -1;
       
    }
   



}


    