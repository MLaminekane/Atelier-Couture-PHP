<?php 
namespace App\Models; 
use App\Core\Model;
class DetailApproModel extends Model{
    public int $id;
    public int $qteAppro;
    public int $approID;
    public int $articleID;
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="detailAppro"; 
    }

    public function insert()
    {
        $sql="insert into $this->tableName values(NULL,:qteAppro,:approID,:articleID) ";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute(["qteAppro"=>$this->qteAppro,
                         "approID"=>$this->approID, 
                         "articleID"=>$this->articleID, 
                        ]);
        return $stmt->rowCount();
    }
    public function findDetailByAppro(int $approId)
    {
        return $this->query("select * from $this->tableName d,Article a 
          where
          d.articleID=a.id and
          approId=:approId",
         ['approId'=>$approId]);
    }
    
}