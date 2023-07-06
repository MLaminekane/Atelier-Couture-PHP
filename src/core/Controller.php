<?php
namespace App\Core; 
use Nette\Utils\Paginator;
class Controller{
    protected string  $layout="base";
    protected Paginator $paginator;
    protected int  $currentPage=1;
    protected int  $nbrePerPage=5;
    protected string $path;
    public function __construct()
    {
          Session::startSession();
          $this->paginator = new Paginator;
          $this->paginator->setItemsPerPage($this->nbrePerPage);
          $this->path=explode("?",$_SERVER['REQUEST_URI'])[0];
    }

    public function render($view, array $data=[]){
        $data['paginator']= $this->paginator;
        $data['path']= $this->path;
        extract($data);
        ob_start();
        require_once "./../views/".$view;
       $contentForView=ob_get_clean();
       require_once "./../views/".$this->layout.".layout.html.php"; 
    }
    public function redirect(string $path){
        header("location:".BASE_URL."$path");//GET
        exit;
    }

    /**
     * Get the value of nbrePerPage
     */ 
    public function getNbrePerPage()
    {
        return $this->nbrePerPage;
    }

    /**
     * Set the value of nbrePerPage
     *
     * @return  self
     */ 
    public function setNbrePerPage($nbrePerPage)
    {
        $this->nbrePerPage = $nbrePerPage;

        return $this;
    }
}