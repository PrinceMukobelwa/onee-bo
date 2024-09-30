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
        !empty($_POST['Nom']) && !empty($_POST['Designation']) &&
        !empty($_POST['Localisation']) && !empty($_POST['Adresse_Ip']) &&
        !empty($_POST['Responsable']) && !empty($_POST['Marque']) &&
        !empty($_POST['Modele']) && !empty($_POST['Capacite_Disque_Brut']) &&
        !empty($_POST['Capacite_Disque_Utilise']) && 
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
        $Date_Debut_Marche_Acquisition = htmlspecialchars($_POST['Date_Debut_Marche_Acquisition']);
        $Date_Fin_Marche_Acquisition = htmlspecialchars($_POST['Date_Fin_Marche_Acquisition']);
        $Cout_Acquisition = (float)$_POST['Cout_Acquisition'];

        
        $Marche_Maintenance_Num = htmlspecialchars($_POST['Marche_Maintenance_Num']);
        $Designation_Marche_Maintenance = htmlspecialchars($_POST['Designation_Marche_Maintenance']);
        $Titulaire_Marche_Maintenance = htmlspecialchars($_POST['Titulaire_Marche_Maintenance']);
        $Date_Debut_Marche_Maintenance = htmlspecialchars($_POST['Date_Debut_Marche_Maintenance']);
        $Date_Fin_Marche_Maintenance = htmlspecialchars($_POST['Date_Fin_Marche_Maintenance']);
        $Cout_Maintenance = (float)$_POST['Cout_Maintenance'];

        
        $insert = $conn->prepare('
        INSERT INTO appliances (
            Nom, Designation, Localisation, Adresse_Ip, Responsable, 
            Marque, Modele, Capacite_Disque_Brut, Capacite_Disque_Utilise, 
            Marche_Acquisition_Num, Designation_Marche_Acquisition, 
            Titulaire_Marche_Acquisition, Date_Debut_Marche_Acquisition, 
            Date_Fin_Marche_Acquisition, Cout_Acquisition, 
            Marche_Maintenance_Num, Designation_Marche_Maintenance, 
            Titulaire_Marche_Maintenance, Date_Debut_Marche_Maintenance, 
            Date_Fin_Marche_Maintenance, Cout_Maintenance
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ');
    

        $insert->execute(array(
            $Nom, $Designation, $Localisation, $Adresse_Ip, $Responsable,
            $Marque, $Modele, $Capacite_Disque_Brut, $Capacite_Disque_Utilise,
            $Marche_Acquisition_Num, $Designation_Marche_Acquisition, 
            $Titulaire_Marche_Acquisition, $Date_Debut_Marche_Acquisition, 
            $Date_Fin_Marche_Acquisition, $Cout_Acquisition,
            $Marche_Maintenance_Num, $Designation_Marche_Maintenance, 
            $Titulaire_Marche_Maintenance, $Date_Debut_Marche_Maintenance, 
            $Date_Fin_Marche_Maintenance, $Cout_Maintenance
        ));

        $succesMsg = "Appliance ajoutée avec succès";
    } else {
        $errorMsg="Veuillez compléter tous les champs requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appliance - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include("./link.php")?>
    <main>
    <section id="appliances-section">
        <h2>Ajouter ou Modifier une Appliance de Sauvegarde</h2>
        <a href="./listeAppliance.php"> voir les Appliance </a>
        <?php if (isset($succesMsg)) {
    echo $succesMsg;
} elseif (isset($errorMsg)) {
    echo $errorMsg;
} ?>
        <form id="appliancesForm" method="POST" action="">
                   <input type="hidden" name="create" value="1">  

                       <label for="Nom">Nom :</label>
                        <input type="text" id="Nom" name="Nom" placeholder="Nom" required>
        
                        <label for="Designation">Désignation :</label>
                        <input type="text" id="Designation" name="Designation" placeholder="Designation" required>
        
                        <label for="Localisation">Localisation :</label>
                        <select id="Localisation" name="Localisation">
                            <option value="Datacenter">Datacenter</option>
                            <option value="Backup">Backup</option>
                        </select>
        
                        <label for="Adresse_Ip">Adresse IP :</label>
                        <input type="text" id="Adresse_Ip" name="Adresse_Ip" placeholder="Adresse IP">
        
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
                            <option value="VERITAS">VERITAS</option>
                        </select>
        
                        <label for="Modele">Modèle :</label>
                        <input type="text" id="Modele" name="Modele" placeholder="Modèle">
        
                        <label for="Capacite_Disque_Brut">Capacité disque brut (Go) :</label>
                        <input type="number" id="Capacite_Disque_Brut" name="Capacite_Disque_Brut" placeholder="Capacité disque brut">
        
                        <label for="Capacite_Disque_Utilise">Capacité disque utilisé (Go) :</label>
                        <input type="number" id="Capacite_Disque_Utilise" name="Capacite_Disque_Utilise" placeholder="Capacité disque utilisé">
        
                        <fieldset>
                            <legend>Marché d'Acquisition</legend>
                            <label for="Marche_Acquisition_Num">N° marché acquisition :</label>
                            <input type="text" id="Marche_Acquisition_Num" name="Marche_Acquisition_Num" placeholder="N° marché acquisition">
        
                            <label for="Designation_Marche_Acquisition">Désignation marché acquisition :</label>
                            <input type="text" id="Designation_Marche_Acquisition" name="Designation_Marche_Acquisition" placeholder="Désignation_marché_Acquisition">
        
                            <label for="Titulaire_Marche_Acquisition">Titulaire marché acquisition :</label>
                            <input type="text" id="Titulaire_Marche_Acquisition" name="Titulaire_Marche_Acquisition"placeholder="Titulaire_Marche_Acquisition">
        
                            <label for="Date_Debut_Marche_Acquisition">Date début marché acquisition :</label>
                            <input type="date" id="Date_Debut_Marche_Acquisition" name="Date_Debut_Marche_Acquisition">
        
                            <label for="Date_Fin_Marche_Acquisition">Date fin marché acquisition :</label>
                            <input type="date" id="Date_Fin_Marche_Acquisition" name="Date_Fin_Marche_Acquisition">
        
                            <label for="Cout_Acquisition">Coût acquisition :</label>
                            <input type="number" id="Cout_Acquisition" name="Cout_Acquisition" placeholder="Cout_acquisition" step="0.01">
                        </fieldset>
        
                        <fieldset>
                            <legend>Marché de Maintenance</legend>
                            <label for="Marche_Maintenance_Num">N° marché maintenance :</label>
                            <input type="text" id="Marche_Maintenance_Num" name="Marche_Maintenance_Num" placeholder="N° marché maintenance">
        
                            <label for="Designation_Marche_Maintenance">Désignation marché maintenance :</label>
                            <input type="text" id="Designation_Marche_Maintenance" name="Designation_Marche_Maintenance" placeholder="Designation Marche_Maintenance ">
        
                            <label for="Titulaire_Marche_Maintenance">Titulaire marché maintenance :</label>
                            <input type="text" id="Titulaire_Marche_Maintenance" name="Titulaire_Marche_Maintenance" placeholder="Titulaire Marche_Maintenance ">
        
                            <label for="Date_Debut_Marche_Maintenance">Date début marché maintenance :</label>
                            <input type="date" id="Date_Debut_Marche_Maintenance" name="Date_Debut_Marche_Maintenance">
        
                            <label for="Date_Fin_Marche_Maintenance">Date fin marché maintenance :</label>
                            <input type="date" id="Date_Fin_Marche_Maintenance" name="Date_Fin_Marche_Maintenance">
        
                            <label for="Cout_Maintenance">Coût maintenance :</label>
                            <input type="number" id="Cout_Maintenance" name="Cout_Maintenance" placeholder="Cout maintenance" step="0.01">
                        </fieldset>
        
                <button type="submit"name="create"> Soumettre</button>
            </form>
        </section>
    </main>
    <footer>
        <p> &copy; 2024 ONEE BO - Tous droit réservés </p>
    </footer>
</body>
</html>

