<?php
namespace App\Models;
use App\Core\Model; 
class VenteModel extends Model{
   public int $id; 
   public string $date; 
   public float $montant; 
   public float $reste; 
   public bool $payer; 
   public int $idClient;

    //OneToMany 
    public $detailVente=[];

    private DetailVenteModel $detailModel;
    private ArticleModel $articleModel;
   
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="vente"; 
        
        $this->detailModel=new DetailVenteModel;
        $this->articleModel=new ArticleModel;
    }

    public function findVenteByPaiement(int $payement=0)
    {
          return $this->query("select * from $this->tableName where payer=:payer",["payer"=>$payement]);
    }
    public function findByPaginateByPayer(int $offset,int $nbreParPage,int $payer):array{
        $sql="select * from $this->tableName where payer=:payer limit $offset,$nbreParPage ";  //Requete Non preparee
        return $this->query($sql,["payer"=>$payer]);
    }
    //
    public function coutQueryPayer(int $payer=0):int{
        $sql="select count(*) as nbre from $this->tableName where payer=:payer";  //Requete Non preparee
        return $this->query($sql,["payer"=>$payer],true)->nbre;
    }
    public function coutQueryDate(string $date):int{
        $sql="select count(*) as nbre from $this->tableName where date=:date";  //Requete Non preparee
        return $this->query($sql,["date"=>$date],true)->nbre;
    }
    public function findByPaginateByClient(int $offset,int $nbreParPage,int $client):array{
        $sql="select * from $this->tableName where idClient=:idClient limit $offset,$nbreParPage ";  //Requete Non preparee
        return $this->query($sql,["idClient"=>$client]);
    }
    public function findByPaginateByDate(int $offset,int $nbreParPage,string $date):array{
        $sql="select * from $this->tableName where date=:date limit $offset,$nbreParPage ";  //Requete Non preparee
        return $this->query($sql,["date"=>$date]);
    }
    public function coutQueryClient(int $client):int{
        $sql="select count(*) as nbre from $this->tableName where idClient=:idClient";  //Requete Non preparee
        return $this->query($sql,["idClient"=>$client],true)->nbre;
    }
    
    public function savePayement(int $venteID):int{
        $sql="UPDATE $this->tableName  SET payer=1,reste=0 WHERE  id=:venteID";
        $stmt= $this->pdo->prepare($sql);
       
        $stmt->execute([
                         "venteID"=>$venteID, 
                        ]);
        return $stmt->rowCount();
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
    * Get the value of date
    */ 
   public function getDate()
   {
      return $this->date;
   }

   /**
    * Set the value of date
    *
    * @return  self
    */ 
   public function setDate($date)
   {
      $this->date = $date;

      return $this;
   }

   /**
    * Get the value of montant
    */ 
   public function getMontant()
   {
      return $this->montant;
   }

   /**
    * Set the value of montant
    *
    * @return  self
    */ 
   public function setMontant($montant)
   {
      $this->montant = $montant;

      return $this;
   }

   /**
    * Get the value of payer
    */ 
   public function getPayer()
   {
      return $this->payer;
   }

   /**
    * Set the value of payer
    *
    * @return  self
    */ 
   public function setPayer($payer)
   {
      $this->payer = $payer;

      return $this;
   }

   /**
    * Get the value of idClient
    */ 
   public function getIdClient()
   {
      return $this->idClient;
   }

   /**
    * Set the value of idClient
    *
    * @return  self
    */ 
   public function setIdClient($idClient)
   {
      $this->idClient = $idClient;

      return $this;
   }
   /**
    * Get the value of reste
    */ 
   public function getReste()
   {
      return $this->reste;
   }

   /**
    * Set the value of reste
    *
    * @return  self
    */ 
   public function setReste($reste)
   {
      $this->reste = $reste;

      return $this;
   }

   public function insert()
   {
      if(count($this->detailVente)!=0){
         $this->date=dateToString();
         $sql="insert into $this->tableName values(NULL,:date,:montant,:reste,0,:idClient)";
         $stmt= $this->pdo->prepare($sql);
         $stmt->execute([
                           "date"=>$this->date,  
                           "montant"=>$this->montant,
                           "idClient"=>$this->idClient,
                           "reste"=>$this->reste,  
                        ]);
         $venteID=$this->pdo->lastInsertId() ;  
         if($venteID!=0){
            foreach ($this->detailVente as $unDetail) {
               $this->detailModel->articleID=$unDetail['articleId'];
               $this->detailModel->qteVente=$unDetail['qteVente'];
               $this->detailModel->venteID= $venteID;
               if($this->detailModel->insert()==1){
                  $this->articleModel->setId($unDetail['articleId']);
                  $this->articleModel->setQteStock($unDetail['qteStock']-$unDetail['qteVente']) ; 
                  $this->articleModel->update();
               }
            }
         }
         return -1;                
      }
      return -1;
   }
}