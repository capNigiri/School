<?php
class StudenteDAO {
    private $PDO;
//TODO usare$this->PDO invece di $db
    public function getVotiById($db,$id,$materia) {
        $mat=$db->getIdMateriaByName($materia);
        $sql="SELECT voto,data,argomenti FROM registro_voti WHERE id_utente = :id AND id_materia = :materia";
        $stmt=$db->connectDb()->prepare($sql);
        $stmt->execute([
            'id'=>$id,
            'materia'=>$mat
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function __construct($PDO){
        $this->PDO=$PDO;
    }
}
