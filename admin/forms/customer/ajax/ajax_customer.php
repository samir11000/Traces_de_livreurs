<?php
     include '../../../../assets/connexion_bdd.php';
     include '../../../../assets/querrySimplifier.php';

     $req = new querrySimplifier($connec);

        if($_POST['choix'] == "Ajouter")
        {
            echo '
            <h3 class="mt-3">Formulaire d\'ajout de client : </h3>
                                <form action="add_customer.php" method="POST">
                                    <div class="form-group">
                                        <label for="customerSurname">Nom du client : </label>
                                        <input type="text" class="form-control" id="customerSurname" name="customerSurname" placeholder="(Ex : Ménard)">
                                    </div>
                                    <div class="form-group">
                                        <label for="customerName">Prénom du client : </label>
                                        <input type="text" class="form-control" id="customerName" name="customerName" placeholder="(Ex : Robert)">
                                    </div>
                                    <div class="form-group">
                                        <label for="customerAddress">Adresse du client : </label>
                                        <input type="text" class="form-control" id="customerAddress" name="customerAddress" placeholder="(Ex : 2 avenue de la république)">
                                    </div>
                                    <div class="form-group">
                                        <label for="customerCity">Ville du client : </label>
                                        <input type="text" class="form-control" id="customerCity" name="customerCity" placeholder="(Ex : Carcassonne)">
                                    </div>
                                    <div class="form-group">
                                        <label for="customerNumber">Téléphone du client : </label>
                                        <input type="text" class="form-control" id="customerNumber" name="customerNumber" placeholder="(Ex : 0600000000)">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </form>';
            
        }
        else if($_POST['choix'] == "Supprimer")
        {
            echo '<h3 class="mt-3">Formulaire de suppression d\'un client : </h3>
            <form action="del_customer.php" method="POST">
                <div class="form-group">
                    <label for="searchImmat">Saisir le nom du client : </label>
                    <input type="text" class="form-control" id="searchCustomerName" name="searchCustomerName" placeholder="(Ex : Ménard)">
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
            $sql->preparedStatement("SELECT * FROM client WHERE nom_client like $1;",array($_POST['req']."%"));
            while($row = pg_fetch_array($sql->getValue())){
                echo "<tr>
                        <td>".$row["id_client"]."</td>
                        <td>".$row["nom_client"]."</td>
                        <td>".$row["prenom_client"]."</td>
                        <td>".$row["adresse_client"]."</td>
                        <td>".$row["tel_client"]."</td>
                        <td>".$req->quickRequest('SELECT nom_ville FROM ville where id_ville=' . $row['id_ville'] . ';')[0]."</td>
                    </tr>";
            }
        }
        else{
            echo "Erreur";
        }
