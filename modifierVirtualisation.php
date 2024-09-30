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
    

    $stmt = $conn->prepare("SELECT * FROM virtualisation WHERE id = ?");
    $stmt->execute([$id]);
    $virtualisation = $stmt->fetch();

    if (!$virtualisation) {
        die("Virtualisation non trouvée.");
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Nom = $_POST['Nom'];
    $Designation = $_POST['Designation'];
    $Adresse_Ip = $_POST['Adresse_Ip'];
    $Localisation = $_POST['Localisation'];
    $Responsable = $_POST['Responsable'];
    $Marque = $_POST['Marque'];
    $Modele = $_POST['Modele'];
    $Marche_Acquisition_Num = $_POST['Marche_Acquisition_Num'];
    $Designation_Marche_Acquisition = $_POST['Designation_Marche_Acquisition'];
    $Titulaire_Marche_Acquisition = $_POST['Titulaire_Marche_Acquisition'];
    $Date_Debut_Marche_Acquisition = $_POST['Date_Debut_Marche_Acquisition'];
    $Date_fin_Marche_Acquisition = $_POST['Date_Fin_Marche_Acquisition'];
    $Cout_Acquisition = $_POST['Cout_Acquisition'];
    $Marche_Maintenance_num = $_POST['Marche_Maintenance_Num'];
    $Designation_Marche_Maintenance = $_POST['Designation_Marche_Maintenance'];
    $Titulaire_Marche_Maintenance = $_POST['Titulaire_Marche_Maintenance'];
    $Date_Debut_Marche_Maintenance = $_POST['Date_Debut_Marche_Maintenance'];
    $Date_Fin_Marche_Maintenance = $_POST['Date_Fin_Marche_Maintenance'];
    $Cout_Maintenance = $_POST['Cout_Maintenance'];

   
    $stmt = $conn->prepare("UPDATE virtualisation SET Nom = ?, Designation = ?, Adresse_Ip = ?, Localisation = ?, Responsable = ?, Marque = ?, Modele = ?, Marche_Acquisition_Num = ?, Designation_Marche_Acquisition = ?, Titulaire_Marche_Acquisition = ?, Date_Debut_Marche_Acquisition = ?, Date_Fin_Marche_Acquisition = ?, Cout_Acquisition = ?, Marche_Maintenance_Num = ?, Designation_Marche_Maintenance = ?, Titulaire_Marche_Maintenance = ?, Date_Debut_Marche_Maintenance = ?, Date_Fin_Marche_Maintenance = ?, Cout_Maintenance = ? WHERE id = ?");
    $stmt->execute([
        $Nom, $Designation, $Adresse_Ip, $Localisation, $Responsable, $Marque, $Modele, 
        $Marche_Acquisition_Num, $Designation_Marche_Acquisition, $Titulaire_Marche_Acquisition, 
        $Date_Debut_Marche_Acquisition, $Date_Fin_Marche_Acquisition, $Cout_Acquisition,
        $Marche_Maintenance_Num, $Designation_Marche_Maintenance, $Titulaire_Marche_Maintenance,
        $Date_Debut_Marche_Maintenance, $Date_Fin_Marche_Maintenance, $Cout_Maintenance, $id
    ]);

    $succesMsg = "Virtualisation mise à jour avec succès.";
    header("Location: listeVirtualisation.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Virtualisation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("./link.php") ?>

    <main>
        <h1>Modifier la virtualisation</h1>
        <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
        
        <form method="post">
            <label for="Nom">Nom :</label>
            <input type="text" name="Nom" id="Nom" value="<?= htmlspecialchars($virtualisation['Nom']) ?>" required>

            <label for="Designation">Désignation :</label>
            <input type="text" name="Designation" id="Designation" value="<?= htmlspecialchars($virtualisation['Designation']) ?>" required>

            <label for="Adresse_Ip">Adresse IP :</label>
            <input type="text" name="Adresse_Ip" id="Adresse_Ip" value="<?= htmlspecialchars($virtualisation['Adresse_Ip']) ?>" required>

            <label for="Localisation">Localisation :</label>
            <input type="text" name="Localisation" id="Localisation" value="<?= htmlspecialchars($virtualisation['Localisation']) ?>" required>

            <label for="Responsable">Responsable :</label>
            <input type="text" name="Responsable" id="Responsable" value="<?= htmlspecialchars($virtualisation['Responsable']) ?>" required>

            <label for="Marque">Marque :</label>
            <input type="text" name="Marque" id="Marque" value="<?= htmlspecialchars($virtualisation['Marque']) ?>" required>

            <label for="Modele">Modèle :</label>
            <input type="text" name="Modele" id="Modele" value="<?= htmlspecialchars($virtualisation['Modele']) ?>" required>

            <label for="Marche_Acquisition_Num">Numéro Marché Acquisition :</label>
            <input type="text" name="Marche_Acquisition_Num" id="Marche_Acquisition_Num" value="<?= htmlspecialchars($virtualisation['Marche_Acquisition_Num']) ?>" required>

            <label for="Designation_Marche_Acquisition">Désignation Marché Acquisition :</label>
            <input type="text" name="Designation_Marche_Acquisition" id="Designation_Marche_Acquisition" value="<?= htmlspecialchars($virtualisation['Designation_Marche_Acquisition']) ?>" required>

            <label for="Titulaire_Marche_Acquisition">Titulaire Marché Acquisition :</label>
            <input type="text" name="Titulaire_Marche_Acquisition" id="Titulaire_Marche_Acquisition" value="<?= htmlspecialchars($virtualisation['Titulaire_Marche_Acquisition']) ?>" required>

            <label for="Date_Debut_Marche_Acquisition">Date Début Marché Acquisition :</label>
            <input type="date" name="Date_Debut_Marche_Acquisition" id="Date_Debut_Marche_Acquisition" value="<?= htmlspecialchars($virtualisation['Date_Debut_Marche_Acquisition']) ?>" required>

            <label for="Date_Fin_Marche_Acquisition">Date Fin Marché Acquisition :</label>
            <input type="date" name="Date_Fin_Marche_Acquisition" id="Date_Fin_Marche_Acquisition" value="<?= htmlspecialchars($virtualisation['Date_Fin_Marche_Acquisition']) ?>" required>

            <label for="Cout_Acquisition">Coût Acquisition :</label>
            <input type="number" name="Cout_Acquisition" id="Cout_Acquisition" value="<?= htmlspecialchars($virtualisation['Cout_Acquisition']) ?>" required>

            <label for="Marche_Maintenance_Num">Numéro Marché Maintenance :</label>
            <input type="text" name="Marche_Maintenance_Num" id="Marche_Maintenance_Num" value="<?= htmlspecialchars($virtualisation['Marche_Maintenance_Num']) ?>" required>

            <label for="Designation_Marche_Maintenance">Désignation Marché Maintenance :</label>
            <input type="text" name="Designation_Marche_Maintenance" id="Designation_Marche_Maintenance" value="<?= htmlspecialchars($virtualisation['Designation_Marche_Maintenance']) ?>" required>

            <label for="Titulaire_Marche_Maintenance">Titulaire Marché Maintenance :</label>
            <input type="text" name="Titulaire_Marche_Maintenance" id="Titulaire_Marche_Maintenance" value="<?= htmlspecialchars($virtualisation['Titulaire_Marche_Maintenance']) ?>" required>

            <label for="Date_Debut_Marche_Maintenance">Date Début Marché Maintenance :</label>
            <input type="date" name="Date_Debut_Marche_Maintenance" id="Date_Debut_Marche_Maintenance" value="<?= htmlspecialchars($virtualisation['Date_Debut_Marche_Maintenance']) ?>" required>

            <label for="Date_Fin_Marche_Maintenance">Date Fin Marché Maintenance :</label>
            <input type="date" name="Date_Fin_Marche_Maintenance" id="Date_Fin_Marche_Maintenance" value="<?= htmlspecialchars($virtualisation['Date_Fin_Marche_Maintenance']) ?>" required>

            <label for="Cout_Maintenance">Coût Maintenance :</label>
            <input type="number" name="Cout_Maintenance" id="Cout_Maintenance" value="<?= htmlspecialchars($virtualisation['Cout_Maintenance']) ?>" required>

            <button type="submit">Mettre à jour</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 ONEE BO - Tous droits réservés</p>
    </footer>
</body>
</html>