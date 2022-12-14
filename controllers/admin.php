<?php
namespace controllers;
class admin implements base
{
    private $model;
    private $NavModel;
    use \controllers\utils;
    public function __construct()
    {
        $_SESSION['links']=$this->GetLinks();
        $this->model=New \models\admin();
        $this->NavModel=New \models\nav_links();
        if(isset($_GET['target'])){
            $target=$_GET['target'];
            $this->$target(); 
        }else{
            $this->index();
        }
    }
    public function index()
    {
        $template='views/page/dashboard.phtml';
        include_once 'views/main.phtml';
    }
    public function store()
    {
        
    }
    public function destroy()
    {
        
    }
    public function update()
    {
        
    }
}