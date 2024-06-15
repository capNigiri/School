<?php 
class Voti{
    private string $materia;
    private int $voto;
    private string $data;
    private string $argomenti;
    
    
    public function __construct($materia,$voto,$data,$argomenti) {
        $this->materia=$materia;
        $this->voto=$voto;
        $this->data=$data;
        $this->argomenti=$argomenti;
    }
}


?>