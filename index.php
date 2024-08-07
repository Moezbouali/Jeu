<?php
// Inclure les classes
include_once 'Objet.php';
include_once 'Arme.php';
include_once 'Armure.php';
include_once 'Chevalier.php';
include_once 'Ogre.php';
include_once 'Lutin.php';
include_once 'Princesse.php';

// Initialisation des personnages et objets
// Assurez-vous que la session est démarrée

if (!isset($_SESSION['chevalier']) || !isset($_SESSION['ogre']) || !isset($_SESSION['princesse']) || !isset($_SESSION['arme_legend']) || !isset($_SESSION['armure_legend'])) {
    $_SESSION['chevalier'] = new Chevalier();
    $_SESSION['ogre'] = new Ogre();
    $_SESSION['princesse'] = new Princesse();
    $_SESSION['arme_legend'] = new Arme("Épée Légendaire", 10);
    $_SESSION['armure_legend'] = new Armure("Armure Légendaire", 10);
}

$chevalier = $_SESSION['chevalier'];
$ogre = $_SESSION['ogre'];
$princesse = $_SESSION['princesse'];
$armeLegend = $_SESSION['arme_legend'];
$armureLegend = $_SESSION['armure_legend'];
$message = "";
$caracteristiquesChevalier = "";
$caracteristiquesOgre = "";
$caracteristiquesPrincesse = "";

ob_start(); // Démarrer la temporisation de sortie

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'gifle') {
            $chevalier->gifle($ogre);
            $chevalier->gagnerExperience(20); // Gagner de l'expérience
            $message = "Le chevalier a giflé l'ogre!";
            echo "<script>showBloodSplatter();</script>";
        } elseif ($_POST['action'] == 'coupspecial') {
            $chevalier->coupspecial($ogre);
            $chevalier->gagnerExperience(50); // Gagner plus d'expérience pour un coup spécial
            $message = "Le chevalier a utilisé son coup spécial contre l'ogre!";
            echo "<script>showBloodSplatter();</script>";
        } elseif ($_POST['action'] == 'equipArme') {
            $chevalier->equiperObjet($armeLegend);
            $message = "Le chevalier a équipé l'Épée Légendaire!";
        } elseif ($_POST['action'] == 'equipArmure') {
            $chevalier->equiperObjet($armureLegend);
            $message = "Le chevalier a équipé l'Armure Légendaire!";
        } elseif ($_POST['action'] == 'caracteristiquesChevalier') {
            $caracteristiquesChevalier = $chevalier->afficherCaracteristiques();
        } elseif ($_POST['action'] == 'caracteristiquesOgre') {
            $caracteristiquesOgre = $ogre->afficherCaracteristiques();
        } elseif ($_POST['action'] == 'caracteristiquesPrincesse') {
            $caracteristiquesPrincesse = $princesse->afficherCaracteristiques();
        }

        if ($ogre->estVivant() && $_POST['action'] != 'caracteristiquesChevalier' && $_POST['action'] != 'caracteristiquesOgre' && $_POST['action'] != 'caracteristiquesPrincesse') {
            $ogre->coupDesalete($chevalier);
            $message .= " L'ogre a riposté!";
            echo "<script>showBloodSplatter();</script>";
        }

        if (!$chevalier->estVivant()) {
            $message .= " Le chevalier est mort. L'ogre a gagné!";
        } elseif (!$ogre->estVivant()) {
            $message .= " L'ogre est mort. Le chevalier a gagné!";
        }
    }
}
ob_end_flush(); // Envoyer la sortie tamponnée
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tournoi Monstre vs Héros</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
    <script>
        function showBloodSplatter() {
            var splatter = document.createElement('div');
            splatter.className = 'blood-splatter';
            splatter.style.top = (Math.random() * window.innerHeight) + 'px';
            splatter.style.left = (Math.random() * window.innerWidth) + 'px';
            document.body.appendChild(splatter);
            gsap.fromTo(splatter, {scale: 0, opacity: 1}, {scale: 1, opacity: 0, duration: 1, onComplete: function() {
                splatter.remove();
            }});
        }
    </script>
</head>
<body>
    <h1>Tournoi Monstre vs Héros</h1>
    
    <div class="container">
        <div class="character">
            <h2>Chevalier</h2>
            <img src="/imges/chevalier.png" alt="Chevalier">
            <p>Santé: <?= $chevalier->getSante() ?></p>
            <p>Musculation: <?= $chevalier->getMusculation() ?></p>
            <form method="post">
                <button type="submit" name="action" value="gifle">Gifle</button>
                <button type="submit" name="action" value="coupspecial">Coup Spécial</button>
                <button type="submit" name="action" value="equipArme">Équiper Épée Légendaire</button>
                <button type="submit" name="action" value="equipArmure">Équiper Armure Légendaire</button>
                <button type="submit" name="action" value="caracteristiquesChevalier">Afficher Caractéristiques</button>
            </form>
            <p><?= $caracteristiquesChevalier ?></p>
        </div>
        <div class="character">
            <h2>Ogre</h2>
            <img src="/imges/Ogre.png" alt="Ogre">
            <p>Santé: <?= $ogre->getSante() ?></p>
            <p>Musculation: <?= $ogre->getMusculation() ?></p>
            <form method="post">
                <button type="submit" name="action" value="caracteristiquesOgre">Afficher Caractéristiques</button>
            </form>
            <p><?= $caracteristiquesOgre ?></p>
        </div>
        <div class="character">
            <h2>Princesse</h2>
            <img src="/imges/princesse.png" alt="Princesse">
            <p>Santé: <?= $princesse->getSante() ?></p>
            <p>Musculation: <?= $princesse->getMusculation() ?></p>
            <form method="post">
                <button type="submit" name="action" value="gifle">Gifle</button>
                <button type="submit" name="action" value="coupspecial">Coup Spécial</button>
                <button type="submit" name="action" value="equipArme">Équiper Épée Légendaire</button>
                <button type="submit" name="action" value="equipArmure">Équiper Armure Légendaire</button>
                <button type="submit" name="action" value="caracteristiquesPrincesse">Afficher Caractéristiques</button>
            </form>
            <p><?= $caracteristiquesPrincesse ?></p>
        </div>
    </div>
    <div class="message">
        <h3>Résultat du Combat</h3>
        <p><?= $message ?></p>
    </div>
    <!-- Container pour centrer le bouton -->
    <div class="button-container">
        <form action="add_character.php" method="get">
            <button type="submit">Ajouter un Nouveau Personnage</button>
        </form>
    </div>
</body>
</html>