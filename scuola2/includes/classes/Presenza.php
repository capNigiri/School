<?php

class Presenza
{
    private string $data;
    private bool $presenza;

    public function __construct($data, $presenza)
    {
        $this->data = $data;
        $this->presenza = $presenza;
    }
}
