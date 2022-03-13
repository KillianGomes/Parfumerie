<?php

class PublicModel extends Driver{

    public function findParfByCat(Parfum $parf){

        $sql = "SELECT * FROM parfum p
        INNER JOIN categorie c
        ON p.id_cat_categorie = c.id_cat
         WHERE p.id_cat_categorie=:id";
        $result = $this->getRequest($sql, ["id"=>$parf->getCategorie()->getId_cat()]);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $parfs = [];
        foreach($rows as $row){

            $newParf = new Parfum();

            $newParf->setId_p($row->id_p);
            $newParf->setMarque($row->marque);
            $newParf->setModele($row->modele);
            $newParf->setPrix($row->prix);
            $newParf->setContenance($row->contenance);
            $newParf->setQuantite($row->quantite);
            $newParf->setImage($row->image);
            $newParf->setDescription($row->description);
            $newParf->getCategorie()->setId_cat($row->id_cat);
            $newParf->getCategorie()->setNom_cat($row->nom_cat);

            array_push($parfs, $newParf);

        }
        return $parfs;
    }

    public function updateStock(Parfum $p){
        $sql = "UPDATE parfum SET quantite = :quantite WHERE id_p = :id";
        $result = $this->getRequest($sql, ['quantite'=>$p->getQuantite(), 'id'=>$p->getId_p()]);
        return $result->rowCount();
    }
}