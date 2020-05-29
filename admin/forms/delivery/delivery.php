<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="../../../img/favicon.ico" />
        <title>Tableau de bord - Gestion des livreurs</title>
        <link href="/admin/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php session_start();
        include '../../../assets/connexion_bdd.php';
        include '../../../assets/querrySimplifier.php';
        include '../../../assets/config.php';

        $req = new querrySimplifier($connec);

        if(!isset($_SESSION['locale']))
        {
            header('location: ../../../index.php');
        }

        include('../../assets/header.php');
        
        ?>

        <div id="layoutSidenav_content">
            <main>
            <?php
                if(isset($_SESSION["register_errors"]))
                {
                    echo "<div class=\"alert alert-danger mt-2 mr-3 ml-3\">";
                    foreach($_SESSION["register_errors"] as $value){
                        echo nl2br($value."\n");
                    }
                    echo "</div>";
                    unset($_SESSION["register_errors"]);
                }
                
                if(isset($_SESSION["successful"]))
                {
                    echo "<div class=\"alert alert-success mt-2 mr-3 ml-3\">";
                    foreach($_SESSION["successful"] as $value){
                        echo nl2br($value."\n");
                    }
                    echo "</div>";
                    unset($_SESSION["successful"]);
                }
            ?>
                <div class="container-fluid mt-2">
                    <h3>Formulaire de gestion des livreurs</h3>
                    <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../main.php">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Formulaire de gestion des livreurs</li>
                    </ol>
                    <div class="container">
                        <div class="form-group">
                            <label for="addOrDelete">Ajouter ou supprimer un livreurs :</label>
                            <select class="form-control" id="addOrDelete">
                                <option>Ajouter</option>
                                <option>Supprimer</option>
                            </select>
                            <div id="changeableForm">
                                <h3 class="mt-3">Formulaire d'ajout de livreur : </h3>
                                <form action="add_delivery.php" method="POST">
                                    <div class="form-group">
                                        <label for="deliverySurname">Nom du Livreur : </label>
                                        <input type="text" class="form-control" id="deliverySurname" name="deliverySurname" placeholder="(Ex : Ménard)">
                                    </div>
                                    <div class="form-group">
                                        <label for="deliveryName">Prénom du Livreur : </label>
                                        <input type="text" class="form-control" id="deliveryName" name="deliveryName" placeholder="(Ex : Robert)">
                                    </div>
                                    <div class="form-group">
                                        <label for="deliveryAdress">Adresse du livreur : </label>
                                        <input type="text" class="form-control" id="deliveryAddress" name="deliveryAddress" placeholder="(Ex : 2 avenue de la république)">
                                    </div>
                                    <div class="form-group">
                                        <label for="deliveryCity">Ville du livreur : </label>
                                        <input type="text" class="form-control" id="deliveryCity" name="deliveryCity" placeholder="(Ex : Carcassonne)">
                                    </div>
                                    <div class="form-group">
                                        <label for="deliveryBirthdate">Date de naissance du livreur : </label>
                                        <input type="date" class="form-control" id="deliveryBirthdate" name="deliveryBirthdate" placeholder="(Ex : 12/01/2001)">
                                    </div>
                                    <div class="form-group">
                                        <label for="DeliveryLicenceDate">Date d'obtention du permis du livreur : </label>
                                        <input type="date" class="form-control" id="DeliveryLicenceDate" name="DeliveryLicenceDate" placeholder="(Ex : 12/01/2005)">
                                    </div>
                                    <div class="form-group">
                                        <label for="DeliveryLicenceExpirationDate">Date d'expiration du permis du livreur : </label>
                                        <input type="date" class="form-control" id="DeliveryLicenceExpirationDate" name="DeliveryLicenceExpirationDate" placeholder="(Ex : 12/01/2020)">
                                    </div>
                                    <div class="form-group">
                                        <label for="deliveryLicenceNb">Numéro du permis (N°NEPH) : </label>
                                        <input type="text" class="form-control" id="deliveryLicenceNb" name="deliveryLicenceNb" placeholder="(Ex : 123456789)">
                                    </div>
                                    <div class="form-group">
                                        <label for="deliveryPhoneNb">Téléphone du livreur : </label>
                                        <input type="text" class="form-control" id="deliveryPhoneNb" name="deliveryPhoneNb" placeholder="(Ex : 0600000000)">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
        <script src="ajax/ajax.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/demo/chart-area-demo.js"></script>
        <script src="../../assets/demo/chart-bar-demo.js"></script>
        <script src="../../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="../../js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/demo/datatables-demo.js"></script>
</body>

</html>