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

if (isset($_POST['create'])) {
    
    if (
        !empty($_POST['Nom']) && 
        !empty($_POST['Designation']) &&
        !empty($_POST['Adresse_Ip']) &&
        !empty($_POST['Localisation']) &&
        !empty($_POST['Responsable']) &&
        !empty($_POST['Marque']) &&
        !empty($_POST['Modele']) &&
        !empty($_POST['Marche_Acquisition_Num']) &&
        !empty($_POST['Designation_Marche_Acquisition']) &&
        !empty($_POST['Titulaire_Marche_Acquisition']) &&
        !empty($_POST['Date_Debut_Marche_Acquisition']) &&
        !empty($_POST['Date_Fin_Marche_Acquisition']) &&
        !empty($_POST['Cout_Acquisition']) &&
        !empty($_POST['Marche_Maintenance_Num']) &&
        !empty($_POST['Designation_Marche_Maintenance']) &&
        !empty($_POST['Titulaire_Marche_Maintenance']) &&
        !empty($_POST['Date_Debut_Marche_Maintenance']) &&
        !empty($_POST['Date_Fin_Marche_Maintenance']) &&
        !empty($_POST['Cout_Maintenance'])
    ) {
        
        $Nom= htmlspecialchars($_POST['Nom']);
        $Designation = htmlspecialchars($_POST['Designation']);
        $Adresse_Ip = htmlspecialchars($_POST['Adresse_Ip']);
        $Localisation = htmlspecialchars($_POST['Localisation']);
        $Responsable = htmlspecialchars($_POST['Responsable']);
        $Marque = htmlspecialchars($_POST['Marque']);
        $Modele = htmlspecialchars($_POST['Modele']);
        $Marche_Acquisition_Num = htmlspecialchars($_POST['Marche_Acquisition_Num']);
        $Designation_Marche_Acquisition = htmlspecialchars($_POST['Designation_Marche_Acquisition']);
        $Titulaire_Marche_Acquisition = htmlspecialchars($_POST['Titulaire_Marche_Acquisition']);
        $Date_Debut_Marche_Acquisition = htmlspecialchars($_POST['Date_Debut_Marche_Acquisition']);
        $Date_Fin_Marche_Acquisition = htmlspecialchars($_POST['Date_Fin_Marche_Acquisition']);
        $Cout_Acquisition = htmlspecialchars($_POST['Cout_Acquisition']);
        $Marche_Maintenance_Num = htmlspecialchars($_POST['Marche_Maintenance_Num']);
        $Designation_Marche_Maintenance = htmlspecialchars($_POST['Designation_Marche_Maintenance']);
        $Titulaire_Marche_Maintenance = htmlspecialchars($_POST['Titulaire_Marche_Maintenance']);
        $Date_Debut_Marche_Maintenance = htmlspecialchars($_POST['Date_Debut_Marche_Maintenancen']);
        $Date_Fin_Marche_Maintenance = htmlspecialchars($_POST['Date_Fin_Marche_Maintenance']);
        $Cout_Maintenance = htmlspecialchars($_POST['Cout_Maintenance']);

        $insert = $conn->prepare('INSERT INTO virtualisation (Nom, Designation, Adresse_IP, Localisation, Responsable, Marque, Modele, Marche_Acquisition_Num, Designation_Marche_Acquisition, Titulaire_Marche_Acquisition, Date_Debut_Marche_Acquisition, Date_Fin_Marche_Acquisition, Cout_Acquisition, Marche_Maintenance_Num, Designation_Marche_Maintenance, Titulaire_Marche_Maintenance, Date_Debut_Marche_Maintenance, Date_Fin_Marche_Maintenance, Cout_Maintenance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

        $insert->execute(array($Nom, $Designation, $Adresse_Ip, $Localisation, $Responsable, $Marque, $Modele, $Marche_Acquisition_Num, $Designation_Marche_Acquisition, $Titulaire_Marche_Acquisition, $Date_Debut_Marche_Acquisition, $Date_Fin_Marche_Acquisition, $Cout_Acquisition, $Marche_Maintenance_Num, $Designation_Marche_Maintenance, $Titulaire_Marche_Maintenance, $Date_Debut_Marche_Maintenance, $Date_Fin_Marche_Maintenance, $Cout_Maintenance));

        $succesMsg = "Virtualisation ajoutée avec succès";
    } else {
        $errorMsg = "Veuillez compléter tous les champs requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtualisation - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include("./link.php")?>
    <main>
                <section id="virtualisation-section">
                    <h2>Ajouter ou Modifier Une Virtualisation de Stockage</h2>
                    <a href="./listeVirtualisation.php"> voir les Virtualisation </a>
        <?php if (isset($succesMsg)) {
    echo $succesMsg;
} elseif (isset($errorMsg)) {
    echo $errorMsg;
} ?>
                    <form id="virtualisationForm" method="POST" action="">
                        <input type="hidden" name="create" value="1">
                
                        <label for="Nom">Nom :</label>
                        <input type="text" id="Nom" name="Nom" placeholder="Nom" required>
                
                        <label for="Designation">Désignation :</label>
                        <input type="text" id="Designation" name="Designation" placeholder="Designation" required>
                
                        <label for="Adresse_Ip">Adresse IP :</label>
                        <input type="text" id="Adresse_Ip" name="Adresse_Ip" placeholder="Adresse IP"required>>
                
                        <label for="Localisation_Virtualisation">Localisation :</label>
                        <select id="Localisation" name="Localisation">
                            <option value="Datacenter">Datacenter</option>
                            <option value="Backup">Backup</option>
                        </select>
                
                        <label for="Responsable">Responsable :</label>
                        <select id="Responsable" name="Responsable">
                            <option value="DSI/AA">DSI/AA</option>
                            <option value="DSI/AB">DSI/AB</option>
                            <option value="DSI/R">DSI/R</option>
                            <option value="DSI/P">DSI/P</option>
                        </select>
                
                        <label for="Marque">Marque :</label>
                        <select id="Marque" name="Marque">
                            <option value="DELL">DELL</option>
                            <option value="VCE">VCE</option>
                        </select>
                
                        <label for="Modele_Virtualisation">Modèle :</label>
                        <input type="text" id="Modele" name="Modele" placeholder="Modèle"required>>
                
                        <fieldset>
                            <legend>Marché d'Acquisition</legend>
                
                            <label for="Marche_Acquisition_Num">N° marché acquisition :</label>
                            <input type="text" id="Marche_Acquisition_Num" name="Marche_Acquisition_Num" placeholder="N° marché acquisition"required>>
                        
                            <label for="Designation_Marche_Acquisition">Désignation marché acquisition :</label>
                            <input type="text" id="Designation_Marche_Acquisition" name="Designation_Marche_Acquisition" placeholder="Designation Marche_Acquisition"required>>
                
                            <label for="Titulaire_Marche_Acquisition_Virtualisation">Titulaire marché acquisition :</label>
                            <input type="text" id="Titulaire_Marche_Acquisition" name="Titulaire_Marche_Acquisition" placeholder="Titulaire Marche_Acquisition"required>>
                
                            <label for="Date_Debut_Marche_Acquisition_Virtualisation">Date début marché acquisition :</label>
                            <input type="date" id="Date_Debut_Marche_Acquisition" name="Date_Debut_Marche_Acquisition"required>>
                
                            <label for="Date_Fin_Marche_Acquisition_Virtualisation">Date fin marché acquisition :</label>
                            <input type="date" id="Date_Fin_Marche_Acquisition" name="Date_Fin_Marche_Acquisition"required>>
                
                            <label for="Cout_Acquisition_Virtualisation">Coût acquisition :</label>
                            <input type="number" id="Cout_Acquisition" name="Cout_Acquisition" placeholder="Coût acquisition" step="0.01">
                        </fieldset>
                
                        <fieldset>
                            <legend>Marché de Maintenance</legend>
                
                            <label for="Marche_Maintenance_Num_Virtualisation">N° marché maintenance :</label>
                            <input type="text" id="Marche_Maintenance_Num" name="Marche_Maintenance_Num" placeholder="N° marché maintenance"required>
                
                            <label for="Designation_Marche_Maintenance_Virtualisation">Désignation marché maintenance :</label>
                            <input type="text" id="Designation_Marche" name="Designation_Marche" placeholder="Designation Marche Maintenance"required>>
                
                            <label for="Titulaire_Marche_Maintenance_Virtualisation">Titulaire marché maintenance :</label>
                            <input type="text" id="Titulaire_Marche_Maintenance" name="Titulaire_Marche_Maintenance" placeholder="Titulaire Marche_Maintenance"required>>
                
                            <label for="Date_Debut_Marche_Maintenance_Virtualisation">Date début marché maintenance :</label>
                            <input type="date" id="Date_Debut_Marche_Maintenance" name="Date_Debut_Marche_Maintenance"required>>
                
                            <label for="Date_Fin_Marche_Maintenance_Virtualisation">Date fin marché maintenance :</label>
                            <input type="date" id="Date_Fin_Marche_Maintenance" name="Date_Fin_Marche_Maintenance"required>>
                
                            <label for="Cout_Maintenance_Virtualisation">Coût maintenance :</label>
                            <input type="number" id="Cout_Maintenance" name="Cout_Maintenance" placeholder="Coût Maintenance" step="0.01">
                        </fieldset>
                
                        <button type="submit" name="create">Soumettre</button>
        
                    </form>
                </section>
    </main>
    <footer>
        <p> &copy; 2024 ONEE BO - Tous droit réservés </p>
    </footer>
</body>
</html>
