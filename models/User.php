<?php

class User{

    private $id_u;
    private $nom_u;
    private $prenom_u;
    private $login;
    private $pass;
    private $email;
    private $statut;
    private $grade;

    public function __construct()
    {
        $this->grade = new Grade();
    }
    

    /**
     * Get the value of nom_u
     */ 
    public function getNom_u()
    {
        return $this->nom_u;
    }

    /**
     * Set the value of nom_u
     *
     * @return  self
     */ 
    public function setNom_u($nom_u)
    {
        $this->nom_u = $nom_u;

        return $this;
    }

    /**
     * Get the value of id_u
     */ 
    public function getId_u()
    {
        return $this->id_u;
    }

    /**
     * Set the value of id_u
     *
     * @return  self
     */ 
    public function setId_u($id_u)
    {
        $this->id_u = $id_u;

        return $this;
    }

    /**
     * Get the value of prenom_u
     */ 
    public function getPrenom_u()
    {
        return $this->prenom_u;
    }

    /**
     * Set the value of prenom_u
     *
     * @return  self
     */ 
    public function setPrenom_u($prenom_u)
    {
        $this->prenom_u = $prenom_u;

        return $this;
    }

    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of pass
     */ 
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */ 
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of grade
     */ 
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set the value of grade
     *
     * @return  self
     */ 
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }
}