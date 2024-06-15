<?php
class Db{
    private $dns ;
    private $username;
    private $psw;

    public function connectDB(){
        $pdo = new PDO($this->dns,$this->username,$this->psw);
        return $pdo;
    }
    
    
    private function getClassByClassId($id_classe) {
        $sql="SELECT nome_classe FROM id_classe_classe WHERE id_classe=:id_classe";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([':id_classe'=>$id_classe]);
        $result = $stmt->fetchColumn();
        return $result;
    }
    
    
    public function getIdMateriaByName($materia):int {
        $sql = "SELECT id_materia FROM materie WHERE materia = :materia ";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([':materia'=>$materia]);
        $result = $stmt->fetchColumn();
        return $result;
    }
    
    public function getMateriaById($id_materia):string{
        $sql = "SELECT materia FROM materie WHERE id_materia = :id_materia ";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([':id_materia'=>$id_materia]);
        $result = $stmt->fetchColumn();
        return $result;
    }
    
    public function getRoleById($id_ruolo):string {
        $sql = "SELECT ruolo FROM ruoli WHERE id_ruolo = :id_ruolo ";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([':id_ruolo'=>$id_ruolo]);
        $result = $stmt->fetchColumn();
        return $result;
    }
    
    //
    public function getClassById($id_utente){
        $sql = "SELECT classe FROM utenti WHERE id_utente = :id_utente";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([':id_utente'=>$id_utente]);
        $result = $stmt->fetchColumn();

        return $this->getClassByClassId($result);
    }

    
    //
    public function getCoursesProf($id_utente) {
        echo $id_utente;
        $result = [];
        $sql = "SELECT id_materia FROM docente_materia WHERE id_utente = :id_utente";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([':id_utente'=>$id_utente]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[]= $this->getMateriaById($row['id_materia']);
        }
        return $result;
    }
    
    public function getClassOfProf($id_utente) {
        $result = [];
        $sql = "SELECT id_classe FROM classi_docente WHERE id_utente = :id_utente";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([':id_utente'=>$id_utente]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[]=$this->getClassByClassId($row['id_classe']);
        }
        return $result;
    }

    
    public function __construct()
    {
        $this->dns = "mysql:host=localhost;dbname=scuola_db";
        $this->username = "root";
        $this->psw = "VVJ.eaLve1n<";
    }
}