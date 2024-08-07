<?php
include 'db_connection.php'; // Inclure le fichier de connexion

// Préparer et exécuter la requête SQL pour récupérer les personnages
$sql = "SELECT * FROM personnages";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$personnages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Personnages</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Inclure votre CSS -->
</head>
<body>
    <h1>Liste des Personnages</h1>
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