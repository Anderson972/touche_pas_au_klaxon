<?php require __DIR__.'/partials/head.php'; ?>
<title>Trajets disponibles</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_connected.php'; ?>
    <main>
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
                        <td><button data-id-trajet="<?php echo $ride['id_trajets']; ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailRideModal">En savoir plus...</button></td>
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
        <div class="modal fade" id="detailRideModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="authorModal"></span>
                    <span id="phoneModal"></span>
                    <span id="emailModal"></span>
                    <span id="totalSeatsModal"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
                </div>
            </div>
        </div>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
    <script src="/js/ride_details.js"></script>
</body>
</html>