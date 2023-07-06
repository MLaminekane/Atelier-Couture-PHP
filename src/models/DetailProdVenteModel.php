<?php 
namespace App\Models; 
use App\Core\Model;
class DetailProdVenteModel extends Model{
    public int $id;
    public int $qteVente;
    public int $prodID;
    public int $articleID;
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="detailProVente"; 
    }

    public function insert()
    {
        $sql="insert into $this->tableName values(NULL,:qteVente,:prodID,:articleID) ";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute(["qteVente"=>$this->qteVente,
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