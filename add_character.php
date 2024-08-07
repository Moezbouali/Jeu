<?php
include 'db_connection.php'; // Inclure le fichier de connexion

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $sante = $_POST['sante'];
    $musculation = $_POST['musculation'];

    // Préparer la requête SQL
    $sql = "INSERT INTO personnages (nom, sante, musculation) VALUES (:nom, :sante, :musculation)";
    $stmt = $pdo->prepare($sql);

    // Exécuter la requête
    try {
        $stmt->execute([
            ':nom' => $nom,
            ':sante' => $sante,
            ':musculation' => $musculation
        ]);
        echo "Le personnage a été ajouté avec succès!";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Personnage</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Ajouter un Personnage</h1>
    <form method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="sante">Santé:</label>
        <input type="number" id="sante" name="sante" required><br>

        <label for="musculation">Musculation:</label>
        <input type="number" id="musculation" name="musculation" required><br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>