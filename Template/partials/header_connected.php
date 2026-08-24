<header class="d-flex justify-content-between align-items-center p-3 border-bottom">
    <span>Bonjour <?php echo $_SESSION['prenom']; ?> <?php echo $_SESSION['nom']; ?></span>
    <div>
        <a href="/connected/form_ride" class="btn btn-primary btn-sm">Proposer un trajet</a>
        <a href="/logout" class="btn btn-outline-secondary btn-sm">Se déconnecter</a>
    </div>
</header>