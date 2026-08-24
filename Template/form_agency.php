<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($data) ? 'Modifier': 'Créer' ?> une agence</title>
</head>
<body>

<h1><?php echo isset($data) ? 'Modifier': 'Créer' ?> une agence</h1>

<?php
    if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}?>

<form action="/admin/agencies/form_agency/<?php echo isset($data) ? $data['id_agences'].'/update_agency':'create_agency' ?>" method="POST">

    <label for="ville">Ville</label>
    <input type="text" name="ville" id="ville" value="<?php echo isset($data) ? $data['villes']: '' ?>" required>

    <button type="submit"><?php echo isset($data) ? 'Modifier': 'Créer' ?> l'agence</button>
</form>

</body>
</html>