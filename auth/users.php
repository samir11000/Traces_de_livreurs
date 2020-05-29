<?php

class registerUser
{
    private $elements;
    private $username,$login,$password,$confirm_password,$lastname,$firstname,$email,$confirm_email;
    public $errors = array();

    function __construct($elem)
    {
        $this->elements = $elem;
        $this->username = trim($this->elements["username"]);
        $this->login = trim($this->elements["login"]);
        $this->password = trim($this->elements["pass"]);
        $this->confirm_password = trim($this->elements["pass2"]);
        $this->firstname = trim($this->elements["firstname"]);
        $this->lastname = trim($this->elements["lastname"]);
        //$this->email = $this->elements["email"];
        //$this->confirm_email = $this->elements["confirm_email"];
        unset($this->elements);
    }

    function getUsername()
    {
        return $this->username;
    }

    function setUsername($val)
    {
        $this->username = $val;
    }

    function getLogin()
    {
        return $this->login;
    }

    function setLogin($val)
    {
        $this->login = $val;
    }

    function getPass()
    {
        return $this->password;
    }

    function setPass($val)
    {
        $this->password = $val;
    }

    function getConfirmedPass()
    {
        return $this->confirm_password;
    }

    function setConfirmedPass($val)
    {
        $this->confirm_password = $val;
    }

    function getFirstname()
    {
        return $this->firstname;
    }

    function setFirstname($val)
    {
        $this->firstname = $val;
    }

    function getLastname()
    {
        return $this->lastname;
    }

    function setLastname($val)
    {
        $this->lastname = $val;
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