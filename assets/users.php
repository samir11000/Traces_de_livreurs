<?php

class registerUser
{
    private $elements;
    private $errors = array();
    private $userParams = array();


    function __construct($elem)
    {
        $this->elements = $elem;
        $this->userParams["username"] = trim($this->elements["username"] ?? null);
        $this->userParams["login"] = trim($this->elements["login"] ?? null);
        $this->userParams["password"] = trim($this->elements["pass"] ?? null);
        $this->userParams["confirm_password"] = trim($this->elements["pass2"] ?? null);
        $this->userParams["firstname"] = trim($this->elements["firstname"] ?? null);
        $this->userParams["lastname"] = trim($this->elements["lastname"] ?? null);
        $this->userParams["email"] = trim($this->elements["email"] ?? null);
        $this->userParams["confirm_email"] = trim($this->elements["email2"] ?? null);
        unset($this->elements);
    }

    function getParam($key)
    {
        try
        {
            return $this->userParams[$key];
        } 
        catch (Exception $e)
        {
            echo 'Une erreur c\' est produite :', $e->getMessage(), "\n";
        }
    }

    function setParam($key, $param)
    {
        return $this->userParams[$key];
    }

    function addError($err)
    {
        return array_push($this->errors, $err);
    }

    function getError()
    {
        return $this->errors;
    }

}