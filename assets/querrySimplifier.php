<?php

class querrySimplifier
{
    public $connection,$result,$stmt,$i;

    function __construct($connec)
    {
        $this->connection = $connec;
    }

    function preparedStatement($stmt,$val)
    {
        if($this->stmt = pg_prepare($this->connection, "my_querry".$this->i,$stmt))
            $this->result = pg_execute($this->connection, "my_querry".$this->i, $val);
        else
            echo 'une Erreur c\'est produite';
        $this->i++;
    }

    function getValue()
    {
        return $this->result;
    }
}