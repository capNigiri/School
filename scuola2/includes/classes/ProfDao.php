<?php 
class ProfDao {
    private $PDO;
 //TODO invece di passare $db dovrei usare $this->PDO
    public function addVoto($db,$matricola,$voto,$materia,$args){

        $materia_id = $db->getIdMateriaByName($materia);
        
        $sql="INSERT INTO registro_voti (id_utente,id_materia,voto,data,argomenti) 
            VALUES (
                :matricola,
                :materia,
                :voto,
                NOW(),
                :argomenti)"
        ;
        
        $stmt=$db->connectDB()->prepare($sql);
        $stmt->execute([
            ':matricola'=>$matricola,
            ':materia'=>$materia_id,
            ':voto'=>$voto,
            ':argomenti'=>$args
        ]);
        
    }
    
    function addPresenza($db,$id,$bool) {
        $sql="INSERT INTO registro_presenze (id_utente,data,presenza)
                VALUES (
                :matricola,
                NOW(),
                :presenza)";
        $stmt=$db->connectDB()->prepare($sql);
        $stmt->execute([
            ':matricola'=>$id,
            ':presenza'=>$bool
        ]);
    }
    
    function getVotiById($db,$id,$materia) {
        $mat=$db->getIdMateriaByName($materia);
        $sql="SELECT voto,data,argomenti FROM registro_voti WHERE id_utente = :id AND id_materia = :materia";
        $stmt=$db->connectDb()->prepare($sql);
        $stmt->execute([
            'id'=>$id,
            'materia'=>$mat
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    }
    function __construct($PDO) {
        $this->PDO=$PDO;
    }
}


?>