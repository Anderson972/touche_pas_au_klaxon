<?php require __DIR__.'/partials/head.php'; ?>
    <title>Liste des agences</title>
</head>
<body>
    <?php require __DIR__.'/partials/header_admin.php'; ?>
    <main class="container min-vh-100">
        <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-secondary fade show mb-3" id="flashMessage" role="alert">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
        <?php } ?>
        <h1 class="mb-3">Liste des agences</h1>
        <a  class="btn btn-secondary float-end mb-3" href="/admin/agencies/form_agency">Créer une agence</a>
        <table class="table text-center border align-middle table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2">Villes</th>
                    <th class="bg-secondary text-white border-start-0 border-top-0 border-bottom-0 border-2"></th>
            </thead>
            <tbody>
                <?php foreach ($agencies as $agency) { ?>
                    <tr>
                        <td class="border-start-0 border-top-0 border-bottom-0 border-2"><?php echo $agency['villes']; ?></td>
                        <td> 
                            <a class="btn link-secondary fs-4" href="/admin/agencies/form_agency/<?php echo $agency['id_agences']; ?>"><i class="bi bi-pencil-square"></i></a>
                            <button class="btn link-secondary fs-4" type="submit" data-bs-toggle="modal" data-bs-target="#deleteAgencyModal"><i class="bi bi-trash"></i></button> 

                            <div class="modal fade" id="deleteAgencyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span>Voulez vous supprimer cette agence ?</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                                <form class="d-inline" action="/admin/agencies/delete_agency/<?php echo $agency['id_agences']; ?>" method="post"> 
                                                    <button class="btn btn-outline-danger" type="submit">Oui</button> 
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            
                        </td> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <?php require __DIR__.'/partials/footer.php'; ?>
</body>
</html>