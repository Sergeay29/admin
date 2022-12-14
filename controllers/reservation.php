<?php
namespace controllers;
class reservation 
{
    use \controllers\utils;
    public function __construct()
    {
        $_SESSION['links']=$this->GetLinks();
        
        if(isset($_GET['target'])){
            $target=$_GET['target'];
            $this->$target(); 
        }else{
            $this->index();
        }
    }
    public function index()
    {
        $template='views/page/reservation.phtml';
        include_once 'views/main.phtml';
    }
}