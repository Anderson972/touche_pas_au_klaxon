<?php require __DIR__.'/partials/head.php'; ?>
    <title>Connexion</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_home.php'; ?>
    <main>
        <h1>Se connecter</h1>
        <?php
        if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        }?>
        <form action="/login" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Valider</button>
        </form>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>