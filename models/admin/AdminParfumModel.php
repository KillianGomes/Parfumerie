<?php

class AdminParfumModel extends Driver{

    public function getParfums($search = null){

        if(!empty($search)){
            $sql = "SELECT * 
                    FROM parfum p
                    INNER JOIN categorie c
                    ON p.id_cat_categorie = c.id_cat
                    WHERE marque LIKE :marque OR modele LIKE :modele OR nom_cat LIKE :nom_cat
                    ORDER BY id_p DESC";
            $searchParams = ["marque"=>"$search%", "modele"=>"$search%", "nom_cat"=>"$search%"];
            $result = $this->getRequest($sql, $searchParams);

        }else{
            $sql = "SELECT * 
                    FROM parfum p
                    INNER JOIN categorie c
                    ON p.id_cat_categorie = c.id_cat
                    ORDER BY id_p DESC";
            $result = $this->getRequest($sql);
        }
       
        $parfums = $result->fetchAll(PDO::FETCH_OBJ);

        $datas = [];
    

        foreach ($parfums as $parfum) {

            $p = new Parfum();
            $p->setId_p($parfum->id_p);
            $p->setMarque($parfum->marque);
            $p->setModele($parfum->modele);
            $p->setPrix($parfum->prix);
            $p->setImage($parfum->image);
            $p->setQuantite($parfum->quantite);
            $p->setContenance($parfum->contenance);
            $p->setDescription($parfum->description);
            $p->getCategorie()->setId_cat($parfum->id_cat);
            $p->getCategorie()->setNom_cat($parfum->nom_cat);
            array_push($datas, $p);

        }
        if($result->rowCount() > 0){
            return $datas;
        }else{
            return "No record ...";
        }
    }

    public function insertParfum(Parfum $parfum){

        $sql = "INSERT INTO parfum(marque, modele, prix, contenance, quantite, image, description, id_cat_categorie)
                VALUES(:marque, :modele, :prix, :contenance, :quantite, :image, :descr, :id_cat)";
        
        $tabParams = ["marque"=>$parfum->getMarque(),"modele"=>$parfum->getModele(), "prix"=>$parfum->getPrix(), "contenance"=>$parfum->getContenance(), "quantite"=>$parfum->getQuantite(), "image"=>$parfum->getImage(), "descr"=>$parfum->getDescription(), "id_cat"=>$parfum->getCategorie()->getId_cat()]; 

        $result= $this->getRequest($sql, $tabParams);
        
        return $result;
    }

    public function deleteParfum(Parfum $parfum){

        $sql = "DELETE FROM parfum WHERE id_p = :id";
        $result = $this->getRequest($sql, ['id'=>$parfum->getId_p()]);

        return $result->rowCount();
    }

    public function parfumItem(Parfum $pParam){

        $sql = "SELECT * FROM parfum WHERE id_p = :id";
        $result = $this->getRequest($sql, ['id'=>$pParam->getId_p()]);
        
        if($result->rowCount() > 0){

            $parfumRow = $result->fetch(PDO::FETCH_OBJ);
            $editParfum = new Parfum();
            $editParfum->setId_p($parfumRow->id_p);
            $editParfum->setMarque($parfumRow->marque);
            $editParfum->setModele($parfumRow->modele);
            $editParfum->setPrix($parfumRow->prix);
            $editParfum->setQuantite($parfumRow->quantite);
            $editParfum->setContenance($parfumRow->contenance);
            $editParfum->setImage($parfumRow->image);
            $editParfum->setDescription($parfumRow->description);
            $editParfum->getCategorie()->setId_cat($parfumRow->id_cat_categorie);

            return $editParfum;
        }

    }

    public function updateParfum(Parfum $updateP){
        if($updateP->getImage() === ""){
            $sql = "UPDATE parfum
                SET marque = :marque, modele = :modele, prix = :prix, contenance = :contenance, quantite = :quantite, description = :description, id_cat_categorie = :id_cat
                WHERE id_p = :id_p";
                
          $tabParams = ["marque"=>$updateP->getMarque(),"modele"=>$updateP->getModele(), "prix"=>$updateP->getPrix(), "contenance"=>$updateP->getContenance(), "quantite"=>$updateP->getQuantite(), "description"=>$updateP->getDescription(), "id_cat"=>$updateP->getCategorie()->getId_cat(), "id_p"=>$updateP->getId_p()];

        }else{

            $sql = "UPDATE parfum
                    SET marque = :marque, modele = :modele, prix = :prix, contenance = :contenance, quantite = :quantite, image = :image, description = :description, id_cat_categorie = :id_cat
                    WHERE id_p = :id_p";
                    
              $tabParams = ["marque"=>$updateP->getMarque(),"modele"=>$updateP->getModele(), "prix"=>$updateP->getPrix(), "contenance"=>$updateP->getContenance(), "quantite"=>$updateP->getQuantite(), "image"=>$updateP->getImage(), "description"=>$updateP->getDescription(), "id_cat"=>$updateP->getCategorie()->getId_cat(), "id_p"=>$updateP->getId_p()];
        }

          $result = $this->getRequest($sql, $tabParams);

         return $result->rowCount();
    }
}