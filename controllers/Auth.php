<?php
namespace controllers;
class auth
{
    private $UserModel;
    private $AdminsModel;
    function __construct()
    {
        $this->UserModel=new \models\users();
        $this->AdminsModel=new \models\admin();

        if(isset($_GET['target'])){
            $target=$_GET['target'];
            $this->$target(); 
        }else{
            $this->login();
        }
    }
    
    public function login()
    {
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST["id_user"]) && isset($_POST["pwd"])) {
                $user = $this->UserModel->GetUserByLogin($_POST["id_user"]);
                $admin=$this->AdminsModel->GetByAdLogin($_POST["id_user"]);
                if ($user) {
                    if (password_verify($_POST["pwd"], $user['Mdp'])){
                        $_SESSION['auth']=json_encode(['user'=>$user['Identifiant'],'id'=>$user['Id']]);
                        header("location: index.php?goto=reservation");
                        exit();
                    }
                }elseif($admin){
                    if($admin['Passwd']!=NULL){
                        if (password_verify($_POST["pwd"], $admin['Passwd'])){
                            $_SESSION['auth']=json_encode(['user'=>$admin['AdLogin'],'id'=>$admin['Id'],'role'=>$admin['AdRole']]);
                            header("location: index.php?goto=admin");
                            exit();
                        }
                    }else{
                        header("location: index.php?goto=auth&target=UpdatePassword&id=".$admin['Id']);
                        exit();
                    }
                }
            }
        }
        $template ='views/page/connexion.phtml';
        include_once 'views/main.phtml';
    }
    public function UpdatePassword()
    {
        if(isset($_GET['id'])){

            $admin=$this->AdminsModel->GetById($_GET['id']); 
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (stripslashes(trim($_POST["pwd"])) == stripslashes(trim($_POST["cpwd"]))) {
                $password = password_hash(stripslashes(trim($_POST["pwd"])), PASSWORD_DEFAULT);
                $this->AdminsModel->UpdateAdPasswd([$password,$_POST["user"]]);
                $this->login();
                exit();
            }
        }
        $template ='views/page/PasswordForm.phtml';
        include_once 'views/main.phtml';
    }
}