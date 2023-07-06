<?php 
namespace App\Models; 
class ArticleVenteModel extends ArticleModel{
    private string $dateProduction;

    
    public function __construct()
    {
        parent::__construct();
        $this->type="ArticleVente" ;
    }

    /**
     * Get the value of dateProduction
     */ 
    public function getDateProduction()
    {
        return dateToFr($this->dateProduction)  ;
    }

    /**
     * Set the value of dateProduction
     *
     * @return  self
     */ 
    public function setDateProduction($dateProduction)
    {
        $this->dateProduction = $dateProduction;

        return $this;
    }

   
}