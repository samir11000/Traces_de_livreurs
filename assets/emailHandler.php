<?php

class emailHandler
{
    private $mail_address;

    function welcomeMail($email)
    {
        $this->mail_address = $email;
        $subject = "Bienvenue sur Uber Camion !";
        $message = "Bienvenue sur le site de livraison Uber Camion !";
        $headers = array(
            'From' => 'noreply@ubercamion.com',
            'X-Mailer' => 'PHP/' . phpversion()
        );

        mail($this->mail_address, $subject, $message, $headers);

    }
}