<?php require __DIR__.'/partials/head.php'; ?>
    <title><?php echo isset($data) ? 'Modifier': 'Créer' ?> une agence</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_admin.php'; ?>
    <main class="container min-vh-100">
        <h1 class="mb-3"><?php echo isset($data) ? 'Modifier': 'Créer' ?> une agence</h1>
        <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-secondary fade show mb-3" id="flashMessage" role="alert">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
        <?php } ?>
        <form class="mb-3 w-50 bg-secondary-subtle border border-3 border-secondary rounded-3 p-3 mx-auto" action="/admin/agencies/form_agency/<?php echo isset($data) ? $data['id_agences'].'/update_agency':'create_agency' ?>" method="POST">
            <label class="col-sm-3 col-form-label fw-bold" for="ville">Ville</label>
            <input class="form-control mb-3" type="text" name="ville" id="ville" value="<?php echo isset($data) ? $data['villes']: '' ?>" required>
            <button class="btn btn-secondary" type="submit"><?php echo isset($data) ? 'Modifier': 'Créer' ?> l'agence</button>
        </form>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>