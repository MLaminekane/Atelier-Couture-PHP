<?php
namespace App\Models;
use App\Core\Model; 
class ApprovisionnementModel extends Model{
   public int $id; 
   public string $date; 
   public float $montant; 
   public bool $payer; 

    //OneToMany 
    public $detailAppro=[];

    private DetailApproModel $detailModel;
    private ArticleModel $articleModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="approvisionnement"; 
        $this->date=dateToString();
        $this->detailModel=new DetailApproModel;
        $this->articleModel=new ArticleModel;
    }
    public function findApproByPaiement(int $payement=0)
    {
          return $this->query("select * from $this->tableName where payer=:payer",["payer"=>$payement]);
    }
    public function insert()
    {
        //Transaction  ==> ACID
        if(count($this->detailAppro)!=0){
            //Au minimun on un detail 
            $sql="insert into $this->tableName values(NULL,:montant,:date,0)";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute([
                             "montant"=>$this->montant,
                             "date"=>$this->date,  
                            ]);
             $approID=$this->pdo->lastInsertId() ;  
            if($approID!=0){
                foreach ($this->detailAppro as $unDetail) {
                    $this->detailModel->articleID=$unDetail['articleId'];
                    $this->detailModel->qteAppro=$unDetail['qteAppro'];
                    $this->detailModel->approID= $approID;
                    if($this->detailModel->insert()==1){
                        $this->articleModel->setId($unDetail['articleId']);
                        $this->articleModel->setQteStock($unDetail['qteAppro']+$unDetail['qteStock']) ; 
                        $this->articleModel->update();
                    }
                }
                //qteStock =10   qteAppro=30   ==>  qteStock=40
            }
           return -1;                
        }

        return -1;
       
    }
    public function savePayement(int $approID):int{
        $sql="UPDATE $this->tableName  SET payer=1 WHERE  id=:approID";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([
                         "approID"=>$approID, 
                        ]);
        return $stmt->rowCount();
}



}


    