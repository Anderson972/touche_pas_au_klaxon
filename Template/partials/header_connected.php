<header class="mb-4 mt-2 container d-flex justify-content-between align-items-center p-3 border border-3 border-secondary rounded-3 bg-light">
    <a href="/connected" class="text-decoration-none text-secondary"><strong>Touche pas au klaxon</strong></a>
    <div class="d-flex justify-content-between w-50 align-items-center">
        <a href="/connected/form_ride" class="btn btn-secondary">Proposer un trajet</a>
        <span>Bonjour <?php echo $_SESSION['prenom']; ?> <?php echo $_SESSION['nom']; ?></span>
        <a href="/logout" class="btn btn-outline-secondary">Se déconnecter</a>
    </div>
</header>