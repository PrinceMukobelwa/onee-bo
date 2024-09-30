<?php

$host = 'localhost';
$dbname = 'onee_bo'; 
$username = 'root';
$password = '';

try {
   
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
    die("Erreur de connexion : " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - ONEE BO</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <?php include("./link.php")?>

    <main>
        <h2>Bienvenue sur le site de gestion des fichiers ONEE BO</h2>
        <p>Utilisez le menu de navigation pour accéder aux différentes sections du site.</p>
    </main>
    <footer>
        <p>&copy; 2024 ONEE BO - Tous droits réservés</p>
    </footer>
</body>
</html>