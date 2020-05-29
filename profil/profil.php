<!DOCTYPE html>

<html>

<head>
    <title>Ubber Camion - Rapport</title>
    <link rel="icon" href="../img/favicon.ico" />
    <meta charset="UTF-8" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="../css/all.css" rel="stylesheet">
</head>

<body style="color:white"id="body">
<?php 
include '../assets/connexion_bdd.php';
include '../assets/header.php';

if (empty($_SESSION))
    session_start();

if(!isset($_SESSION['locale']))
{
    header('location: ../index.php');
}

?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-3 mr-3 mb-3 mobile-profile2" style="height:300px; background-color:white; text-align:center; color:black; min-width:134px">
                <p class="mt-3 mb-3">Mon profil</p>
            </div>
            <div class="col mobile-profile" style="height:800px; background-color:white; color:black">
                <div style="border-bottom: solid #EEEEEE 3px; border-top: solid #EEEEEE 3px;">
                <p class="mt-3 ml-3" style="font-weight: bold;">Image :</p>
                <div class="mt-2 mb-2">
                    Actuelle : <?php if($_SESSION['locale'][3] == NULL) {echo '<img src="../img/users/default-user.png" width="64px", height="64px"/>';} else {echo '<img src="'.$_SESSION['locale'][3].'" width="64px", height="64px"/>';} ?>
                </div>
                <div class="mb-3"> 
                    <form method="POST" action="upload.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="uploadPic">Changer d'image de profil :</label>
                            <input type="file" class="form-control-file" id="uploadPic" name="uploadPic">
                        </div>
                        <button type="submit" name="submit" style="right:0" class="btn btn-primary mb-2">Confirmer</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

</body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
    <script src="../js/bootstrap.min.js "></script>
</html>