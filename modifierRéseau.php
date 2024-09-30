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
   
    $stmt = $conn->prepare("SELECT * FROM réseau WHERE id = ?");
    $stmt->execute([$id]);
    $reseau = $stmt->fetch(PDO::FETCH_ASSOC);

   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $Nom = htmlspecialchars($_POST['Nom']);
        $Designation = htmlspecialchars($_POST['Designation']);
        $Adresse_Ip = isset($_POST['Adresse_Ip']) ? htmlspecialchars($_POST['Adresse_Ip']) : '';
        $Localisation = htmlspecialchars($_POST['Localisation']);
        $Responsable = htmlspecialchars($_POST['Responsable']);
        $Marque = htmlspecialchars($_POST['Marque']);
        $Modele = htmlspecialchars($_POST['Modele']);
        $Nombre_Ports_Totaux = (int)$_POST['Nombre_Ports_Totaux'];
        $Nombre_Ports_Utilises = (int)$_POST['Nombre_Ports_Utilises'];
        $Marche_Acquisition_Num = htmlspecialchars($_POST['Marche_Acquisition_num']);
        $Designation_Marche_Acquisition = htmlspecialchars($_POST['Designation_Marche_Acquisition']);
        $Titulaire_Marche_Acquisition = htmlspecialchars($_POST['Titulaire_Marche_Acquisition']);
        $Date_Debut_Marche_Acquisition = $_POST['Date_Debut_Marche_Acquisition'];
        $Date_Fin_Marche_Acquisition = $_POST['Date_Fin_Marche_Acquisition'];
        $Cout_Acquisition = (float)$_POST['Cout_Acquisition'];
        $Marche_Maintenance_Num = htmlspecialchars($_POST['Marche_Maintenance_Num']);
        $Designation_Marche_Maintenance = htmlspecialchars($_POST['Designation_Marche_Maintenance']);
        $Titulaire_Marche_Maintenance = htmlspecialchars($_POST['Titulaire_Marche_Maintenance']);
        $Date_Debut_Marche_Maintenance = $_POST['Date_Debut_Marche_Maintenance'];
        $Date_Fin_Marche_Maintenance = $_POST['Date_Fin_Marche_Maintenance'];
        $Cout_Maintenance = (float)$_POST['Cout_Maintenance'];

       
        $update = $conn->prepare("UPDATE réseau SET 
            Nom = ?, 
            Designation = ?, 
            Adresse_Ip = ?, 
            Localisation = ?, 
            Responsable = ?, 
            Marque = ?, 
            Modele = ?, 
            Nombre_Ports_Totaux = ?, 
            Nombre_Ports_Utilises = ?, 
            Marche_Acquisition_Num = ?, 
            Designation_Marche_Acquisition = ?, 
            Titulaire_Marche_Acquisition = ?, 
            Date_Debut_Marche_Acquisition = ?, 
            Date_Fin_Marche_Acquisition = ?, 
            Cout_Acquisition = ?, 
            Marche_Maintenance_Num = ?, 
            Designation_Marche_Maintenance = ?, 
            Titulaire_Marche_Maintenance = ?, 
            Date_Debut_Marche_Maintenance = ?, 
            Date_Fin_Marche_Maintenance = ?, 
            Cout_Maintenance = ? 
            WHERE id = ?");
        
        $update->execute([$Nom, $Designation, $Adresse_Ip, $Localisation, $Responsable, $Marque, $Modele, 
            $Nombre_Ports_Totaux, $Nombre_Ports_Utilises, $Marche_Acquisition_Num, $Designation_Marche_Acquisition, 
            $Titulaire_Marche_Acquisition, $Date_Debut_Marche_Acquisition, $Date_Fin_Marche_Acquisition, 
            $Cout_Acquisition, $Marche_Maintenance_Num, $Designation_Marche_Maintenance, 
            $Titulaire_Marche_Maintenance, $Date_Debut_Marche_Maintenance, $Date_Fin_Marche_Maintenance, 
            $Cout_Maintenance, $id]);

        $succesMsg = "Réseau modifié avec succès.";
    }
} else {
    die("ID de réseau non spécifié.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Réseau - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("./link.php") ?>

    <main>
        <h1>Modifier Réseau</h1>
        <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
        <form method="post">
            <label for="Nom">Nom:</label>
            <input type="text" name="Nom" value="<?= htmlspecialchars($reseau['Nom']) ?>" required>
            
            <label for="Designation">Désignation:</label>
            <input type="text" name="Designation" value="<?= htmlspecialchars($reseau['Designation']) ?>" required>
            
            <label for="Adresse_Ip">Adresse IP:</label>
            <input type="text" name="Adresse_Ip" value="<?= htmlspecialchars($reseau['Adresse_Ip']) ?>" required>
            
            <label for="Localisation">Localisation:</label>
            <input type="text" name="Localisation" value="<?= htmlspecialchars($reseau['Localisation']) ?>" required>
            
            <label for="Responsable">Responsable:</label>
            <input type="text" name="Responsable" value="<?= htmlspecialchars($reseau['Responsable']) ?>" required>
            
            <label for="Marque">Marque:</label>
            <input type="text" name="Marque" value="<?= htmlspecialchars($reseau['Marque']) ?>" required>
            
            <label for="Modele">Modèle:</label>
            <input type="text" name="Modele" value="<?= htmlspecialchars($reseau['Modele']) ?>" required>
            
            <label for="Nombre_Ports_Totaux">Nombre de Ports Totaux:</label>
            <input type="number" name="Nombre_Ports_Totaux" value="<?= htmlspecialchars($reseau['Nombre_Ports_Totaux']) ?>" required>
            
            <label for="Nombre_Ports_Utilises">Nombre de Ports Utilisés:</label>
            <input type="number" name="Nombre_Ports_Utilises" value="<?= htmlspecialchars($reseau['Nombre_Ports_Utilises']) ?>" required>
            
            <label for="Marche_Acquisition_Num">Numéro Marché Acquisition:</label>
            <input type="text" name="Marche_Acquisition_num" value="<?= htmlspecialchars($reseau['Marche_Acquisition_Num']) ?>" required>
            
            <label for="Designation_Marche_Acquisition">Désignation Marché Acquisition:</label>
            <input type="text" name="Designation_Marche_Acquisition" value="<?= htmlspecialchars($reseau['Designation_Marche_Acquisition']) ?>" required>
            
            <label for="Titulaire_Marche_Acquisition">Titulaire Marché Acquisition:</label>
            <input type="text" name="Titulaire_Marche_Acquisition" value="<?= htmlspecialchars($reseau['Titulaire_Marche_Acquisition']) ?>" required>
            
            <label for="Date_Debut_Marche_Acquisition">Date Début Marché Acquisition:</label>
            <input type="date" name="Date_Debut_Marche_Acquisition" value="<?= htmlspecialchars($reseau['Date_Debut_Marche_Acquisition']) ?>" required>
            
            <label for="Date_Fin_Marche_Acquisition">Date Fin Marché Acquisition:</label>
            <input type="date" name="Date_Fin_Marche_Acquisition" value="<?= htmlspecialchars($reseau['Date_Fin_Marche_Acquisition']) ?>" required>
            
            <label for="Cout_Acquisition">Coût Acquisition:</label>
            <input type="number" name="Cout_Acquisition" value="<?= htmlspecialchars($reseau['Cout_Acquisition']) ?>" step="0.01" required>
            
            <label for="Marche_Maintenance_num">Numéro Marché Maintenance:</label>
            <input type="text" name="Marche_Maintenance_Num" value="<?= htmlspecialchars($reseau['Marche_Maintenance_Num']) ?>" required>
            
            <label for="Designation_Marche_Maintenance">Désignation Marché Maintenance:</label>
            <input type="text" name="Designation_Marche_Maintenance" value="<?= htmlspecialchars($reseau['Designation_Marche_Maintenance']) ?>" required>
            
            <label for="Titulaire_Marche_Maintenance">Titulaire Marché Maintenance:</label>
            <input type="text" name="Titulaire_Marche_Maintenance" value="<?= htmlspecialchars($reseau['Titulaire_Marche_Maintenance']) ?>" required>
            
            <label for="Date_Debut_Marche_Maintenance">Date Début Marché Maintenance:</label>
            <input type="date" name="Date_Debut_Marche_Maintenance" value="<?= htmlspecialchars($reseau['Date_Debut_Marche_Maintenance']) ?>" required>
            
            <label for="Date_Fin_Marche_Maintenance">Date Fin Marché Maintenance:</label>
            <input type="date" name="Date_Fin_Marche_Maintenance" value="<?= htmlspecialchars($reseau['Date_Fin_Marche_Maintenance']) ?>" required>
            
            <label for="Cout_Maintenance">Coût Maintenance:</label>
            <input type="number" name="Cout_Maintenance" value="<?= htmlspecialchars($reseau['Cout_Maintenance']) ?>" step="0.01" required>

            <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit">Mettre à jour</button>
        </form>
    </main>
</body>
</html>
