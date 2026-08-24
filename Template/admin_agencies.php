<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des agences</title>
</head>
<body>
    <header>
        <h1>Liste des agences</h1>
    </header>
    <main>
        <?php
            if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }?>
        <a href="/admin/agencies/form_agency">Créer une agence</a>
        <table>
            <thead>
                <tr>
                    <th>Villes</th>
            </thead>
            <tbody>
                <?php foreach ($agencies as $agency) { ?>
                    <tr>
                        <td><?php echo $agency['villes']; ?></td>
                        <td> 
                            <a href="/admin/agencies/form_agency/<?php echo $agency['id_agences']; ?>">Modifier</a>
                        </td>
                        <td> 
                            <form action="/admin/agencies/delete_agency/<?php echo $agency['id_agences']; ?>" method="post"> 
                                <button type="submit">Supprimer</button> 
                            </form>
                        </td> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>