<?php
class Studente extends User {
    private string $classe;
    
    public function getClass():string {
        return $this->classe;
    }
    public function getVotiById($db,$id,$materia){
        $id = $this->getId();
        $DAO = new ProfDao($db);
        print_r($DAO->getVotiById($db, $id, $materia));
    }
    
    
    public function __construct($name,$surname,$id,$role,$email,$psw,$classe) {
        parent::__construct($name, $surname, $id, $role, $email, $psw);
        $this->classe = $classe;
    }
}
