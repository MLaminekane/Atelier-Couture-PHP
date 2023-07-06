<?php 
namespace App\Core; 
#[\AllowDynamicProperties]
class Model {
    protected string $tableName;
    /*
       1-Connexion  a un SGBD et de Selectionner une BD
       2-Executer des Requetes Sql
       3-Recuperer des donnes
          -Mise a jour (insert,update,delete)  
              retourne un entier qui represente le nombre de lignes 
              modifies par la requete
          -Select
              -retourne un array d'objets
              -retourne un objet
     */
    protected \PDO $pdo; 
    
    public function __construct()
    {
       // $this->pdo=new PDO("mysql:host=localhost:3306;dbname=l2_ism_php_2023_glrsa","root","");
       // 1-Connexion  a un SGBD et de Selectionner une BD
       try {
          $this->pdo=new \PDO("mysql:host=localhost:3306;dbname=exam_atelier_couture","root","root"); 
       } catch (\Exception $ex) {
         die($ex->getMessage());
       }
       
    }
    public function findByPaginate(int $offset,int $nbreParPage):array{
        $sql="select * from $this->tableName limit $offset,$nbreParPage";  //Requete Non preparee
        return $this->query($sql);
    }
    public function coutQuery():int{
        $sql="select count(*) as nbre from $this->tableName";  //Requete Non preparee
        return $this->query($sql,[],true)->nbre;
    }

    
    public function findAll():array{
        $sql="select * from $this->tableName";  //Requete Non preparee
        $stmt= $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_CLASS,get_called_class()); 
    }
   
 
    public function query(string $sql,$data=[],$single=false){
        $stmt= $this->pdo->prepare($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS,get_called_class());
        $stmt->execute($data);
        if($single){
            return $stmt->fetch();  
        }else{
            return $stmt->fetchAll(\PDO::FETCH_CLASS,get_called_class());   
        }
        
    }

    public function executeUpdate(){
        
    }

    public function findById(int $id){
        //$sql="select * from categorie where id=$id";//Requete  preparee
       /* $sql="select * from $this->tableName where id=:x";
        $stmt= $this->pdo->prepare($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS,get_called_class());
        $stmt->execute(["x"=>$id]);
        return $stmt->fetch();*/
        return $this->query("select * from $this->tableName where id=:x",["x"=>$id],true);
    }

    public function remove(int $id):int{
        //$sql="select * from categorie where id=$id";//Requete  preparee
        $sql="Delete  from $this->tableName where id=:x";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute(["x"=>$id]);
        return $stmt->rowCount();
    }

  /*  public function hydrate(array $data){
          
    }*/
}