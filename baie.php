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
        !empty($_POST['Localisation']) && 
        !empty($_POST['Adresse_Ip']) && !empty($_POST['Responsable']) &&
        !empty($_POST['capacité_disque_ssd_brut']) && 
        !empty($_POST['capacité_disque_ssd_utilisé']) &&
        !empty($_POST['capacité_disque_sas_brut']) && 
        !empty($_POST['capacité_disque_sas_utilisé']) &&
        !empty($_POST['capacité_disque_sata_brut']) && 
        !empty($_POST['capacité_disque_sata_utilisé']) && 
        !empty($_POST['Marché_Acquisition_Num']) &&
        !empty($_POST['Designation_Marché_Acquisition']) &&
        !empty($_POST['Titulaire_Marché_Acquisition']) &&
        !empty($_POST['Date_Debut_Marché_Acquisition']) &&
        !empty($_POST['Date_Fin_Marché_Acquisition']) &&
        !empty($_POST['Cout_Acquisition']) &&
        !empty($_POST['Marché_Maintenance_Num']) &&
        !empty($_POST['Designation_Marché_Maintenance']) &&
        !empty($_POST['Titulaire_Marché_Maintenance']) &&
        !empty($_POST['Date_Debut_Marché_Maintenance']) &&
        !empty($_POST['Date_Fin_Marché_Maintenance'])
    ) {
        $Nom = htmlspecialchars($_POST['Nom']);
        $Designation = htmlspecialchars($_POST['Designation']);
        $Localisation = htmlspecialchars($_POST['Localisation']);
        $Adresse_Ip = htmlspecialchars($_POST['Adresse_Ip']);
        $Responsable = htmlspecialchars($_POST['Responsable']);
        
       
        $capacité_disque_ssd_brut = intval($_POST['capacité_disque_ssd_brut']);
        $Capacité_disque_ssd_Utilisé = intval($_POST['capacité_disque_ssd_utilisé']);
        
      
        $capacité_disque_sas_brut = intval($_POST['capacité_disque_sas_brut']);
        $capacité_disque_sas_utilisé = intval($_POST['capacité_disque_sas_utilisé']);
        
       
        $capacité_disque_sata_brut = intval($_POST['capacité_disque_sata_brut']);
        $capacité_disque_sata_utilisé = intval($_POST['capacité_disque_sata_utilisé']);
        
        
        $Marché_Acquisition_Num = htmlspecialchars($_POST['Marché_Acquisition_Num']);
        $Designation_Marché_Acquisition = htmlspecialchars($_POST['Designation_Marché_Acquisition']);
        $Titulaire_Marché_Acquisition = htmlspecialchars($_POST['Titulaire_Marché_Acquisition']);
        $Date_Debut_Marché_Acquisition = htmlspecialchars($_POST['Date_Debut_Marché_Acquisition']);
        $Date_Fin_Marché_Acquisition = htmlspecialchars($_POST['Date_Fin_Marché_Acquisition']);
        $Cout_Acquisition = floatval($_POST['Cout_Acquisition']);

        
        $Marché_Maintenance_Num = htmlspecialchars($_POST['Marché_Maintenance_Num']);
        $Designation_Marché_Maintenance = htmlspecialchars($_POST['Designation_Marché_Maintenance']);
        $Titulaire_Marché_Maintenance = htmlspecialchars($_POST['Titulaire_Marché_Maintenance']);
        $Date_Debut_Marché_Maintenance = htmlspecialchars($_POST['Date_Debut_Marché_Maintenance']);
        $Date_Fin_Marché_Maintenance = htmlspecialchars($_POST['Date_Fin_Marché_Maintenance']);

        $insert = $conn->prepare('
            INSERT INTO baie
            (Nom, Designation, Localisation, Adresse_Ip, Responsable, 
            capacité_disque_ssd_Brut, capacité_disque_Ssd_utilisé, 
            capacité_disque_sas_brut, capacité_disque_sas_utilisé,
            capacité_disque_sata_brut, capacité_disque_sata_utilisé,
            Marché_Acquisition_Num, Designation_Marché_Acquisition, 
            Titulaire_Marché_Acquisition, Date_Debut_Marché_Acquisition, 
            Date_Fin_Marché_Acquisition, Cout_Acquisition, 
            Marché_Maintenance_Num, Designation_Marché_Maintenance, 
            Titulaire_Marché_Maintenance, Date_Debut_Marché_Maintenance, 
            Date_Fin_Marché_Maintenance) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        
        $insert->execute(array(
            $Nom, $Designation, $Localisation, $Adresse_Ip, $Responsable, 
            $capacité_disque_ssd_brut, $capacité_disque_ssd_Utilisé, 
            $capacité_disque_sas_brut, $capacité_disque_sas_utilisé,
            $capacité_disque_sata_brut, $capacité_disque_sata_utilisé,
            $Marché_Acquisition_Num, $Designation_Marché, 
            $Titulaire_Marché_Acquisition, $Date_Debut_Marché_Acquisition, 
            $Date_Fin_Marché_Acquisition, $Cout_Acquisition, 
            $Marché_Maintenance_Num, $Designation_Marché_Maintenance, 
            $Titulaire_Marchée_Maintenance, $Date_Debut_Marché_Maintenance, 
            $Date_Fin_Marché_Maintenance
        ));

        $succesMsg = "Baie ajoutée avec succès";
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
    <title>Baies - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include("./link.php")?>
    <main>

              <section id="baie-section">
                    <h2> Ajouter ou Modifier Un Baie de Stockage </h2>
                    <a href="./listeBaie.php"> voir les Baie </a>
        <?php if (isset($succesMsg)) {
    echo $succesMsg;
} elseif (isset($errorMsg)) {
    echo $errorMsg;
} ?>
                    <form id="baieForm" method="POST" action=""> 
                        <input type="hidden" name="create" value="1">
        
                        <label for="Nom"> Nom :</label>
                        <input type="text" id="Nom" name="Nom" placeholder="Nom"  required>
        
                        <label for="Designation"> Designation :</label>
                        <input type="text" id="Designation" name="Designation" placeholder="Designation" required>
        
                        <label for="Localisation"> Localisation :</label>
                        <select id="Localisation" name="Localisation">
                            <option value="Datacenter"> Datacenter</option>
                            <option value="Backup"> Backup</option>
                        </select>
        
                        <label for="Adresse_Ip"> Adresse_Ip:</label>
                        <input type="text" id="Adresse_Ip" name="Adresse_Ip" placeholder="Adresse_Ip">
        
                        <label for="Responsable"> Responsable :</label>
                        <select id="Responsable" name="Responsable">
                            <option value="DSI/AA"> DSI/AA</option>
                            <option value="DSI/AB"> DSI/AB</option>
                            <option value="DSI/R"> DSI/R</option>
                            <option value="DSI/P"> DSI/P</option>
                        </select>
        
                        <fieldset>
                            <lengend> Configuration Des Disques </lengend>
                            <h3>SSD</h3>
                            <label for="capacité_disque_ssd_brut">Capacité Des Disques Ssd Brut (Go) :</label>
                            <input type="number" id="capacité_Disque_ssd_brut" name="capacité_disque_ssd_brut" placeholder="capacité_disque_ssd_brut">
        
                            <label for="capacité_disque_ssd_utulisé">Capacité Des Disques Ssd Utulisé (Go) :</label>
                            <input type="number" id="Capacité_disque_Ssd_Utilisé" name="capacité_Disque_ssd_utulisé" placeholder="Capacité_disque_ssd_Utulisé">
                
                            <h3>SAS</h3>
                            <label for="capacité_disque_sas_brut">Capacité disque SAS brut (Go) :</label>
                            <input type="number" id="capacité_disque_sas_brut" name="capacité_disque_sas_brut" placeholder="Capacité disque SAS brut">
        
                            <label for="capacité_disque_sas_utilisé">Capacité disque SAS utilisé (Go) :</label>
                            <input type="number" id="capacité_disque_sas_utilisé" name="capacité_disque_sas_utilisé" placeholder="Capacité disque SAS utilisé">
            
                            <h3>SATA</h3>
                            <label for="capacité_disque_sata_brut">Capacité disque SATA brut (Go) :</label>
                            <input type="number" id="capacité_disque_sata_brut" name="capacité_disque_sata_brut" placeholder="Capacité disque sata brut">
        
                            <label for="capacité_disque_sata_utilisé">Capacité disque SATA utilisé (Go) :</label>
                            <input type="number" id="capacité_disque_sata_utilisé" name="capacité_disque_sata_utilisé" placeholder="Capacité disque sata utilisé">
        
                        </fieldset>
        
                        <fieldset>
                            <legend> Marchés </legend>
                            
                            <h3>Marché d'acquisition</h3>
                            <label for="Marché_Acquisition_Num"> N° Marché acquisition :</label>
                            <input type="text" id="Marché_Acquisition_Num" name="Marché_Acquisition_Num" placeholder="N° marché acquisition">
                
                            <label for="Designation_Marché_Acquisition">Désignation Marché acquisition :</label>
                            <input type="text" id="Designation_Marché_Acquisition" name="Designation_Marché_Acquisition" placeholder="Désignation Marché_Acquisition ">
                
                            <label for="Titulaire_Marché_Acquisition">Titulaire Marché acquisition :</label>
                            <input type="text" id="Titulaire_Marché_Acquisition" name="Titulaire_Marché_Acquisition" placeholder="Titulaire marché_Acquisition ">
                
                            <label for="Date_Debut_Marché_Acquisition">Date Début Marché acquisition :</label>
                            <input type="date" id="Date_Debut_Marché_Acquisition" name="Date_Debut_Marché_Acquisition">
                
                            <label for="Date_Fin_Marché_Acquisition">Date Fin Marché acquisition :</label>
                            <input type="date" id="Date_Fin_Marché_Acquisition" name="Date_Fin_Marché_Acquisition">
                
                            <label for="Cout_Acquisition">Coût acquisition :</label>
                            <input type="number" id="Cout_Acquisition" name="Cout_Acquisition" placeholder="Coût acquisition" step="0.01">
                
                            <h3>Marché de maintenance</h3>
                            <label for="Marché_Maintenance_Num"> N° Marché maintenance :</label>
                            <input type="text" id="Marché_Maintenance_Num" name="Marché_Maintenance_Num" placeholder="N° Marché maintenance">
                
                            <label for="Designation_Marché_Maintenance">Désignation Marché maintenance :</label>
                            <input type="text" id="Designation_Marché_Maintenance" name="Designation_Marché_Maintenance" placeholder="Désignation Marché_Maintenance ">
                
                            <label for="Titulaire_Marché_Maintenance">Titulaire Marché maintenance :</label>
                            <input type="text" id="Titulaire_Marché_Maintenance" name="Titulaire_Marché_Maintenance" placeholder="Titulaire Marché_Maintenance ">
                
                            <label for="Date_Debut_Marché_Maintenance">Date Début Marché maintenance :</label>
                            <input type="date" id="Date_Debut_Marché_Maintenance" name="Date_Debut_Marché_Maintenance">
                
                            <label for="Date_Fin_Marché_Maintenance">Date Fin Marché maintenance :</label>
                            <input type="date" id="Date_Fin_Marché_Maintenance " name="Date_Fin_Marché_Maintenance">
                        </fieldset>
                        
                        <button type="submit" name="create"> Soumettre</button>       
                    </form>
                </section>
    </main>
    <footer>
        <p> &copy; 2024 ONEE BO - Tous droit réservés </p>
    </footer>
</body>
</html>





