<?php

class AdminUtilisateurModel extends Driver{

    public function getUsers(){
        $sql = "SELECT * 
        FROM user u
        INNER JOIN grade g
        ON u.id_g_grade = g.id_g
        ORDER BY u.id_g_grade DESC";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabUser = [];

        foreach($rows as $row){
            $user = new User();
            $user->setId_u($row->id_u);
            $user->setNom_u($row->nom_u);
            $user->setPrenom_u($row->prenom_u);
            $user->setLogin($row->login);
            $user->setPass($row->pass);
            $user->getGrade()->setId_g($row->id_g);
            $user->getGrade()->setNom_g($row->nom_g);
            $user->setEmail($row->email);
            $user->setStatut($row->statut);
            array_push($tabUser,$user);
        }
            return $tabUser;
    }

    public function updateStatut(User $user){

        $sql = "UPDATE user SET statut=:statut WHERE id_u=:id";
        $result = $this->getRequest($sql, ['statut'=>$user->getStatut(), 'id'=>$user->getId_u()]);

        return $result->rowCount();
        
    }

    public function signIn($loginEmail, $pass){

        $sql = "SELECT * FROM user 
                WHERE (login = :logEmail OR email =:logEmail ) AND pass = :pass";
        $result = $this->getRequest($sql, ['logEmail'=>$loginEmail, 'pass'=>$pass]);

        $row = $result->fetch(PDO::FETCH_OBJ);

        return $row;
    }

    public function register(User $user){

        $sql = "INSERT INTO user(nom_u, prenom_u, login, pass, email, statut, id_g_grade)
        VALUES(:nom, :prenom, :login, :pass, :email, :statut, :id_g)";

        $tabParams = ["nom"=>$user->getNom_u(),"prenom"=>$user->getPrenom_u(), "login"=>$user->getLogin(), "pass"=>$user->getPass(), "email"=>$user->getEmail(), "statut"=>$user->getStatut(), "id_g"=>$user->getGrade()->getId_g()]; 

        $result= $this->getRequest($sql, $tabParams);

        return $result;
    }
}