<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste Trajets</title>
</head>
<body>

<header>
    <span>Bonjour <?php echo $_SESSION['prenom']; ?> <?php echo $_SESSION['nom']; ?></span>
    <a href="/logout">Se déconnecter</a>
</header>

<h1>Liste des trajets</h1>

<?php
    if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}?>

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
        <?php foreach ($rides as $ride) { ?>
            <tr>
                <td><?php echo $ride['ville_depart']; ?></td>
                <td><?php echo $ride['GDH_depart']; ?></td>
                <td><?php echo $ride['ville_arrivee']; ?></td>
                <td><?php echo $ride['GDH_arrivee']; ?></td>
                <td><?php echo $ride['nb_places_dispo']; ?></td>
                <td><a href="/admin/rides/detail/<?php echo $ride['id_trajets']; ?>">En savoir plus...</a></td>
                <td>
                    <form action="/admin/rides/delete_ride/<?php echo $ride['id_trajets'];?>" method="post">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div class="modal">
    <!-- code modal -->
</div>

</body>
</html>