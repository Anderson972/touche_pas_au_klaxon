<?php require __DIR__.'/partials/head.php'; ?>
    <title>Liste utilisateurs</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_admin.php'; ?>
    <main class="container min-vh-100">
        <h1 class="mb-3">Liste des utilisateurs</h1>
        <table class="table text-center border align-middle table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Nom</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Prénom</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Email</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $user['nom']; ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $user['prenom']; ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $user['email']; ?></td>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $user['telephone']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>