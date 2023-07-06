<?php 
namespace App\Models; 
use App\Core\Model;
class DetailVenteModel extends Model{
    public int $id;
    public int $qteVente;
    public int $venteID;
    public int $articleID;
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="detailVente"; 
    }

    public function insert()
    {
        $sql="insert into $this->tableName values(NULL,:qteVente,:venteID,:articleID) ";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute(["qteVente"=>$this->qteVente,
                         "venteID"=>$this->venteID, 
                         "articleID"=>$this->articleID, 
                        ]);
        return $stmt->rowCount();
    }
    public function findDetailByVente(int $venteId)
    {
        return $this->query("select * from $this->tableName d,Article a 
          where
          d.articleID=a.id and
          venteID=:venteId",
         ['venteId'=>$venteId]);
    }
    
}