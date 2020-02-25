<?php

class registerUser
{
    private $elements;
    private $username ,$password,$confirm_password,$lastname,$firstname,$email,$confirm_email;
    private $username_err,$password_err,$confirm_password_err,$lastname_err,$firstname_err,$email_err,$confirm_email_err;

    function __construct($elem)
    {
        $this->elements = $elem;
        $this->username = $this->elements["username"];
        $this->password = $this->elements["password"];
        $this->confirm_password = $this->elements["confirm_password"];
        $this->firstname = $this->elements["firstname"];
        $this->lastname = $this->elements["lastname"];
        $this->email = $this->elements["email"];
        $this->confirm_email = $this->elements["confirm_email"];
        unset($this->elements);
    }

    function getUsername()
    {
        return $this->username;
    }

}

$test = new registerUser(array("id"=>"1","username"=>"test","password"=>"1234","confirm_password"=>"1234","firstname"=>"test","lastname"=>"test","email"=>"test@test.fr","confirm_email"=>"test@test.fr"));

var_dump($test);

echo $test->getUsername();