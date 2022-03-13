<?php


class AdminUtilisateurController{

    private $adUser;
    private $adG;

    public function __construct()
    {
        $this->adUser = new AdminUtilisateurModel();
        $this->adG = new AdminGradeModel();
    }

    public function listUsers(){
        AuthController::isLogged();
        if(isset($_GET['id']) && isset($_GET['statut']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $statut = $_GET['statut'];
            $user = new User();
            if($statut==1){
                $statut = 0;
            }else{
                $statut = 1;
            }
            $user->setId_u($id);
            $user->setStatut($statut);

            $this->adUser->updateStatut($user);
        }
        $allUsers = $this->adUser->getUsers();
        require_once('./views/admin/utilisateurs/adminUsersItems.php');

    }

    public function login(){

        if(isset($_POST['soumis'])){
            if(strlen($_POST['pass']) >= 4 && !empty($_POST['loginEmail'])){
                $loginEmail = trim(htmlentities(addslashes($_POST['loginEmail'])));
                $pass = md5(trim(htmlentities(addslashes($_POST['pass']))));
                $data_u = $this->adUser->signIn($loginEmail,  $pass);
               if(!empty($data_u)){
                    if($data_u->statut > 0){
                        session_start();
                        $_SESSION['Auth'] =  $data_u;
                        header('location:index.php?action=list_p');
                    }else{
                        $error = "Votre compte a été supprimé";
                    }
                }else{
                    $error = "Votre login/email ou/et mot de passe ne correspondent pas";
                }
            }else{
                $error = "Entrée les données valides";
            }
        }
        
        require_once('./views/admin/utilisateurs/login.php');
    }

    public function addUser(){
        AuthController::isLogged();

        if(isset($_POST['soumis']) && !empty($_POST['nom']) && !empty($_POST['prenom'])){
            $nom = trim(htmlentities(addslashes($_POST['nom'])));
            $prenom = trim(htmlentities(addslashes($_POST['prenom'])));
            $login = trim(htmlentities(addslashes($_POST['login'])));
            $pass = md5(htmlentities(addslashes($_POST['pass'])));
            $email = trim(htmlentities(addslashes($_POST['email'])));
            $id_g = trim(htmlentities(addslashes($_POST['grade'])));
            

            $newU = new User();
            $newU->setNom_u($nom);
            $newU->setPrenom_u($prenom);
            $newU->setLogin($login);
            $newU->setPass($pass);
            $newU->setEmail($email);
            $newU->getGrade()->setId_g($id_g);
            $newU->setStatut(1);

            $ok = $this->adUser->register($newU); 
            if($ok){
                header('location:index.php?action=list_u');
            }
        }
        $allGrades = $this->adG->getGrades();
        require_once('./views/admin/utilisateurs/register.php');
    }
   
}