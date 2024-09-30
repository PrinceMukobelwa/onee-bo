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


    $stmt = $conn->prepare("SELECT * FROM baie WHERE id = ?");
    $stmt->execute([$id]);
    $baie = $stmt->fetch();


    if (!$baie) {
        die("Baie non trouvée.");
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $Nom = $_POST['Nom'];
        $Designation = $_POST['Designation'];
        $Localisation = $_POST['Localisation'];
        $Adresse_Ip = $_POST['Adresse_Ip'];
        $Responsable = $_POST['Responsable'];
        $capacite_disque_ssd_Brut = $_POST['capacité_disque_ssd_brut'];
        $capacite_disque_ssd_utilise = $_POST['capacité_disque_ssd_utilisé'];
        $capacite_disque_sas_brut = $_POST['capacité_disque_sas_brut'];
        $capacite_disque_sas_utilise = $_POST['capacité_disque_sas_utilisé'];
        $capacite_disque_sata_brut = $_POST['capacité_disque_sata_brut'];
        $capacite_disque_sata_utilise = $_POST['capacité_disque_sata_utilisé'];
        $Marché_Acquisition_Num = $_POST['Marché_Acquisition_Num'];
        $Designation_Marché_Acquisition = $_POST['Designation_Marché_Acquisition'];
        $Titulaire_Marché_Acquisition = $_POST['Titulaire_Marché_Acquisition'];
        $Date_Debut_Marché_Acquisition = $_POST['Date_Debut_Marché_Acquisition'];
        $Date_Fin_Marché_Acquisition = $_POST['Date_Fin_Marché_Acquisition'];
        $Cout_Acquisition = $_POST['Cout_Acquisition'];
        $Marché_Maintenance_Num = $_POST['Marché_Maintenance_Num'];
        $Designation_Marché_Maintenance = $_POST['Designation_Marché_Maintenance'];
        $Titulaire_Marché_Maintenance = $_POST['Titulaire_Marché_Maintenance'];
        $Date_Debut_Marché_Maintenance = $_POST['Date_Debut_Marché_Maintenance'];
        $Date_Fin_Marché_Maintenance = $_POST['Date_Fin_Marché_Maintenance'];

        
        $update = $conn->prepare("UPDATE baie SET 
            Nom = ?, 
            Designation = ?, 
            Localisation = ?, 
            Adresse_Ip = ?, 
            Responsable = ?, 
            capacité_disque_ssd_brut = ?, 
            capacité_disque_ssd_utilisé = ?, 
            capacité_disque_sas_brut = ?, 
            capacité_disque_sas_utilisé = ?, 
            capacité_disque_sata_brut = ?, 
            capacité_disque_sata_utilisé = ?, 
            Marché_Acquisition_Num = ?, 
            Designation_Marché_Acquisition = ?, 
            Titulaire_Marché_Acquisition = ?, 
            Date_Debut_Marché_Acquisition = ?, 
            Date_Fin_Marché_Acquisition = ?, 
            Cout_Acquisition = ?, 
            Marché_Maintenance_Num = ?, 
            Designation_Marché_Maintenance = ?, 
            Titulaire_Marché_Maintenance = ?, 
            Date_Debut_Marché_Maintenance = ?, 
            Date_Fin_Marché_Maintenance = ? 
            WHERE id = ?");
        
        $update->execute([$Nom, $Designation, $Localisation, $Adresse_Ip, $Responsable, $capacité_disque_ssd_brut, $capacité_disque_ssd_utilisé, $capacité_disque_sas_brut, $capacité_disque_sas_utilisé, $capacité_disque_sata_brut, $capacité_disque_sata_utilise, $Marché_Acquisition_Num, $Designation_Marché_Acquisition, $Titulaire_Marché_Acquisition, $Date_Debut_Marché_Acquisition, $Date_Fin_Marché_Acquisition, $Cout_Acquisition, $Marché_Maintenance_Num, $Designation_Marché_Maintenance, $Titulaire_Marché_Maintenance, $Date_Debut_Marché_Maintenance, $Date_Fin_Marché_Maintenance, $id]);

        $succesMsg = "Baie mise à jour avec succès.";
    }
} else {
    die("ID non spécifié.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Baie - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("./link.php") ?>

    <main>
        <h1>Modifier Baie de Stockage</h1>
        <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
        <form method="POST">
            <label for="Nom">Nom :</label>
            <input type="text" name="Nom" value="<?= htmlspecialchars($baie['Nom']) ?>" required>

            <label for="Designation">Désignation :</label>
            <input type="text" name="Designation" value="<?= htmlspecialchars($baie['Designation']) ?>" required>

            <label for="Localisation">Localisation :</label>
            <input type="text" name="Localisation" value="<?= htmlspecialchars($baie['Localisation']) ?>" required>

            <label for="Adresse_Ip">Adresse IP :</label>
            <input type="text" name="Adresse_Ip" value="<?= htmlspecialchars($baie['Adresse_Ip']) ?>" required>

            <label for="Responsable">Responsable :</label>
            <input type="text" name="Responsable" value="<?= htmlspecialchars($baie['Responsable']) ?>" required>

            <label for="capacité_disque_ssd_brut">Capacité Disque SSD Brut :</label>
            <input type="number" name="capacité_disque_ssd_brut" value="<?= htmlspecialchars($baie['capacité_disque_ssd_brut']) ?>" required>

            <label for="capacité_disque_ssd_utilisé">Capacité Disque SSD Utilisé :</label>
            <input type="number" name="capacité_disque_ssd_utilisé" value="<?= htmlspecialchars($baie['capacité_disque_ssd_utilisé']) ?>" required>

            <label for="capacité_disque_sas_brut">Capacité Disque SAS Brut :</label>
            <input type="number" name="capacité_disque_sas_brut" value="<?= htmlspecialchars($baie['capacité_disque_sas_brut']) ?>" required>

            <label for="capacité_disque_sas_utilisé">Capacité Disque SAS Utilisé :</label>
            <input type="number" name="capacité_disque_sas_utilisé" value="<?= htmlspecialchars($baie['capacité_disque_sas_utilisé']) ?>" required>

            <label for="capacité_disque_sata_brut">Capacité Disque SATA Brut :</label>
            <input type="number" name="capacité_disque_sata_brut" value="<?= htmlspecialchars($baie['capacité_disque_sata_brut']) ?>" required>

            <label for="capacité_disque_sata_utilisé">Capacité Disque SATA Utilisé :</label>
            <input type="number" name="capacité_disque_sata_utilisé" value="<?= htmlspecialchars($baie['capacité_disque_sata_utilisé']) ?>" required>

            <label for="Marché_Acquisition_Num">Numéro Marché Acquisition :</label>
            <input type="text" name="Marché_Acquisition_Num" value="<?= htmlspecialchars($baie['Marché_Acquisition_Num']) ?>" required>

            <label for="Designation_Marché_Acquisition">Désignation Marché Acquisition :</label>
            <input type="text" name="Designation_Marché_Acquisition" value="<?= htmlspecialchars($baie['Designation_Marché_Acquisition']) ?>" required>

            <label for="Titulaire_Marché_Acquisition">Titulaire Marché Acquisition :</label>
            <input type="text" name="Titulaire_Marché_Acquisition" value="<?= htmlspecialchars($baie['Titulaire_Marché_Acquisition']) ?>" required>

            <label for="Date_Debut_Marché_Acquisition">Date Début Marché Acquisition :</label>
            <input type="date" name="Date_Debut_Marché_Acquisition" value="<?= htmlspecialchars($baie['Date_Debut_Marché_Acquisition']) ?>" required>

            <label for="Date_Fin_Marché_Acquisition">Date Fin Marché Acquisition :</label>
            <input type="date" name="Date_Fin_Marché_Acquisition" value="<?= htmlspecialchars($baie['Date_Fin_Marché_Acquisition']) ?>" required>

            <label for="Cout_Acquisition">Coût Acquisition :</label>
            <input type="number" name="Cout_Acquisition" value="<?= htmlspecialchars($baie['Cout_Acquisition']) ?>" required>

            <label for="Marché_Maintenance_Num">Numéro Marché Maintenance :</label>
            <input type="text" name="Marché_Maintenance_Num" value="<?= htmlspecialchars($baie['Marché_Maintenance_Num']) ?>" required>

            <label for="Designation_Marché_Maintenance">Désignation Marché Maintenance :</label>
            <input type="text" name="Designation_Marché_Maintenance" value="<?= htmlspecialchars($baie['Designation_Marché_Maintenance']) ?>" required>

            <label for="Titulaire_Marché_Maintenance">Titulaire Marché Maintenance :</label>
            <input type="text" name="Titulaire_Marché_Maintenance" value="<?= htmlspecialchars($baie['Titulaire_Marché_Maintenance']) ?>" required>

            <label for="Date_Debut_Marché_Maintenance">Date Début Marché Maintenance :</label>
            <input type="date" name="Date_Debut_Marché_Maintenance" value="<?= htmlspecialchars($baie['Date_Debut_Marché_Maintenance']) ?>" required>

            <label for="Date_Fin_Marché_Maintenance">Date Fin Marché Maintenance :</label>
            <input type="date" name="Date_Fin_Marché_Maintenance" value="<?= htmlspecialchars($baie['Date_Fin_Marché_Maintenance']) ?>" required>

            <button type="submit">Mettre à jour</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 ONEE BO - Tous droits réservés</p>
    </footer>
</body>
</html>
