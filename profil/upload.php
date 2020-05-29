<?php

include '../assets/connexion_bdd.php';
include '../assets/querrySimplifier.php';

$sql = new querrySimplifier($connec);

if (empty($_SESSION))
    session_start();

if (isset($_FILES['uploadPic']) && $_FILES['uploadPic'] != NULL)
{
    $target_dir = "../img/users/";
    $target_file = $target_dir . basename($_FILES["uploadPic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["uploadPic"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
  
    // Check file size
    if ($_FILES["uploadPic"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["uploadPic"]["tmp_name"], $target_file)) {
        echo "The file ". basename($_FILES["uploadPic"]["name"]). " has been uploaded.";
        $sql->preparedStatement("UPDATE utilisateur SET profile_pic = $1 WHERE id_utilisateur = $2;",array('/img/users/'. basename($_FILES["uploadPic"]["name"]),$_SESSION['locale'][2]));
        $_SESSION['locale'][3] = $target_file;
        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }
}