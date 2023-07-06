<?php 
namespace App\Models; 
use App\Core\Model;
class DetailProdConfModel extends Model{
    public int $id;
    public int $qteConf;
    public int $prodID;
    public int $articleID;
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="detailProdConf"; 
    }

    public function insert()
    {
        $sql="insert into $this->tableName values(NULL,:qteConf,:prodID,:articleID) ";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute(["qteConf"=>$this->qteConf,
                         "prodID"=>$this->prodID, 
                         "articleID"=>$this->articleID, 
                        ]);
        return $stmt->rowCount();
    }
    public function findDetailByProd(int $prodId)
    {
        return $this->query("select * from $this->tableName d,Article a 
          where
          d.articleID=a.id and
          prodId=:prodId",
         ['prodId'=>$prodId]);
    }
    
}