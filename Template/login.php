<?php require __DIR__.'/partials/head.php'; ?>
    <title>Connexion</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_home.php'; ?>
    <main class="container min-vh-100">
        <h1 class="mb-3">Se connecter</h1>
        <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-secondary fade show mb-3" id="flashMessage" role="alert">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
        <?php } ?>
        <form class="w-50 mx-auto border border-3 border-secondary rounded-3 bg-secondary-subtle p-3 text-secondary" action="/login" method="post">
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button class="btn btn-secondary" type="submit">Valider</button>
        </form>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>