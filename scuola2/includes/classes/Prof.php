<?php
class Prof extends User {
    private array $courses;
    private array $classes;
    
    public function getCourses():array {
        return $this->courses;
    }
    public function getClasses():array {
        return $this->classes;
    }
    
    public function addVoto($db,$matricola,$materia,$voto,$args) {
        $DAO=new ProfDao($db);
        $DAO->addVoto($matricola, $voto, $materia, $args);
        //TODO aggiungere nome docente a tabella
    }
    
    public function addPresenza($db,$id,$bool) {
        $DAO = new ProfDao($db);
        $DAO->addPresenza($db,$id, $bool);
    }
    
    public function getVotiById($db,$id,$materia) {
       $DAO = new ProfDao($db);
       print_r($DAO->getVotiById($db, $id, $materia));
    }
    
    
    
    public function function_name($name,$surname,$id,$role,$email,$password,$courses,$classes) {
        parent::__construct($name,$surname,$id,$role,$email,$password);
        $this->courses=$courses;
        $this->classes=$classes;
    }
    
}

?>
