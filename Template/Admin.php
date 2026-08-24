<?php require __DIR__.'/partials/head.php'; ?>
    <title>Tableau de bord</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_admin.php'; ?>
    <main>
        <ul>
            <li><a href="/admin/rides">Liste des trajets</a></li>
            <li><a href="/admin/agencies">Liste des agences</a></li>
            <li><a href="/admin/users">Liste des utilisateurs</a></li>
        </ul>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>