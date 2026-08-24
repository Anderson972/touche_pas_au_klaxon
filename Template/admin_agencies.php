<?php require __DIR__.'/partials/head.php'; ?>
    <title>Liste des agences</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_admin.php'; ?>
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
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>