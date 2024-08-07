<?php
// Inclure les fichiers nécessaires pour la connexion à la base de données
include_once 'db_connection.php'; // Assurez-vous d'avoir ce fichier pour la connexion à la DB

// Fonction pour ajouter un personnage
function ajouterPersonnage($nom, $sante, $musculation) {
    global $pdo;
    $sql = "INSERT INTO personnages (nom, sante, musculation) VALUES (:nom, :sante, :musculation)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nom' => $nom, 'sante' => $sante, 'musculation' => $musculation]);
}

// Fonction pour lire tous les personnages
function lirePersonnages() {
    global $pdo;
    $sql = "SELECT * FROM personnages";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour lire un personnage par ID
function lirePersonnage($id) {
    global $pdo;
    $sql = "SELECT * FROM personnages WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour mettre à jour un personnage
function mettreAJourPersonnage($id, $nom, $sante, $musculation) {
    global $pdo;
    $sql = "UPDATE personnages SET nom = :nom, sante = :sante, musculation = :musculation WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id, 'nom' => $nom, 'sante' => $sante, 'musculation' => $musculation]);
}

// Fonction pour supprimer un personnage
function supprimerPersonnage($id) {
    global $pdo;
    $sql = "DELETE FROM personnages WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}

// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=mon_jeu;charset=utf8';
$user = 'root';
$pass = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$pdo = new PDO($dsn, $user, $pass, $options);

// Traitement des requêtes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'ajouter') {
            ajouterPersonnage($_POST['nom'], $_POST['sante'], $_POST['musculation']);
        } elseif ($_POST['action'] === 'mettre_a_jour') {
            mettreAJourPersonnage($_POST['id'], $_POST['nom'], $_POST['sante'], $_POST['musculation']);
        } elseif ($_POST['action'] === 'supprimer') {
            supprimerPersonnage($_POST['id']);
        }
    }
}

$personnages = lirePersonnages();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Personnages</title>
</head>
<body>
    <h1>Gestion des Personnages</h1>

    <h2>Ajouter un Personnage</h2>
    <form method="post">
        <input type="hidden" name="action" value="ajouter">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required>
        <label for="sante">Santé:</label>
        <input type="number" name="sante" required>
        <label for="musculation">Musculation:</label>
        <input type="number" name="musculation" required>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Modifier un Personnage</h2>
    <form method="post">
        <input type="hidden" name="action" value="mettre_a_jour">
        <label for="id">ID:</label>
        <input type="number" name="id" required>
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required>
        <label for="sante">Santé:</label>
        <input type="number" name="sante" required>
        <label for="musculation">Musculation:</label>
        <input type="number" name="musculation" required>
        <button type="submit">Mettre à jour</button>
    </form>

    <h2>Supprimer un Personnage</h2>
    <form method="post">
        <input type="hidden" name="action" value="supprimer">
        <label for="id">ID:</label>
        <input type="number" name="id" required>
        <button type="submit">Supprimer</button>
    </form>

    <h2>Liste des Personnages</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Santé</th>
                <th>Musculation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personnages as $personnage): ?>
                <tr>
                    <td><?= htmlspecialchars($personnage['id']) ?></td>
                    <td><?= htmlspecialchars($personnage['nom']) ?></td>
                    <td><?= htmlspecialchars($personnage['sante']) ?></td>
                    <td><?= htmlspecialchars($personnage['musculation']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>