<?php 
class AdminGradeModel extends Driver{

    public function getGrades(){

        $sql = "SELECT * FROM grade";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        
        $tabGrade = [];

        foreach ($rows as $row) {
            $grade = new Grade();
            $grade->setId_g($row->id_g);
            $grade->setNom_g($row->nom_g);
            array_push($tabGrade, $grade);
        }
        return $tabGrade;
    }

    public function deleteGrade($id){
        $sql  = "DELETE FROM grade WHERE id_g = :id";
        $result = $this->getRequest($sql, ['id'=>$id]);
        $nb = $result->rowCount();
        return $nb;
    }

    public function gradeItem($id){

        $sql = "SELECT * FROM grade WHERE id_g = :id";
        $result = $this->getRequest($sql, ['id'=>$id]);
        if($result->rowCount() >0){

            $row = $result->fetch(PDO::FETCH_OBJ);

            $grade = new Grade();
            $grade->setId_g($row->id_g);
            $grade->setNom_g($row->nom_g);

            return $grade;
        } 

    }

    public function updateGrade(Grade $grade){
        $sql = "UPDATE grade 
                SET nom_g = :nom
                WHERE id_g = :id";
        $result = $this->getRequest($sql,['nom'=>$grade->getNom_g(),'id'=>$grade->getId_g()]);

        if($result->rowCount() > 0){
            $nb = $result->rowCount();
            return $nb;
        }
    }

    public function insertGrade(Grade $grade){

        $sql = "INSERT INTO grade(nom_g)
                VALUES(:nom)";
        $result = $this->getRequest($sql, array('nom'=>$grade->getNom_g()));

        return $result;
    }
}
