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


if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

 
    $stmt = $conn->prepare("SELECT * FROM robot WHERE id = ?");
    $stmt->execute([$id]);
    $robot = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $nom = htmlspecialchars($_POST['nom']);
        $designation = htmlspecialchars($_POST['designation']);
        $localisation = htmlspecialchars($_POST['localisation']);
        $adresse_ip = htmlspecialchars($_POST['adresse_ip']);
        $responsable = htmlspecialchars($_POST['responsable']);
        $marque = htmlspecialchars($_POST['marque']);
        $modele = htmlspecialchars($_POST['modele']);
        $generation = htmlspecialchars($_POST['generation']);
        $lecteurs = htmlspecialchars($_POST['lecteurs']);
        $cartouches = htmlspecialchars($_POST['cartouches']);
        $num_marche_acquisition = htmlspecialchars($_POST['num_marche_acquisition']);
        $designation_marche_acquisition = htmlspecialchars($_POST['designation_marche_acquisition']);
        $titulaire_marche_acquisition = htmlspecialchars($_POST['titulaire_marche_acquisition']);
        $debut_marche_acquisition = htmlspecialchars($_POST['debut_marche_acquisition']);
        $fin_marche_acquisition = htmlspecialchars($_POST['fin_marche_acquisition']);
        $cout_acquisition = htmlspecialchars($_POST['cout_acquisition']);
        $num_marche_maintenance = htmlspecialchars($_POST['num_marche_maintenance']);
        $designation_marche_maintenance = htmlspecialchars($_POST['designation_marche_maintenance']);
        $titulaire_marche_maintenance = htmlspecialchars($_POST['titulaire_marche_maintenance']);
        $debut_marche_maintenance = htmlspecialchars($_POST['debut_marche_maintenance']);
        $fin_marche_maintenance = htmlspecialchars($_POST['fin_marche_maintenance']);
        $cout_maintenance = htmlspecialchars($_POST['cout_maintenance']);

    
        $update = $conn->prepare("UPDATE robot SET 
            nom = ?, 
            designation = ?, 
            localisation = ?, 
            adresse_ip = ?, 
            responsable = ?, 
            marque = ?, 
            modele = ?, 
            generation = ?, 
            lecteurs = ?, 
            cartouches = ?, 
            num_marche_acquisition = ?, 
            designation_marche_acquisition = ?, 
            titulaire_marche_acquisition = ?, 
            debut_marche_acquisition = ?, 
            fin_marche_acquisition = ?, 
            cout_acquisition = ?, 
            num_marche_maintenance = ?, 
            designation_marche_maintenance = ?, 
            titulaire_marche_maintenance = ?, 
            debut_marche_maintenance = ?, 
            fin_marche_maintenance = ?, 
            cout_maintenance = ? 
            WHERE id = ?");
        $update->execute([$nom, $designation, $localisation, $adresse_ip, $responsable, $marque, $modele, $generation, $lecteurs, $cartouches, $num_marche_acquisition, $designation_marche_acquisition, $titulaire_marche_acquisition, $debut_marche_acquisition, $fin_marche_acquisition, $cout_acquisition, $num_marche_maintenance, $designation_marche_maintenance, $titulaire_marche_maintenance, $debut_marche_maintenance, $fin_marche_maintenance, $cout_maintenance, $id]);

        $succesMsg = "Robot modifié avec succès";
    }
} else {
    die("Robot non spécifié.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Robot - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("./link.php") ?>
    <main>
        <h2>Modifier un Robot</h2>
        <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
        <form method="POST">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($robot['nom']) ?>" required>
            
            <label for="designation">Désignation</label>
            <input type="text" id="designation" name="designation" value="<?= htmlspecialchars($robot['designation']) ?>" required>
            
            <label for="localisation">Localisation</label>
            <input type="text" id="localisation" name="localisation" value="<?= htmlspecialchars($robot['localisation']) ?>" required>
            
            <label for="adresse_ip">Adresse IP</label>
            <input type="text" id="adresse_ip" name="adresse_ip" value="<?= htmlspecialchars($robot['adresse_ip']) ?>" required>
            
            <label for="responsable">Responsable</label>
            <input type="text" id="responsable" name="responsable" value="<?= htmlspecialchars($robot['responsable']) ?>" required>
            
            <label for="marque">Marque</label>
            <input type="text" id="marque" name="marque" value="<?= htmlspecialchars($robot['marque']) ?>" required>
            
            <label for="modele">Modèle</label>
            <input type="text" id="modele" name="modele" value="<?= htmlspecialchars($robot['modele']) ?>" required>
            
            <label for="generation">Génération</label>
            <input type="text" id="generation" name="generation" value="<?= htmlspecialchars($robot['generation']) ?>" required>
            
            <label for="lecteurs">Nombre de Lecteurs</label>
            <input type="number" id="lecteurs" name="lecteurs" value="<?= htmlspecialchars($robot['lecteurs']) ?>" required>
            
            <label for="cartouches">Nombre de Cartouches</label>
            <input type="number" id="cartouches" name="cartouches" value="<?= htmlspecialchars($robot['cartouches']) ?>" required>
            
            <label for="num_marche_acquisition">N° Marché Acquisition</label>
            <input type="text" id="num_marche_acquisition" name="num_marche_acquisition" value="<?= htmlspecialchars($robot['num_marche_acquisition']) ?>" required>
            
            <label for="designation_marche_acquisition">Désignation Marché Acquisition</label>
            <input type="text" id="designation_marche_acquisition" name="designation_marche_acquisition" value="<?= htmlspecialchars($robot['designation_marche_acquisition']) ?>" required>
            
            <label for="titulaire_marche_acquisition">Titulaire Marché Acquisition</label>
            <input type="text" id="titulaire_marche_acquisition" name="titulaire_marche_acquisition" value="<?= htmlspecialchars($robot['titulaire_marche_acquisition']) ?>" required>
            
            <label for="debut_marche_acquisition">Date Début Marché Acquisition</label>
            <input type="date" id="debut_marche_acquisition" name="debut_marche_acquisition" value="<?= htmlspecialchars($robot['debut_marche_acquisition']) ?>" required>
            
            <label for="fin_marche_acquisition">Date Fin Marché Acquisition</label>
            <input type="date" id="fin_marche_acquisition" name="fin_marche_acquisition" value="<?= htmlspecialchars($robot['fin_marche_acquisition']) ?>" required>
            
            <label for="cout_acquisition">Coût Acquisition (€)</label>
            <input type="number" step="0.01" id="cout_acquisition" name="cout_acquisition" value="<?= htmlspecialchars($robot['cout_acquisition']) ?>" required>
            
            <label for="num_marche_maintenance">N° Marché Maintenance</label>
            <input type="text" id="num_marche_maintenance" name="num_marche_maintenance" value="<?= htmlspecialchars($robot['num_marche_maintenance']) ?>" required>
            
            <label for="designation_marche_maintenance">Désignation Marché Maintenance</label>
            <input type="text" id="designation_marche_maintenance" name="designation_marche_maintenance" value="<?= htmlspecialchars($robot['designation_marche_maintenance']) ?>" required>
            
            <label for="titulaire_marche_maintenance">Titulaire Marché Maintenance</label>
            <input type="text" id="titulaire_marche_maintenance" name="titulaire_marche_maintenance" value="<?= htmlspecialchars($robot['titulaire_marche_maintenance']) ?>" required>
            
            <label for="debut_marche_maintenance">Date Début Marché Maintenance</label>
            <input type="date" id="debut_marche_maintenance" name="debut_marche_maintenance" value="<?= htmlspecialchars($robot['debut_marche_maintenance']) ?>" required>
            
            <label for="fin_marche_maintenance">Date Fin Marché Maintenance</label>
            <input type="date" id="fin_marche_maintenance" name="fin_marche_maintenance" value="<?= htmlspecialchars($robot['fin_marche_maintenance']) ?>" required>
            
            <label for="cout_maintenance">Coût Maintenance (€)</label>
            <input type="number" step="0.01" id="cout_maintenance" name="cout_maintenance" value="<?= htmlspecialchars($robot['cout_maintenance']) ?>" required>

            <button type="submit">Mettre à jour</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 ONEE BO - Tous droits réservés</p>
    </footer>
</body>
</html>
