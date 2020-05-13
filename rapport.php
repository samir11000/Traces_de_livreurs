<!DOCTYPE html>

<html>

<head>
    <title>Ubber Camion - Rapport</title>
    <link rel="icon" href="img/favicon.ico" />
    <meta charset="UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="css/all.css" rel="stylesheet">
</head>

<body id="body">
<?php include 'assets/header.php';
if(!isset($_SESSION['locale']))
{
    header('location: ../index.php');
}?>
<div style="background-color" class="container-fluid">
    <button class="openbtn" id="open" onclick="openNav()"><i style="font-size:25px" class="fas fa-angle-right"></i></button>
    <div class="sidepanel">
        <div id="mySidepanel" class="sidepanel">
            <a href="#">Jour</a>
            <a href="#">Mois</a>
            <a href="#">Année</a>
        </div>
    </div>
</div>

</body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
    <script src="js/bootstrap.min.js "></script>
    <script>
        /* Set the width of the sidebar to 250px (show it) */
        function openNav() {
        document.getElementById("mySidepanel").style.width = "250px";
        document.getElementById("open").style.position="absolute";
        document.getElementById("open").style.left="250px";
        document.getElementById("open").style.bottom="0px";
        document.getElementById("open").onclick = closeNav;
        document.getElementById("open").innerHTML = '<i style="font-size:25px" class="fas fa-angle-left"></i>';
        }

        /* Set the width of the sidebar to 0 (hide it) */
        function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
        document.getElementById("open").style.position="absolute";
        document.getElementById("open").style.bottom="20px";
        document.getElementById("open").style.left="20px";
        document.getElementById("open").onclick = openNav;
        document.getElementById("open").innerHTML = '<i style="font-size:25px" class="fas fa-angle-right"></i>';
        }
    </script>
</html>