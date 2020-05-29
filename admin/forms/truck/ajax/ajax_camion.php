<?php
     include '../../../../assets/connexion_bdd.php';
     include '../../../../assets/querrySimplifier.php';

        if($_POST['choix'] == "Ajouter")
        {
            echo '
                <h3 class="mt-3">Formulaire d\'ajout de camion : </h3>
                <form action="add_truck.php" method="POST">
                    <div class="form-group">
                        <label for="marqueCamion">Marque du camion : </label>
                        <input type="text" class="form-control" id="marqueCamion" name="marqueCamion" placeholder="(Ex : Iveco)">
                    </div>
                    <div class="form-group">
                        <label for="modelCamion">Model du camion : </label>
                        <input type="text" class="form-control" id="modelCamion" name="modelCamion" placeholder="(Ex : Stralis Hi-Way 560)">
                    </div>
                    <div class="form-group">
                        <label for="typeCamion">Type de camion : </label>
                        <input type="text" class="form-control" id="typeCamion" name="typeCamion" placeholder="(Ex : II1,II5...)">
                    </div>
                    <div class="form-group">
                        <label for="dateMsCamion">Date de première mise en circulation du camion : </label>
                        <input type="date" class="form-control" id="dateMsCamion" name="dateMsCamion" placeholder="(Ex : 12/01/2001)">
                    </div>
                    <div class="form-group">
                        <label for="consCamion">Consomation du camion (L / 100 Km) : </label><br/>
                        <input type="number" id="consCamion" name="consCamion" min="1.0" step="0.1" max="50.0"> Litre(s)
                    </div>
                    <div class="form-group">
                        <label for="kmCamion">Kilomètrage du camion : </label><br/>
                        <input type="number" id="kmCamion" name="kmCamion" min="0" step="1" max="1000000"> Kilomètres(s)
                    </div>
                    <div class="form-group">
                        <label for="reservCamion">Taille du réservoir du camion : </label><br/>
                        <input type="number" id="reservCamion" name="reservCamion" min="0.0" step="1" max="1000.0"> Litre(s)
                    </div>
                    <div class="form-group">
                        <label for="numImmat">Immatriculation du camion : </label>
                        <input type="text" class="form-control" id="numImmat" name="numImmat" placeholder="(Ex : AAA-111-BBB)">
                    </div>
                    <div class="form-group">
                        <label for="gasCamion">Type de carburant du camion : </label>
                        <select class="form-control" id="gasCamion" name="gasCamion">
                            <option>Essence</option>
                            <option>Gasoil</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>';
            
        }
        else if($_POST['choix'] == "Supprimer")
        {
            echo '<h3 class="mt-3">Formulaire de suppression d\'un camion : </h3>
            <form action="del_truck.php" method="POST">
                <div class="form-group">
                    <label for="searchImmat">Saisir l\'immatriculation du camion </label>
                    <input type="text" class="form-control" id="searchImmat" name="searchImmat" placeholder="(Ex : AAA-111-BBB)">
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
            $sql->preparedStatement("SELECT * FROM camion WHERE numero_immat_camion like $1;",array($_POST['req']."%"));
            while($row = pg_fetch_array($sql->getValue())){
                echo "<tr>
                        <td>".$row['id_camion']."</td>
                        <td>".$row['marque_camion']."</td>
                        <td>".$row['model_camion']."</td>
                        <td>".$row['type_camion']."</td>
                        <td>".$row['date_premiere_circulation']."</td>
                        <td>".$row['consomation_moyenne']."</td>
                        <td>".$row['nb_km_camion']."</td>
                        <td>".$row['taille_reservoir_camion']."</td>
                        <td>".$row['numero_immat_camion']."</td>
                        <td>".$row['type_carburant']."</td>
                    </tr>
                ";
            }
        }
        else{
            echo "Erreur";
        }
