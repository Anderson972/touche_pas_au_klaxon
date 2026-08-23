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
    <a href="/logout">Se déconnecter</a>
</header>

<h1>Liste des trajets disponibles</h1>

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
                <td><a href="/connected/detail/<?php echo $ride['id_trajets']; ?>">En savoir plus...</a></td>
                <td>
                    <?php if ($_SESSION['id_user'] == $ride['fk_id_users']) { ?>
                        <a href="/connected/form_ride/<?php echo $ride['id_trajets']; ?>">Modifier</a>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($_SESSION['id_user'] == $ride['fk_id_users']) { ?>
                        <form action="/connected/delete_ride/<?php echo $ride['id_trajets'];?>" method="post">
                            <button type="submit">Supprimer</button>
                        </form>
                    <?php } ?>
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