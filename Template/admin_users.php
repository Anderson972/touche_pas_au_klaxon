<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste utilisateur</title>
</head>
<body>
    <header>
        <h1>Liste utilisateur</h1>
    </header>
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

</body>
</html>