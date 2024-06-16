<?php 
class User {
    private string $name;
    private string $surname;
    private int $id;
    private ?int $role;
    private string $email;
    private string $psw;
    
    public function getName(){
        return $this->name;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function __construct($name,$surname,$id,$role,$email,$psw) {
        $this->name=$name;
        $this->surname=$surname;
        $this->id=$id;
        $this->role=$role;
        $this->email=$email;
        $this->psw=$psw;
    }
}

?>
