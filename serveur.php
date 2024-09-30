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
        !empty($_POST['Nom_Machine']) && !empty($_POST['Designation']) && 
        !empty($_POST['Localisation']) && !empty($_POST['Position']) && 
        !empty($_POST['Type']) && !empty($_POST['Categorie']) && 
        !empty($_POST['Adresse_Ip']) && !empty($_POST['Responsable']) &&
        !empty($_POST['Marque']) && !empty($_POST['Modele']) && 
        !empty($_POST['CPU']) && !empty($_POST['RAM']) && 
        !empty($_POST['Capacite_Disque']) &&
        !empty($_POST['Direction_Metier']) &&
        !empty($_POST['Systeme_Exploitation']) &&
        !empty($_POST['Langue']) &&
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
        $Nom_Machine = htmlspecialchars($_POST['Nom_machine']);
        $Designation = htmlspecialchars($_POST['Designation']);
        $Localisation = htmlspecialchars($_POST['Localisation']);
        $Position = intval($_POST['Position']);
        $Type = htmlspecialchars($_POST['type']);
        $Categorie = htmlspecialchars($_POST['Categorie']);
        $Adresse_Ip = htmlspecialchars($_POST['Adresse_Ip']);
        $Responsable = htmlspecialchars($_POST['Responsable']);
        $Direction_Metier = htmlspecialchars($_POST['Direction_Metier']);

        $Marque = htmlspecialchars($_POST['Marque']);
        $Modele = htmlspecialchars($_POST['Modele']);
        $CPU = intval($_POST['CPU']);
        $RAM = intval($_POST['RAM']);
        $Capacite_Disque = intval($_POST['Capacite_Disque']);

        $Systeme_Exploitation = htmlspecialchars($_POST['Systeme_Exploitation']);
        $Langue = htmlspecialchars($_POST['Langue']);

   
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
            INSERT INTO serveur
            (Nom_Machine, Designation, Localisation, Position, Type, Categorie, Adresse_Ip, Responsable, Direction_Metier, Marque, Modele, CPU, RAM, Capacite_Disque, Systeme_Exploitation, Langue, Marché_Acquisition_Num, Designation_Marché_Acquisition, Titulaire_Marché_Acquisition, Date_Debut_Marché_Acquisition, Date_Fin_Marché_Acquisition, Cout_Acquisition, Marché_Maintenance_Num, Designation_Marché_Maintenance, Titulaire_Marché_Maintenance, Date_Debut_Marché_Maintenance, Date_Fin_Marché_Maintenance) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        $insert->execute(array(
            $Nom_Machine, $Designation, $Localisation, $Position, $Type, $Categorie, $Adresse_Ip, $Responsable, 
            $Direction_Metier, $Marque, $Modele, $CPU, $RAM, $Capacite_Disque, $Systeme_Exploitation, $Langue, 
            $Marché_Acquisition_Num, $Designation_Marché_Acquisition, $Titulaire_Marché_Acquisition, $Date_Debut_Marché_Acquisition, 
            $Date_Fin_Marché_Acquisition, $Cout_Acquisition, $Marché_Maintenance_Num, $Designation_Marché_Maintenance, 
            $Titulaire_Marché_Maintenance, $Date_Debut_Marché_Maintenance, $Date_Fin_Marché_Maintenance
        ));

        $succesMsg = "Serveur ajouté avec succès";
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
    <title>Serveurs - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include("./link.php")?>
    <main>
        <section id="serveur-section">
            <h2>Ajouter ou Modifier Un Serveur</h2>
            <a href="./listeServeur.php"> voir les Serveur </a>
        <?php if (isset($succesMsg)) {
    echo $succesMsg;
} elseif (isset($errorMsg)) {
    echo $errorMsg;
} ?>
            <form id="serveurForm" method="POST" action="">
                <input type="hidden" name="create" value="1">

                <label for="Nom_Machine"> Nom machine :</label>
                <input type="text" id="Nom_Machine" name="Nom__Machine" placeholder="Nom_Machine" required>
                               
                <label for="Designation"> Designation :</label>
                <input type="text" id="Designation" name="Designation" placeholder="Designation" required>

                <label for="Localisation"> Localisation :</label>
                <select id="Localisation" name="Localisation">
                    <option value="Datacenter"> Datacenter</option>
                    <option value="Backup"> Backup</option>
                </select>

                <label for="Position"> Position :</label>
                <input type="number" id="Position" name="Position" min="1" max="16" placeholder="1 - 16" required>

                <label for="type"> type:</label>
                <select id="Type" name="Type">
                    <option value="Physique"> Physique</option>
                    <option value="Hyperviseur"> Hyperviseur</option>
                    <option value="VM"> VM</option>
                </select>

                <label for="Categorie"> Categorie:</label>
                <select id="Categorie" name="Categorie">
                    <option value="Production">Production</option>
                    <option value="Guard"> Guard</option>
                    <option value="Backup"> Backup</option>
                    <option value="Maquette"> Maquette</option>
                    <option value="Test"> Test</option>
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

                <label for="Direction_Metier"> Direction_Metier :</label>
                <input type="text" id="Direction_Metier" name="Direction_Metier" placeholder="Direction_Metier">
                
                <fieldset>
                    <legend>Configuration Materielle </legend>

                    <label for="Marque"> Marque :</label>
                    <select id="Marque" name="Marque">
                        <option value="DELL"> DELL</option>
                        <option value="VCE"> VCE</option>
                        <option value="NUTANIX"> NUTANIX</option>
                        
                    </select>
                    
                    <label for="Modele"> Modele :</label>
                    <input type="text" id="Modele" name="Modele" placeholder="Modele">

                    <label for="CPU">CPU :</label>
                    <input type="number" id="CPU" name="CPU" placeholder=" Nombre de CPU">

                    <label for="RAM"> RAM (GO) :</label>
                    <input type="number" id="RAM" name="RAM" placeholder="RAM en GO">

                    <label for="Capacite_Disque"> Capacite_Disque :</label>
                    <input type="number" id="Capacite_Disque" name="Capacite_Disque" placeholder="Capacite_Disqueen en Go">

                </fieldset>

                <fieldset>
                    <legend> Configuration Logicielle </legend>

                <label for="Systeme_Exploitation"> Systeme_Exploitation :</label>
                <select id="Systeme_Exploitation" name="Systeme_Exploitation">
                    <option value="Windows 2012"> Windows 2012</option>
                    <option value="Windows 2016"> Windows 2016</option>
                    <option value="Windows 2019"> Windows 2019</option>
                    <option value="Linux"> Linux</option>
                </select>
                
                <label for="Langue"> Langue :</label>
                <select id="Langue" name="Langue">
                    <option value="Anglais">Anglais</option>
                    <option value="Français">Français</option>
                </select>
                </fieldset>

                <fieldset>
                    <legend> Marchés </legend>
                    <h3> Marché Acquisition Num</h3>
                    <label for="Marché_Acquisition_Num"> N Marche acquisition :</label>
                    <input type="text" id="Marché_Acquisition_Num" name="Marché_Acquisition_Num" placeholder="N Marché acquisition">

                    <label for="Designation_Marché_Acquisition">Designation_Marché_Acquisition :</label>
                    <input type="text" id="Designation_Marché_Acquisition" name="Designation_Marché_Acquisition" placeholder="Designation_Marché_Acquisition">

                    <label for="Titulaire_Marché_Acquisition">Titulaire_Marché_Acquisition :</label>
                    <input type="text" id="Titulaire_Marché_Acquisition" name="Titulaire_Marché_Acquisition" placeholder="Titulaire_Marché_Acquisition">

                    <label for="Date_Debut_Marché_Acquisition">Date_Debut_Marché_Acquisition :</label>
                    <input type="date" id="Date_Debut_Marché_Acquisition" name="Date_Debut_Marché_Acquisition" >

                    <label for="Date_Fin_Marché_Acquisition">Date_Fin_Marché_Acquisition :</label>
                    <input type="date" id="Date_Fin_Marché_Acquisition" name="Date_Fin_Marché_Acquisition" >

                    <label for="Cout_Acquisition">Cout_Acquisition :</label>
                    <input type="number" id="Cout_Acquisition" name="Cout_Acquisition" placeholder="Cout_Acquisition" step="0.01">

                    <h3> Marché De Maintenance </h3>
                    <label for="Marché_Maintenance_Num"> N Marché_Maintenance :</label>
                    <input type="text" id="Marché_Maintenance_Num" name="Marché_Maintenance_Num" placeholder="N Marché_Maintenance">

                    <label for="Designation_Marche_Maintenance">Designation_Marché_Maintenance :</label>
                    <input type="text" id="Designation_Marché_Maintenance " name="Designation_Marché_Maintenance" placeholder="Designation_Marché_Maintenance ">

                    <label for="Titulaire_Marché_Maintenance">Titulaire_Marché_Maintenance :</label>
                    <input type="text" id="Titulaire_Marché_Maintenance" name="Titulaire_Marché_Maintenance" placeholder="Titulaire_Marché_Maintenance">

                    <label for="Date_Debut_Marché_Maintenance">Date_Debut_Marché_Maintenance :</label>
                    <input type="date" id="Date_Debut_Marché_Maintenance" name="Date_Debut_Marché_Maintenance" >

                    <label for="Date_Fin_Marché_Maintenance">Date_Fin_Marché_Maintenance :</label>
                    <input type="date" id="Date_Fin_Marché_Maintenance" name="Date_Fin_Marché_Maintenance" >
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

