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


    $stmt = $conn->prepare("SELECT * FROM serveur WHERE id = ?");
    $stmt->execute([$id]);
    $serveur = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $Nom_Machine = htmlspecialchars($_POST['Nom_Machine']);
        $Designation = htmlspecialchars($_POST['Designation']);
        $Localisation = htmlspecialchars($_POST['Localisation']);
        $Position = htmlspecialchars($_POST['Position']);
        $Type = htmlspecialchars($_POST['Type']);
        $Categorie = htmlspecialchars($_POST['Categorie']);
        $Adresse_Ip = htmlspecialchars($_POST['Adresse_Ip']);
        $Responsable = htmlspecialchars($_POST['Responsable']);
        $Direction_Metier = htmlspecialchars($_POST['Direction_Metier']);
        $Marque = htmlspecialchars($_POST['Marque']);
        $Modele = htmlspecialchars($_POST['Modele']);
        $CPU= htmlspecialchars($_POST['CPU']);
        $RAM = (int)$_POST['RAM'];
        $Capacite_Disque = htmlspecialchars($_POST['Capacite_Disque']);
        $Systeme_Exploitation = htmlspecialchars($_POST['Systeme_Exploitation']);
        $Langue = htmlspecialchars($_POST['Langue']);
        $Marché_Acquisition_Num = htmlspecialchars($_POST['Marché_Acquisition_Num']);
        $Designation_Marché_Acquisition = htmlspecialchars($_POST['Designation_Marché_Acquisition']);
        $Titulaire_Marché_Acquisition = htmlspecialchars($_POST['Titulaire_Marché_Acquisition']);
        $Date_Debut_Marché_Acquisition = htmlspecialchars($_POST['Date_Debut_Marché_Acquisition']);
        $Date_Fin_Marché_Acquisition = htmlspecialchars($_POST['Date_Fin_Marché_Acquisition']);
        $Cout_Acquisition = (float)$_POST['Cout_Acquisition'];
        $Marché_Maintenance_Num = htmlspecialchars($_POST['Marché_Maintenance_Num']);
        $Designation_Marché_Maintenance = htmlspecialchars($_POST['Designation_Marché_Maintenance']);
        $Titulaire_Marché_Maintenance = htmlspecialchars($_POST['Titulaire_Marché_Maintenance']);
        $Date_Debut_Marché_Maintenance = htmlspecialchars($_POST['Date_Debut_Marché_Maintenance']);
        $Date_Fin_Marché_Maintenance = htmlspecialchars($_POST['Date_Fin_Marché_Maintenance']);
        
    
        $update = $conn->prepare("
            UPDATE serveur SET 
            Nom_Machine = ?, Designation = ?, Localisation = ?, Position = ?, Type = ?, Categorie = ?, Adresse_Ip = ?, 
            Responsable = ?, Direction_Metier = ?, Marque = ?, Modele = ?, CPU = ?, RAM = ?, Capacite_Disque = ?, 
            Systeme_Exploitation = ?, Langue = ?, Marché_Acquisition_Num = ?, Designation_Marché_Acquisition = ?, 
            Titulaire_Marché_Acquisition = ?, Date_Debut_Marché_Acquisition = ?, Date_Fin_Marché_Acquisition = ?, Cout_Acquisition = ?, 
            Marché_Maintenance_Num = ?, Designation_Marché_Maintenance = ?, Titulaire_Marché_Maintenance = ?, 
            Date_Debut_Marché_Maintenance = ?, Date_Fin_Marché_Maintenance = ? WHERE id = ?");
        
        $update->execute([
            $Nom_Machine, $Designation, $Localisation, $Position, $Type, $Categorie, $Adresse_Ip, $Responsable, 
            $Direction_Metier, $Marque, $Modele, $CPU, $RAM, $Capacite_Disque, $Systeme_Exploitation, $Langue, 
            $Marche_Acquisition_Num, $Designation_marche_Acquisition, $Titulaire_Marché_Acquisition, $Date_Debut_Marché_Acquisition, 
            $Date_Fin_Marché_Acquisition, $Cout_Acquisition, $Marché_Maintenance_Num, $Designation_Marché_Maintenance, 
            $Titulaire_Marché_Maintenance, $Date_Debut_Marché_Maintenance, $Date_Fin_Marché_Maintenance, $id
        ]);

        $succesMsg = "Serveur modifié avec succès";
    }
} else {
    die("Serveur non spécifié.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Serveur - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include("./link.php")?>
<main>
    <h2>Modifier un Serveur</h2>
    
    <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $serveur['id'] ?>">

        <label for="Nom_machine">Nom Machine</label>
        <input type="text" id="Nom_Machine" name="Nom_Machine" value="<?= htmlspecialchars($serveur['Nom_machine']) ?>" required>

        <label for="Designation">Désignation</label>
        <input type="text" id="Designation" name="Designation" value="<?= htmlspecialchars($serveur['Designation']) ?>" required>

        <label for="Localisation">Localisation</label>
        <input type="text" id="Localisation" name="Localisation" value="<?= htmlspecialchars($serveur['Localisation']) ?>" required>

        <label for="Position">Position</label>
        <input type="text" id="Position" name="Position" value="<?= htmlspecialchars($serveur['Position']) ?>" required>

        <label for="Type">Type</label>
        <input type="text" id="Type" name="Type" value="<?= htmlspecialchars($serveur['Type']) ?>" required>

        <label for="Categorie">Catégorie</label>
        <input type="text" id="Categorie" name="Categorie" value="<?= htmlspecialchars($serveur['Categorie']) ?>" required>

        <label for="Adresse_Ip">Adresse IP</label>
        <input type="text" id="Adresse_Ip" name="adresse_Ip" value="<?= htmlspecialchars($serveur['Adresse_Ip']) ?>" required>

        <label for="Responsable">Responsable</label>
        <input type="text" id="Responsable" name="Responsable" value="<?= htmlspecialchars($serveur['Responsable']) ?>" required>

        <label for="Direction_Metier">Direction Métier</label>
        <input type="text" id="Direction_Metier" name="Direction_Metier" value="<?= htmlspecialchars($serveur['Direction_Metier']) ?>" required>

        <label for="Marque">Marque</label>
        <input type="text" id="Marque" name="Marque" value="<?= htmlspecialchars($serveur['Marque']) ?>" required>

        <label for="Modele">Modèle</label>
        <input type="text" id="Modele" name="Modele" value="<?= htmlspecialchars($serveur['Modele']) ?>" required>

        <label for="CPU">CPU</label>
        <input type="text" id="CPU" name="CPU" value="<?= htmlspecialchars($serveur['CPU']) ?>" required>

        <label for="RAM">RAM (GO)</label>
        <input type="number" id="RAM" name="RAM" value="<?= htmlspecialchars($serveur['RAM']) ?>" required>

        <label for="Capacite_Disque">Capacité Disque</label>
        <input type="text" id="Capacite_Disque" name="Capacite_Disque" value="<?= htmlspecialchars($serveur['Capacite_Disque']) ?>" required>

        <label for="Systeme_Exploitation">Système d'Exploitation</label>
        <input type="text" id="Systeme_Exploitation" name="Systeme_Exploitation" value="<?= htmlspecialchars($serveur['Systeme_Exploitation']) ?>" required>

        <label for="Langue">Langue</label>
        <input type="text" id="Langue" name="Langue" value="<?= htmlspecialchars($serveur['Langue']) ?>" required>

        <label for="Marché_Acquisition_num">Marché Acquisition Num</label>
        <input type="text" id="Marché_Acquisition_num" name="Marché_Acquisition_num" value="<?= htmlspecialchars($serveur['Marché_Acquisition_Num']) ?>" required>

        <label for="Designation_Marché">Désignation Marché</label>
        <input type="text" id="Designation_Marché_Maintenance" name="Designation_Marché_Maintenance" value="<?= htmlspecialchars($serveur['Designation_Marché_Acquisition']) ?>" required>

        <label for="Titulaire_Marché_Acquisition">Titulaire Marché Acquisition</label>
        <input type="text" id="Titulaire_Marché_Acquisition" name="Titulaire_Marché_Acquisition" value="<?= htmlspecialchars($serveur['Titulaire_Marché_Acquisition']) ?>" required>

        <label for="Date_Debut_Marché">Date Début Marché</label>
        <input type="date" id="Date_Debut_Marché_Acquisition" name="Date_Debut_Marché_Acquisition" value="<?= htmlspecialchars($serveur['Date_Debut_Marché_Acquisition']) ?>" required>

        <label for="Date_Fin_Marche">Date Fin Marché</label>
        <input type="date" id="Date_Fin_Marché_Acquisition" name="Date_Fin_Marché_Acquisition" value="<?= htmlspecialchars($serveur['Date_Fin_Marché_Acquisition']) ?>" required>

        <label for="Cout_Acquisition">Coût Acquisition (€)</label>
        <input type="number" id="Cout_Acquisition" name="Cout_Acquisition" step="0.01" value="<?= htmlspecialchars($serveur['Cout_Acquisition']) ?>" required>

        <label for="Marché_Maintenance_Num">Marché Maintenance Num</label>
        <input type="text" id="Marché_maintenance_num" name="Marché_maintenance_num" value="<?= htmlspecialchars($serveur['Marché_Maintenance_Num']) ?>" required>

        <label for="Designation_Marché_Maintenance">Désignation Marché Maintenance</label>
        <input type="text" id="Designation_Marché_Maintenance" name="Designation_Marché_Maintenance" value="<?= htmlspecialchars($serveur['Designation_Marché_Maintenance']) ?>" required>

       <label for="Titulaire_Marché_Maintenance">Titulaire Marché Maintenance</label>
       <input type="text" id="Titulaire_Marché_Maintenance" name="Titulaire_Marché_Maintenance" value="<?= htmlspecialchars($serveur['Titulaire_Marché_Maintenance']) ?>" required>

       <label for="Date_Debut_Marché_Maintenance">Date Début Marché Maintenance</label>
       <input type="date" id="Date_Debut_Marché_Maintenance" name="Date_Debut_Marché_Maintenance" value="<?= htmlspecialchars($serveur['Date_Debut_Marché_Maintenance']) ?>" required>

       <label for="Date_Fin_Marché_Maintenance">Date Fin Marché Maintenance</label>
       <input type="date" id="Date_Fin_Marché_Maintenance" name="Date_Fin_Marché_Maintenance" value="<?= htmlspecialchars($serveur['Date_Fin_Marché_Maintenance']) ?>" required>

    <button type="submit">Mettre à jour</button>
</form>
</main> 

<footer>
     <p>&copy; 2024 ONEE BO - Tous droits réservés</p>
 </footer>
</body> 
</html> 
