<?php

class AdminGradeController{

    private $adG;
    
    public function __construct()
    {
        $this->adG = new AdminGradeModel();
    }

    public function listGrades(){
        AuthController::isLogged();
         $allGrades = $this->adG->getGrades();
         require_once('./views/admin/grades/adminGradeItems.php');
    }

    public function removeGrade(){
        AuthController::isLogged();
        AuthController::accessUser();
        if(isset($_GET['id'])  && filter_var($_GET['id'],FILTER_VALIDATE_INT)){

            $id = trim($_GET['id']);

            $nbLine = $this->adG->deleteGrade($id);

            if($nbLine > 0){
                header('location: index.php?action=list_g');
            }
        }
    }

    public function editGrade(){
        AuthController::isLogged();
        if(isset($_GET['id']) && $_GET['id'] < 1000 && filter_var($_GET['id'],FILTER_VALIDATE_INT)){
           
            $id = trim($_GET['id']);
            $grade = $this->adG->gradeItem($id);

            if(isset($_POST['soumis']) && !empty($_POST['grade'])){

                $grades = trim(addslashes(htmlentities($_POST['grade'])));
                $grade->setNom_g($grades);
                $nb = $this->adG->updateGrade($grade);
                
                if($nb > 0){
                    header('location:index.php?action=list_g');
                }
            }

            require_once('./views/admin/grades/adminEditG.php');

        }
    }

    public function addGrade(){
        AuthController::isLogged();
        if(isset($_POST['soumis']) && !empty($_POST['grade'])){
            $nom_g = trim(htmlentities(addslashes($_POST['grade'])));
            $newGrade = new Grade();
            $newGrade->setNom_g($nom_g);

            $ok = $this->adG->insertGrade($newGrade);
            if($ok){
                header('location:index.php?action=list_g');
            }
        }
        require_once('./views/admin/grades/adminAddG.php');
    }
}
