<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un trajet</title>
</head>
<body>

<h1>Proposer un trajet</h1>

<form>
    <div class="mb-3 row">
        <label for="nom" class="col-sm-2 col-form-label">Nom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control-plaintext" id="nom" value="<?php echo $_SESSION['nom'] ?>" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
        <div class="col-sm-10">
            <input type="text" class="form-control-plaintext" id="prenom" value="<?php echo $_SESSION['prenom'] ?>" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control-plaintext" id="email" value="<?php echo $_SESSION['email'] ?>" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
        <div class="col-sm-10">
            <input type="text" class="form-control-plaintext" id="telephone" value="<?php echo $_SESSION['telephone'] ?>" readonly>
        </div>
    </div>
</form>

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

    <button type="submit">Créer le trajet</button>
</form>

</body>
</html>