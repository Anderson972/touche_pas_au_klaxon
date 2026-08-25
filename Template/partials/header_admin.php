<header class="mb-4 mt-2 container d-flex justify-content-between align-items-center p-3 border border-3 border-secondary rounded-3 bg-light">
    <a href="/admin" class="text-decoration-none text-secondary"><strong>Touche pas au klaxon — Admin</strong></a>
    <nav class="d-flex justify-content-between w-75 align-items-center">
        <a href="/admin/users" class="btn btn-outline-secondary <?php echo $_SERVER['REQUEST_URI'] == '/admin/users' ? 'active':''?>">Utilisateurs</a>
        <a href="/admin/agencies" class="btn btn-outline-secondary <?php echo $_SERVER['REQUEST_URI'] == '/admin/agencies' ? 'active':''?>">Agences</a>
        <a href="/admin/rides" class="btn btn-outline-secondary <?php echo $_SERVER['REQUEST_URI'] == '/admin/rides' ? 'active':''?>">Trajets</a>
        <span>Bonjour <?php echo $_SESSION['prenom']; ?> <?php echo $_SESSION['nom']; ?></span>
        <a href="/logout" class="btn btn-outline-danger">Se déconnecter</a>
    </nav>
</header>