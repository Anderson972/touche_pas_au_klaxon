<?php require __DIR__.'/partials/head.php'; ?>
    <title>Liste Trajets</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_admin.php'; ?>
    <main class="container min-vh-100">
        <h1 class="mb-3">Liste des trajets</h1>
        <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-secondary fade show mb-3" id="flashMessage" role="alert">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
        <?php } ?>
        <table class="table text-center border align-middle table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Départ</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Date</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Heure</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Destination</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Date</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Heure</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Places</th>
                    <th class="bg-secondary text-white"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rides as $ride) { ?>
                    <tr>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $ride['ville_depart']; ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo date('d/m/Y', strtotime($ride['GDH_depart'])); ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo date('h:i', strtotime($ride['GDH_depart'])); ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $ride['ville_arrivee']; ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo date('d/m/Y', strtotime($ride['GDH_arrivee'])); ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo date('h:i', strtotime($ride['GDH_arrivee'])); ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $ride['nb_places_dispo']; ?></td>
                        <td><button data-id-trajet="<?php echo $ride['id_trajets']; ?>" class="btn" data-bs-toggle="modal" data-bs-target="#detailRideModal"><i class="bi bi-eye"></i></button>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#deleteRideModal"><i class="bi bi-trash"></i></button>

                            <div class="modal fade" id="deleteRideModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <span>Voulez vous supprimer ce trajet ?</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                            <form class="d-inline" action="/admin/rides/delete_ride/<?php echo $ride['id_trajets'];?>" method="post">
                                                <button class="btn btn-outline-danger" type="submit">Oui</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" >Auteur : <span class="fw-bold" id="authorModal"></span></li>
                        <li class="list-group-item" >Téléphone : <span class="fw-bold" id="phoneModal"></span></li>
                        <li class="list-group-item" >Email : <span class="fw-bold" id="emailModal"></span></li>
                        <li class="list-group-item" >Nombre total de places : <span id="totalSeatsModal"></span></li>
                    </ul>
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