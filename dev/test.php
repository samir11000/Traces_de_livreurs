<?php

include '../assets/connexion_bdd.php';
include '../assets/querrySimplifier.php';

$sql = new querrySimplifier($connec);


$token = bin2hex(random_bytes(64));

echo $token;
echo '<br/>';
echo strlen($token);

$sql->preparedStatement("UPDATE utilisateur SET auth_token=null WHERE login_utilisateur='kiki'",array());