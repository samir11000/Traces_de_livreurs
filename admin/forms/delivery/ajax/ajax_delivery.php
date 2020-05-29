<?php
     include '../../../../assets/connexion_bdd.php';
     include '../../../../assets/querrySimplifier.php';

     $req = new querrySimplifier($connec);

        if($_POST['choix'] == "Ajouter")
        {
            echo '
            <h3 class="mt-3">Formulaire d\'ajout de livreur : </h3>
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
                    <label for="DeliveryLicenceDate">Date d\'obtention du permis du livreur : </label>
                    <input type="date" class="form-control" id="DeliveryLicenceDate" name="DeliveryLicenceDate" placeholder="(Ex : 12/01/2005)">
                </div>
                <div class="form-group">
                    <label for="DeliveryLicenceExpirationDate">Date d\'expiration du permis du livreur : </label>
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
            </form>';
            
        }
        else if($_POST['choix'] == "Supprimer")
        {
            echo '<h3 class="mt-3">Formulaire de suppression d\'un livreur : </h3>
            <form action="del_delivery.php" method="POST">
                <div class="form-group">
                    <label for="searchImmat">Saisir le nom du livreur : </label>
                    <input type="text" class="form-control" id="searchDeliveryName" name="searchDeliveryName" placeholder="(Ex : Ménard)">
                </div>
                <div id="tab-camions">
                </div>
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            ';
        }
        else if($_POST['choix'] == "supp")
        {
            $sql = new querrySimplifier($connec);
            $sql->preparedStatement("SELECT * FROM livreur WHERE nom_livreur like $1;",array($_POST['req']."%"));
            while($row = pg_fetch_array($sql->getValue())){
                echo "<tr>
                        <td>".$row["id_livreur"]."</td>
                        <td>".$row["nom_livreur"]."</td>
                        <td>".$row["prenom_livreur"]."</td>
                        <td>".$row["adresse_livreur"]."</td>
                        <td>".$row["date_naissance_livreur"]."</td>
                        <td>".$row["date_obtention_permis"]."</td>
                        <td>".$row["date_expiration_permis"]."</td>
                        <td>".$row["num_permis"]."</td>
                        <td>".$row["tel_livreur"]."</td>
                        <td>".$req->quickRequest('SELECT nom_ville FROM ville where id_ville=' . $row['id_ville'] . ';')[0]."</td>
                    </tr>";
            }
        }
        else{
            echo "Erreur";
        }
