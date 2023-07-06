<?php 
namespace App\Models; 
class ArticleConfectionModel  extends ArticleModel{
    private string $fournisseur;
    
    public function __construct()
    {
        parent::__construct();
        $this->type="ArticleConfection" ;
    }
    /**
     * Get the value of fournisseur
     */ 
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set the value of fournisseur
     *
     * @return  self
     */ 
    public function setFournisseur($fournisseur)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    //findAll   ==> Model  
    //findById  ==> Model
    //remove    ==> Model
    //insert    ==> ArticleModel

   
}