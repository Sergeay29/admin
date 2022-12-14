<?php
namespace controllers;


class users implements base
{
    private $model;
    use \controllers\utils;
    function __construct()
    {
        $this->model=new \models\users();

        if(isset($_GET['target'])){
            $target=$_GET['target'];
            $this->$target(); 
        }else{
            $this->index();
        }
    }
    public function index(){
        $this->Conect_verif();
        $users = $this->model->GetAll();
        $num = 1;
        $template='views/page/liste.phtml';
        include_once 'views/main.phtml';
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["id_user"]) && isset($_POST["pwd"]) && isset($_POST["cpwd"])) {
                if (stripslashes(trim($_POST["pwd"])) == stripslashes(trim($_POST["cpwd"]))) {
                    $password = password_hash(stripslashes(trim($_POST["pwd"])), PASSWORD_DEFAULT);
                    // J'appelle la fonction InsertUser() depuis le model afin d'ajouter les données en base
                    $this->model->Insert([stripslashes(trim($_POST["fname"])), stripslashes(trim($_POST["lname"])), stripslashes(trim($_POST["id_user"])), $password]); 
                     header("location:index.php");

                     exit();
                }
            }
        }
        // J'appelle la fonction GetAll() depuis le model qui me permet de recuperer tous les utilisateurs en base
       
        // Chargement du formulaire
        $template ='views/page/formulaire.phtml';
        include_once 'views/main.phtml';
    }
    public function destroy()
    {
        if (isset($_GET['id'])) {
            // J'appelle DeleteUser() depuis le model, qui me permet de supprimer un utilisateur en fonction de son id 
            $this->model->Delete(intval($_GET['id']));
            header("location: index.php");
            exit();
        } else {
            header("location: index.php");
            exit();
        }
    }

   public function update()
    {
        $this->model->GetById(intval($_GET['id']));
    }

     public function recherche()
    {
        $users = $this->model->Recherches([$_POST['motcle']]);
        $num = 1;
        include_once 'views/formulaire.phtml';
    }

    
}
