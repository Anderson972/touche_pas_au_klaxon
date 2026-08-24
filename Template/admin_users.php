<?php require __DIR__.'/partials/head.php'; ?>
    <title>Liste utilisateur</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_admin.php'; ?>
    <main>
        <?php
            if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['nom']; ?></td>
                        <td><?php echo $user['prenom']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['telephone']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>