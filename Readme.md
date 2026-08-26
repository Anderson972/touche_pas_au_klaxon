# Touche pas au klaxon

Application de covoiturage inter-sites, développée en PHP (architecture MVC) pour le devoir CEF "Mise en place d'une application MVC en PHP".

## Fonctionnalités

- **Visiteur** : consultation de la liste des trajets disponibles (places restantes, date de départ future).
- **Utilisateur connecté** : en plus de la liste, consultation du détail d'un trajet (contact de l'auteur), proposition d'un nouveau trajet, modification/suppression de ses propres trajets.
- **Administrateur** : liste des utilisateurs, gestion complète des agences (créer/modifier/supprimer), liste des trajets et suppression.

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- Node.js et npm
- MySQL ou MariaDB
- Un serveur local type MAMP/XAMPP/WAMP (Apache + MySQL), avec le module `mod_rewrite` activé

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/Anderson972/touche_pas_au_klaxon.git
cd touche_pas_au_klaxon
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances front (Bootstrap, Sass, Bootstrap Icons)

```bash
npm install
npm run build
```

Cette dernière commande compile `Public/scss/main.scss` vers `Public/css/main.css`.

### 4. Configurer l'environnement

Copier le fichier `.env.example` en `.env` et renseigner vos identifiants de connexion à la base de données :

```
DB_HOST=localhost
DB_PORT=3306
DB_NAME=touche_pas_au_klaxon
DB_USER=root
DB_PASSWORD=<votre_mot_de_passe>
```

### 5. Créer la base de données

Exécuter le script de création des tables, puis le script d'alimentation, dans phpMyAdmin ou en ligne de commande :

```bash
mysql -u root -p < Database/schema.sql
mysql -u root -p < Database/alimentation.sql
```

### 6. Lancer le serveur

Placer le document root de votre serveur (Apache/MAMP) sur le dossier `Public/` du projet, puis démarrer le serveur.

L'application est alors accessible à l'adresse `http://localhost/`.

## Qualité et tests

### Analyse statique (PHPStan)

```bash
vendor/bin/phpstan analyse -c phpstan.neon
```

### Tests unitaires (PHPUnit)

Les tests utilisent une base de données de test séparée (`touche_pas_au_klaxon_test`), à créer au préalable avec le même script `Database/touche_pas_au_klaxon.sql` et le charger avec `Database/alimentation.sql`. Le nom de cette base est surchargé automatiquement par la configuration `phpunit.xml`.

```bash
vendor/bin/phpunit
```

## Architecture

Le projet suit une architecture MVC :

```
App/
  Controllers/   Orchestration des requêtes (appelle les Models, choisit la vue)
  Models/        Accès aux données et logique métier (requêtes SQL)
  Core/          Classes techniques transversales (connexion BDD, contrôle d'accès)
Database/        Scripts SQL (création et alimentation)
Public/          Point d'entrée web (index.php), assets compilés (css/js/fonts)
Template/        Vues (fichiers PHP affichant le HTML)
Test/            Tests PHPUnit
```

Routeur utilisé : librairie [izniburak/router](https://github.com/izniburak/php-router).

## Auteur

Anderson LUCE — Formation CEF