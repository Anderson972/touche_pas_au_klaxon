<?php require __DIR__.'/partials/head.php'; ?>
    <title>Liste Trajets</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_admin.php'; ?>
    <main>
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
                        <td><button data-id-trajet="<?php echo $ride['id_trajets']; ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailRideModal">En savoir plus...</button></td>
                        <td>
                            <form action="/admin/rides/delete_ride/<?php echo $ride['id_trajets'];?>" method="post">
                                <button type="submit">Supprimer</button>
                            </form>
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
        <script src="/js/ride_details.js"></script>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>