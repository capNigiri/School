<?php

class Preside extends User
{
    function __construct($name, $surname, $id, $role, $email, $psw)
    {
        parent::__construct($name, $surname, $id, $role, $email, $psw);
    }
}
