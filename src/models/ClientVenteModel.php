<?php 
namespace App\Models; 
use App\Core\Model;
class ClientVenteModel extends Model{
    public int $id;
    
    public int $venteID;
    public int $clientID;
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="clientVente"; 
    }

    public function insert()
    {
        $sql="insert into $this->tableName values(NULL,:venteID,:clientID) ";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([
                         "venteID"=>$this->venteID, 
                         "clientID"=>$this->clientID, 
                        ]);
        return $stmt->rowCount();
    }
    public function findVenteByClient(int $clientId)
    {
        return $this->query("select * from $this->tableName 
          where
          clientID=:clientId",
         ['clientId'=>$clientId]);
    }
    
}