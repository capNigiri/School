<?php
class Prof extends User {
    private array $courses;
    private array $classes;
    
    function getCourses():array {
        return $this->courses;
    }
    function getClasses():array {
        return $this->classes;
    }
    
    function addVoto($db,$matricola,$materia,$voto,$args) {
        $DAO=new ProfDao($db);
        $DAO->addVoto($matricola, $voto, $materia, $args);
        //TODO aggiungere nome docente a tabella
    }
    
    function addPresenza($db,$id,$bool) {
        $DAO = new ProfDao($db);
        $DAO->addPresenza($db,$id, $bool);
    }
    
    function getVotiById($db,$id,$materia) {
       $DAO = new ProfDao($db);
       print_r($DAO->getVotiById($db, $id, $materia));
    }
    
    
    
    function function_name($name,$surname,$id,$role,$email,$password,$courses,$classes) {
        parent::__construct($name,$surname,$id,$role,$email,$password);
        $this->courses=$courses;
        $this->classes=$classes;
    }
    
}

?>