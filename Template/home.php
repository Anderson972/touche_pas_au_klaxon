<?php require __DIR__.'/partials/head.php'; ?>
    <title>Trajets disponibles</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_home.php'; ?>
    <main class="container min-vh-100">
        <h1 class="mb-3">Trajets proposés</h1>

        <table class="table text-center border align-middle table-borderless table-striped table-hover">
            <thead class="bg-secondary text-white">
                <tr>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Départ</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Date</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Heure</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Destination</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Date</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Heure</th>
                    <th class="bg-secondary text-white">Places</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rides as $ride) { ?>
                    <tr>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $ride['ville_depart']; ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo date('d/m/Y', strtotime($ride['GDH_depart'])); ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo date('H:i', strtotime($ride['GDH_depart'])); ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $ride['ville_arrivee']; ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo date('d/m/Y', strtotime($ride['GDH_arrivee'])); ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo date('H:i', strtotime($ride['GDH_arrivee'])); ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $ride['nb_places_dispo']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>