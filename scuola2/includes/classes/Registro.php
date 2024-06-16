<?php

class Registro
{
    private int $matricola;
    private array $voti;
    private array $presenze;

    function construct($matricola, $voti, $presenze)
    {
        $this->matricola = $matricola;
        $this->voti = $voti;
        $this->presenze = $presenze;
    }
}
