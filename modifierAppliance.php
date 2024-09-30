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


    $stmt = $conn->prepare("SELECT * FROM appliances WHERE id = ?");
    $stmt->execute([$id]);
    $appliance = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $Nom = htmlspecialchars($_POST['Nom']);
        $Designation = htmlspecialchars($_POST['Designation']);
        $Localisation = htmlspecialchars($_POST['Localisation']);
        $Adresse_Ip = htmlspecialchars($_POST['Adresse_Ip']);
        $Responsable = htmlspecialchars($_POST['Responsable']);
        $Marque = htmlspecialchars($_POST['Marque']);
        $Modele = htmlspecialchars($_POST['Modele']);
        $Capacite_Disque_Brut = (int)$_POST['Capacite_Disque_Brut'];
        $Capacite_Disque_Utilise = (int)$_POST['Capacite_Disque_Utilise'];
        $Marche_Acquisition_Num = htmlspecialchars($_POST['Marche_Acquisition_Num']);
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


        $update = $conn->prepare("UPDATE appliances SET 
            Nom = ?, 
            Designation = ?, 
            Localisation = ?, 
            Adresse_Ip = ?, 
            Responsable = ?, 
            Marque = ?, 
            Modele = ?, 
            Capacite_Disque_Brut = ?, 
            Capacite_Disque_Utilise = ?, 
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
        
        $update->execute([$Nom, $Designation, $Localisation, $Adresse_Ip, $Responsable, $Marque, $Modele, $Capacite_Disque_Brut, $Capacite_Disque_Utilise, $Marche_Acquisition_Num, $Designation_Marche_Acquisition, $Titulaire_Marche_Acquisition, $Date_Debut_Marche_Acquisition, $Date_Fin_Marche_Acquisition, $Cout_Acquisition, $Marche_Maintenance_num, $Designation_Marche_Maintenance, $Titulaire_Marche_Maintenance, $Date_Debut_Marche_Maintenance, $Date_Fin_Marche_Maintenance, $Cout_Maintenance, $id]);

        $successMsg = "Appliance mise à jour avec succès.";
    }
} else {
    die("Appliance non spécifiée.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Appliance - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("./link.php") ?>
    <main>
        <h2>Modifier une Appliance</h2>
        <?php if (isset($successMsg)) { echo "<p>$successMsg</p>"; } ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($appliance['id']) ?>">
            
            <label for="Nom">Nom :</label>
            <input type="text" id="Nom" name="Nom" value="<?= htmlspecialchars($appliance['Nom']) ?>" required>

            <label for="Designation">Désignation :</label>
            <input type="text" id="Designation" name="Designation" value="<?= htmlspecialchars($appliance['Designation']) ?>" required>

            <label for="Localisation">Localisation :</label>
            <select id="Localisation" name="Localisation">
                <option value="Datacenter" <?= ($appliance['Localisation'] == 'Datacenter') ? 'selected' : ''; ?>>Datacenter</option>
                <option value="Backup" <?= ($appliance['Localisation'] == 'Backup') ? 'selected' : ''; ?>>Backup</option>
            </select>

            <label for="Adresse_IP">Adresse IP :</label>
            <input type="text" id="Adresse_Ip" name="Adresse_Ip" value="<?= htmlspecialchars($appliance['Adresse_Ip']) ?>" placeholder="Adresse IP">

            <label for="Responsable">Responsable :</label>
            <select id="Responsable" name="Responsable">
                <option value="DSI/AA" <?= ($appliance['Responsable'] == 'DSI/AA') ? 'selected' : ''; ?>>DSI/AA</option>
                <option value="DSI/AB" <?= ($appliance['Responsable'] == 'DSI/AB') ? 'selected' : ''; ?>>DSI/AB</option>
                <option value="DSI/R" <?= ($appliance['Responsable'] == 'DSI/R') ? 'selected' : ''; ?>>DSI/R</option>
                <option value="DSI/P" <?= ($appliance['Responsable'] == 'DSI/P') ? 'selected' : ''; ?>>DSI/P</option>
            </select>

            <label for="Marque">Marque :</label>
            <select id="Marque" name="Marque">
                <option value="DELL" <?= ($appliance['Marque'] == 'DELL') ? 'selected' : ''; ?>>DELL</option>
                <option value="VERITAS" <?= ($appliance['Marque'] == 'VERITAS') ? 'selected' : ''; ?>>VERITAS</option>
            </select>

            <label for="Modele">Modèle :</label>
            <input type="text" id="Modele" name="Modele" value="<?= htmlspecialchars($appliance['Modele']) ?>" placeholder="Modèle">

            <label for="Capacite_Disque_Brut">Capacité disque brut (Go) :</label>
            <input type="number" id="Capacite_Disque_Brut" name="Capacite_Disque_Brut" value="<?= htmlspecialchars($appliance['Capacite_Disque_Brut']) ?>" placeholder="Capacité disque brut">

            <label for="Capacite_Disque_Utilise">Capacité disque utilisé (Go) :</label>
            <input type="number" id="Capacite_Disque_Utilise" name="Capacite_Disque_Utilise" value="<?= htmlspecialchars($appliance['Capacite_Disque_Utilise']) ?>" placeholder="Capacité disque utilisé">

            <fieldset>
                <legend>Marché d'Acquisition</legend>
                <label for="Marche_Acquisition_Num">N° marché acquisition :</label>
                <input type="text" id="Marche_Acquisition_Num" name="Marche_Acquisition_Num" value="<?= htmlspecialchars($appliance['Marche_Acquisition_Num']) ?>" placeholder="N° marché acquisition">

                <label for="Designation_Marche_Acquisition">Désignation marché acquisition :</label>
                <input type="text" id="Designation_Marche_Acquisition" name="Designation_Marche_Acquisition" value="<?= htmlspecialchars($appliance['Designation_Marche_Acquisition']) ?>" placeholder="Désignation marché acquisition">

                <label for="Titulaire_Marche_Acquisition">Titulaire marché acquisition :</label>
                <input type="text" id="Titulaire_Marche_Acquisition" name="Titulaire_Marche_Acquisition" value="<?= htmlspecialchars($appliance['Titulaire_Marche_Acquisition']) ?>" placeholder="Titulaire marché acquisition">

                <label for="Date_Debut_Marche_Acquisition">Date de début :</label>
                <input type="date" id="Date_Debut_Marche_Acquisition" name="Date_Debut_Marche_Acquisition" value="<?= htmlspecialchars($appliance['Date_Debut_Marche_Acquisition']) ?>">

                <label for="Date_Fin_Marche_Acquisition">Date de fin :</label>
                <input type="date" id="Date_Fin_Marche_Acquisition" name="Date_Fin_Marche_Acquisition" value="<?= htmlspecialchars($appliance['Date_Fin_Marche_Acquisition']) ?>">

                <label for="Cout_Acquisition">Coût d'acquisition :</label>
                <input type="number" id="Cout_Acquisition" name="Cout_Acquisition" value="<?= htmlspecialchars($appliance['Cout_Acquisition']) ?>" placeholder="Cout d'acquisition">
            </fieldset>

            <fieldset>
                <legend>Marché de Maintenance</legend>
                <label for="Marche_Maintenance_Num">N° marché maintenance :</label>
                <input type="text" id="Marche_Maintenance_Num" name="Marche_Maintenance_Num" value="<?= htmlspecialchars($appliance['Marche_Maintenance_Num']) ?>" placeholder="N° marché maintenance">

                <label for="Designation_Marche_Maintenance">Désignation marché maintenance :</label>
                <input type="text" id="Designation_Marche_Maintenance" name="Designation_Marche_Maintenance" value="<?= htmlspecialchars($appliance['Designation_Marche_Maintenance']) ?>" placeholder="Désignation marché maintenance">

                <label for="Titulaire_Marche_Maintenance">Titulaire marché maintenance :</label>
                <input type="text" id="Titulaire_Marche_Maintenance" name="Titulaire_Marche_Maintenance" value="<?= htmlspecialchars($appliance['Titulaire_Marche_Maintenance']) ?>" placeholder="Titulaire marché maintenance">

                <label for="Date_Debut_Marche_Maintenance">Date de début :</label>
                <input type="date" id="Date_Debut_Marche_Maintenance" name="Date_Debut_Marche_Maintenance" value="<?= htmlspecialchars($appliance['Date_Debut_Marche_Maintenance']) ?>">

                <label for="Date_Fin_Marche_Maintenance">Date de fin :</label>
                <input type="date" id="Date_Fin_Marche_Maintenance" name="Date_Fin_Marche_Maintenance" value="<?= htmlspecialchars($appliance['Date_Fin_Marche_Maintenance']) ?>">

                <label for="Cout_Maintenance">Coût de maintenance :</label>
                <input type="number" id="Cout_Maintenance" name="Cout_Maintenance" value="<?= htmlspecialchars($appliance['Cout_Maintenance']) ?>" placeholder="Cout de maintenance">
            </fieldset>

            <button type="submit">Mettre à jour</button>
        </form>
    </main>
</body>
</html>
