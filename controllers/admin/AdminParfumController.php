<?php

class AdminParfumController{

    private $adpm;

    public function __construct()
    {
        $this->adpm = new AdminParfumModel();
        $this->adcat = new AdminCategorieModel();
    }

    public function listParfums(){
        AuthController::isLogged();
        if(isset($_POST['soumis']) && !empty($_POST['search'])){
            $search = trim(htmlspecialchars(addslashes($_POST['search'])));
            $parfums = $this->adpm->getParfums($search);
            require_once('./views/admin/parfums/adminParfumsItems.php');
  
        }else{
            $parfums = $this->adpm->getParfums();
            require_once('./views/admin/parfums/adminParfumsItems.php');
        }
        
    }

    public function addParfums(){
        AuthController::isLogged();

        if(isset($_POST['soumis']) && !empty($_POST['marque']) && !empty($_POST['prix'])){
            $marque = trim(htmlentities(addslashes($_POST['marque'])));
            $modele = trim(htmlentities(addslashes($_POST['modele'])));
            $prix = trim(htmlentities(addslashes($_POST['prix'])));
            $quantite = trim(htmlentities(addslashes($_POST['quantite'])));
            $contenance = trim(htmlentities(addslashes($_POST['contenance'])));
            $id_cat = trim(htmlentities(addslashes($_POST['cat'])));
            $description = trim(htmlentities(addslashes($_POST['desc'])));
            $image = $_FILES['image']['name'];

            $newP = new Parfum();
            $newP->setMarque($marque);
            $newP->setModele($modele);
            $newP->setPrix($prix);
            $newP->setQuantite($quantite);
            $newP->setContenance($contenance);
            $newP->getCategorie()->setId_cat($id_cat);
            $newP->setDescription($description);
            $newP->setImage($image);

            $destination = './assets/images/';
            move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);
            $ok = $this->adpm->insertParfum($newP); 
            if($ok){
                header('location:index.php?action=list_p');
            }
        }
       $tabCat = $this->adcat->getCategories();
        require_once('./views/admin/parfums/adminAddP.php');
    }

    public function removeParfums(){
        AuthController::isLogged();
        AuthController::accessUser();
       if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
           $id = $_GET['id'];
           $delP = new Parfum();
           $delP->setId_p($id);
           $nb = $this->adpm->deleteParfum($delP);

           if($nb > 0){
               header('location:index.php?action=list_p');
           }
           
       } 
    }

    public function editParfum(){
        
        AuthController::isLogged();
        if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
            $id = $_GET['id'];
            $editP = new Parfum();
            $editP->setId_p($id);
            $editParfum = $this->adpm->parfumItem($editP);
            
           $tabCat = $this->adcat->getCategories();
           
           if(isset($_POST['soumis']) && !empty($_POST['marque']) && !empty($_POST['prix'])){
               
               $marque = trim(htmlentities(addslashes($_POST['marque'])));
               $modele = trim(htmlentities(addslashes($_POST['modele'])));
               $prix = trim(htmlentities(addslashes($_POST['prix'])));
               $quantite = trim(htmlentities(addslashes($_POST['quantite'])));
               $contenance = trim(htmlentities(addslashes($_POST['contenance'])));
               $id_cat = trim(htmlentities(addslashes($_POST['cat'])));
               $description = trim(htmlentities(addslashes($_POST['desc'])));
               $image = $_FILES['image']['name'];
               
               $editParfum->setMarque($marque);
               $editParfum->setModele($modele);
               $editParfum->setPrix($prix);
               $editParfum->setQuantite($quantite);
               $editParfum->setContenance($contenance);
               $editParfum->getCategorie()->setId_cat($id_cat);
               $editParfum->setDescription($description);
               $editParfum->setImage($image);
               
               $destination = './assets/images/';
               move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);
               $ok = $this->adpm->updateParfum($editParfum); 
                   header('location:index.php?action=list_p');
            }
            require_once('./views/admin/parfums/adminEditP.php');
        }
    }
}