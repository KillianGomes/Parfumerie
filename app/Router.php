<?php

// require_once('./models/Driver.php');
// require_once('./models/Categorie.php');
// require_once('./models/Parfum.php');
// require_once('./models/Grade.php');
// require_once('./models/User.php');
// require_once('./models/admin/AdminCategorieModel.php');
// require_once('./controllers/admin/AdminCategorieController.php');
// require_once('./models/admin/AdminParfumModel.php');
// require_once('./controllers/admin/AdminParfumController.php');
// require_once('./models/admin/AdminUtilisateurModel.php');
// require_once('./controllers/admin/AdminUtilisateurController.php');
// require_once('./models/admin/AdminGradeModel.php');
// require_once('./controllers/public/PublicController.php');
// require_once('./models/public/PublicModel.php');
// require_once('./controllers/admin/AdminGradeController.php');
// require_once('./controllers/admin/AuthController.php');
require_once('./app/autoload.php');
class Router{

    private $ctrca;
    private $ctrp;
    private $ctru;
    private $ctrg;
    private $ctrpb;

    public function __construct()
    {
        $this->ctrca = new AdminCategorieController();
        $this->ctrp = new AdminParfumController();
        $this->ctru = new AdminUtilisateurController();
        $this->ctrg = new AdminGradeController();
        $this->ctrpb = new PublicController();
    }

        public function getPath(){
            try{
                if(isset($_GET['action'])){
                
                    switch($_GET['action']){
                        case 'list_c':
                            $this->ctrca->listCategories();
                            break;
                        case 'delete_c':
                            $this->ctrca->removeCat();
                            break;
                        case 'edit_c':
                            $this->ctrca->editCat();
                            break;
                        case 'add_c':
                            $this->ctrca->addCat();
                            break;
                        case 'list_p':
                            $this->ctrp->listParfums();
                            break;
                        case 'add_p':
                            $this->ctrp->addParfums();
                            break;
                        case 'delete_p':
                            $this->ctrp->removeParfums();
                            break;
                        case 'edit_p':
                            $this->ctrp->editParfum();
                        case 'list_u':
                            $this->ctru->listUsers();
                            break;
                        case 'login':
                            $this->ctru->login();
                            break;
                        case 'logout':
                            AuthController::logout();
                            break;
                        case 'register':
                            $this->ctru->addUser();
                            break;
                        case 'list_g':
                            $this->ctrg ->listGrades();
                            break;   
                        case 'edit_g':
                            $this->ctrg ->editGrade();
                            break;
                        case 'add_g':
                            $this->ctrg ->addGrade();
                            break;
                        case 'delete_g':
                            $this->ctrg->removeGrade();
                            break;
                        case 'checkout' :
                            $this->ctrpb->recap();
                            break;
                        case 'order' :
                            $this->ctrpb ->orderParfum();
                            break;
                        case 'pay': 
                            $this->ctrpb->payment();
                            break;
                        case 'success': 
                            $this->ctrpb->confirmation();
                            break;
                        case 'cancel': 
                            $this->ctrpb->annuler();
                            break;
                        default:
                        throw new Exception('Action non définie');      
                    } 
                }else{
                    $this->ctrpb->getPbParfum();
                }
        } catch (Exception $e){
            $this->page404($e->getMessage());
        }
    
    }

    private function page404($errorMsg){
        require_once('./views/notFound.php');
    }
}