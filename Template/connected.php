<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Trajets disponibles</title>
</head>
<body>

<header>
    <span>Bonjour <?php echo $_SESSION['prenom']; ?> <?php echo $_SESSION['nom']; ?></span>
    <a href="/connected/form_ride">Proposer un trajet</a>
    <!-- TODO : lien/bouton de déconnexion, on le fera juste après -->
</header>

<h1>Liste des trajets disponibles</h1>

<table>
    <thead>
        <tr>
            <th>Départ</th>
            <th>Date départ</th>
            <th>Arrivée</th>
            <th>Date arrivée</th>
            <th>Places dispo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rides as $ride) {
            echo' 
            <tr>
                <td>'.$ride['ville_depart'].'</td>
                <td>'.$ride['GDH_depart'].'</td>
                <td>'.$ride['ville_arrivee'].'</td>
                <td>'.$ride['GDH_arrivee'].'</td>
                <td>'.$ride['nb_places_dispo'].'</td>
            </tr> ';
        } ?>
    </tbody>
</table>

</body>
</html>