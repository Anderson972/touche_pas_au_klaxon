<?php require __DIR__.'/partials/head.php'; ?>
    <title>Tableau de bord</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_admin.php'; ?>
    <main class="container min-vh-100">
        <h1 class="mb-3">Tabeau de bord</h1>
        <div class="d-grid gap-3 col-6 mx-auto">
            <a class="btn btn-lg btn-outline-secondary" href="/admin/rides">Liste des trajets</a>
            <a class="btn btn-lg btn-outline-secondary" href="/admin/agencies">Liste des agences</a>
            <a class="btn btn-lg btn-outline-secondary" href="/admin/users">Liste des utilisateurs</a>
        </div>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>