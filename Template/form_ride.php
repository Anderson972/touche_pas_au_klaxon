<?php require __DIR__.'/partials/head.php'; ?>
    <title><?php echo isset($data) ? 'Modifier': 'Créer' ?> un trajet</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_connected.php'; ?>
    <main class="container min-vh-100">
        <h1 class="mb-3"><?php echo isset($data) ? 'Modifier': 'Proposer' ?> un trajet</h1>
        <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-secondary fade show mb-3" id="flashMessage" role="alert">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
        <?php } ?>
        <form class="mb-3 w-50 bg-secondary-subtle border border-3 border-secondary rounded-3 p-3 mx-auto">
            <div class="mb-3 row">
                <label for="auteur" class="col-sm-3 col-form-label fw-bold">Auteur : </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" id="auteur" value="<?php echo $_SESSION['nom'] ?> <?php echo $_SESSION['prenom'] ?>" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-3 col-form-label fw-bold">Email : </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" id="email" value="<?php echo $_SESSION['email'] ?>" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="telephone" class="col-sm-3 col-form-label fw-bold">Téléphone : </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" id="telephone" value="<?php echo $_SESSION['telephone'] ?>" readonly>
                </div>
            </div>
        </form>
        <form class=" row mb-3 w-50 bg-secondary-subtle border border-3 border-secondary rounded-3 p-3 mx-auto" action="/connected/form_ride/<?php echo isset($data) ? $data['id_trajets'].'/update_ride':'create_ride' ?>" method="POST">


            <div class="col-sm-6 mb-4">
                <label class="fw-bold form-label" for="gdh_depart">Date et heure de départ</label>
                <input class="form-control" type="datetime-local" name="gdh_depart" id="gdh_depart" value="<?php echo isset($data) ? $data['GDH_depart']: '' ?>" required>
            </div>
            <div class="col-sm-6 mb-4">
                <label class="fw-bold form-label" for="gdh_arrivee">Date et heure d'arrivée</label>
                <input class="form-control" type="datetime-local" name="gdh_arrivee" id="gdh_arrivee" value="<?php echo isset($data) ? $data['GDH_arrivee']: '' ?>" required>
            </div>

            <div class="col-sm-6 mb-4">
                <label class="fw-bold form-label" for="agence_depart">Agence de départ</label>
                <select class="form-select" name="agence_depart" id="agence_depart" required>
                    <?php foreach ($agencies as $value) {
                        $selected = (isset($data) && $data['fk_id_agences_depart'] == $value['id_agences']) ? 'selected' : '';
                        echo '<option value="'.$value['id_agences'].'" '.$selected.'>'.$value['villes'].'</option>';
                    } ?>
                </select>
            </div>
            <div class="col-sm-6 mb-4">
                <label class="fw-bold form-label" for="agence_arrivee">Agence d'arrivée</label>
                <select class="form-select" name="agence_arrivee" id="agence_arrivee" required>
                    <?php foreach ($agencies as $value) {
                        $selected = (isset($data) && $data['fk_id_agences_arrivee'] == $value['id_agences']) ? 'selected' : '';
                        echo'  <option value="'.$value['id_agences'].'" '.$selected.'>'.$value['villes'].'</option>';
                    } ?>
                </select>
            </div>

            <div class="col-sm-6">
                <label class="fw-bold form-label" for="place_totale">Nombre de places totales</label>
                <input class="form-control" type="number" name="place_totale" id="place_totale" min="1" value="<?php echo isset($data) ? $data['nb_places_total']: '' ?>" required>
            </div>
            <div class="col-sm-6 d-flex align-items-end justify-content-end">
                <button class="btn btn-secondary" type="submit"><?php echo isset($data) ? 'Modifier': 'Créer' ?> le trajet</button>
            </div>

        </form>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>