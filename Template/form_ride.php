<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un trajet</title>
</head>
<body>

<h1>Proposer un trajet</h1>

<form action="/connected/form_ride/create_ride" method="POST">
<?php
    if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}?>

    <label for="gdh_depart">Date et heure de départ</label>
    <input type="datetime-local" name="gdh_depart" id="gdh_depart" required>

    <label for="gdh_arrivee">Date et heure d'arrivée</label>
    <input type="datetime-local" name="gdh_arrivee" id="gdh_arrivee" required>

    <label for="agence_depart">Agence de départ</label>
    <select name="agence_depart" id="agence_depart" required>
        <?php foreach ($agencies as $value) {
           echo'  <option value="'.$value['id_agences'].'">'.$value['villes'].'</option>';
        } ?>
    </select>

    <label for="agence_arrivee">Agence d'arrivée</label>
    <select name="agence_arrivee" id="agence_arrivee" required>
        <?php foreach ($agencies as $value) {
           echo'  <option value="'.$value['id_agences'].'">'.$value['villes'].'</option>';
        } ?>
    </select>

    <label for="place_totale">Nombre de places totales</label>
    <input type="number" name="place_totale" id="place_totale" min="1" required>

    <input type="hidden" name="auteur" value="1">

    <button type="submit">Créer le trajet</button>
</form>

</body>
</html>