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
        !empty($_POST['Nombre_Ports_Totaux']) &&
        !empty($_POST['Nombre_Ports_Utilises']) &&
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
        $Adresse_Ip = htmlspecialchars($_POST['Adresse_Ip']);
        $Localisation = htmlspecialchars($_POST['Localisation']);
        $Responsable = htmlspecialchars($_POST['Responsable']);
        $Marque = htmlspecialchars($_POST['Marque']);
        $Modele = htmlspecialchars($_POST['Modele']);
        $Nombre_Ports_Totaux = (int) $_POST['Nombre_Ports_Totaux'];
        $Nombre_Ports_Utilises = (int) $_POST['Nombre_Ports_Utilises'];

        
        $Marche_Acquisition_Num = htmlspecialchars($_POST['Marche_Acquisition_Num']);
        $Designation_Marche_Acquisition = htmlspecialchars($_POST['Designation_Marche_Acquisition']);
        $Titulaire_Marche_Acquisition = htmlspecialchars($_POST['Titulaire_Marche_Acquisition']);
        $Date_Debut_Marche_Acquisition = htmlspecialchars($_POST['Date_Debut_Marche_Acquisition']);
        $Date_Fin_Marche_Acquisition = htmlspecialchars($_POST['Date_Fin_Marche_Acquisition']);
        $Cout_Acquisition = (float) $_POST['Cout_Acquisition'];

       
        $Marche_Maintenance_Num = htmlspecialchars($_POST['Marche_Maintenance_Num']);
        $Designation_Marche_Maintenance = htmlspecialchars($_POST['Designation_Marche_Maintenance']);
        $Titulaire_Marche_Maintenance = htmlspecialchars($_POST['Titulaire_Marche_Maintenance']);
        $Date_Debut_Marche_Maintenance = htmlspecialchars($_POST['Date_Debut_Marche_Maintenance']);
        $Date_Fin_Marche_Maintenance = htmlspecialchars($_POST['Date_Fin_Marche_Maintenance']);
        $Cout_Maintenance = (float) $_POST['Cout_Maintenance'];

        
        $insert = $conn->prepare('
            INSERT INTO réseau (
                Nom, Designation, Adresse_Ip, Localisation, Responsable, Marque, Modele, Nombre_Ports_Totaux, Nombre_Ports_Utilises,
                Marche_Acquisition_Num, Designation_Marche_Acquisition, Titulaire_Marche_Acquisition, Date_Debut_Marche_Acquisition, Date_Fin_Marche_Acquisition, Cout_Acquisition,
                Marche_Maintenance_Num, Designation_Marche_Maintenance, Titulaire_Marche_Maintenance, Date_Debut_Marche_Maintenance, Date_Fin_Marche_Maintenance, Cout_Maintenance
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ');

  
        $insert->execute(array(
            $Nom, $Designation, $Adresse_Ip, $Localisation, $Responsable, $Marque, $Modele, $Nombre_Ports_Totaux, $Nombre_Ports_Utilises,
            $Marche_Acquisition_Num, $Designation_Marche_Acquisition, $Titulaire_Marche_Acquisition, $Date_Debut_Marche_Acquisition, $Date_Fin_Marche_Acquisition, $Cout_Acquisition,
            $Marche_Maintenance_Num, $Designation_Marche_Maintenance, $Titulaire_Marche_Maintenance, $Date_Debut_Marche_Maintenance, $Date_Fin_Marche_Maintenance, $Cout_Maintenance
        ));

        $succesMsg = "Réseau ajouté avec succès.";
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
    <title>Réseau - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include("./link.php")?>
    <main>
            <section id="réseau-section">
                <h2> Ajouter ou Modifier Un Réseau </h2>
                <a href="./listeRéseau.php"> voir les Réseau</a>
        <?php if (isset($succesMsg)) {
    echo $succesMsg;
} elseif (isset($errorMsg)) {
    echo $errorMsg;
} ?>
                <form id="réseauForm" method="POST" action="">
                    <input type="hidden" name="create" value="1">     
            
                    <label for="Nom"> Nom :</label>
                    <input type="text" id="Nom" name="Nom" placeholder="Nom" required>
            
                    <label for="Designation"> Designation :</label>
                    <input type="text" id="Designation" name="Designation" placeholder="Designation" required>
            
                    <label for="Localisation"> Localisation :</label>
                    <select id="Localisation" name="Localisation">
                        <option value="Datacenter"> Datacenter</option>
                        <option value="Backup"> Backup</option>
                    </select>
            
                    <label for="Adresse_Ip"> Adresse IP :</label>
                    <input type="text" id="Adresse_Ip" name="Adresse_Ip" placeholder="Adresse IP">
            
                    
                    <label for="Responsable"> Responsable :</label>
                    <select id="Responsable" name="Responsable">
                        <option value="DSI/AA"> DSI/AA</option>
                        <option value="DSI/AB"> DSI/AB</option>
                        <option value="DSI/R"> DSI/R</option>
                        <option value="DSI/P"> DSI/P</option>
                    </select>
            
                    <label for="Marque"> Marque :</label>
                    <select id="Marque" name="Marque">
                        <option value="CISCO"> CISCO</option>
                        <option value="DELL"> DELL</option>
                    </select>
            
                    <label for="Modele"> Modèle :</label>
                    <input type="text" id="Modele" name="Modele" placeholder="Modèle">
            
                    <label for="Nombre_Ports_Totaux"> Nombre de ports totaux :</label>
                    <input type="number" id="Nombre_Ports_Totaux" name="Nombre_Ports_Totaux" placeholder="Nombre de ports totaux">
            
                    <label for="Nombre_Ports_Utilises"> Nombre de ports utilisés :</label>
                    <input type="number" id="Nombre_Ports_Utilises" name="Nombre_Ports_Utilises" placeholder="Nombre de ports utilisés">
            
                    <fieldset>
                        <legend> Marchés </legend>
            
                        <h3> Marché d'acquisition </h3>
                        <label for="Marche_Acquisition_Num"> N° marché acquisition :</label>
                        <input type="text" id="Marche_Acquisition_Num" name="Marche_Acquisition_Num" placeholder="N° Marche acquisition">
            
                        <label for="Designation_Marche_Acquisition"> Désignation marché acquisition :</label>
                        <input type="text" id="Designation_Marche_Acquisition" name="Designation_Marche_Acquisition" placeholder="Designation_Marche_Acquisition ">
            
                        <label for="Titulaire_Marche_Acquisition"> Titulaire marché acquisition :</label>
                        <input type="text" id="Titulaire_Marche_Acquisition" name="Titulaire_Marche_Acquisition" placeholder="Titulaire marche_Acquisition ">
            
                        <label for="Date_Debut_Marche_Acquisition"> Date début marché acquisition :</label>
                        <input type="date" id="Date_Debut_Marche_Acquisition" name="Date_Debut_Marche_Acquisition">
            
                        <label for="Date_Fin_Marche_Acquisition"> Date fin marché acquisition :</label>
                        <input type="date" id="Date_Fin_Marche_Acquisition" name="Date_Fin_Marche_Acquisition">
            
                        <label for="Cout_Acquisition"> Coût acquisition :</label>
                        <input type="number" id="Cout_Acquisition" name="Cout_Acquisition" placeholder="Cout acquisition" step="0.01">
            
                        <h3> Marché de maintenance </h3>
                        <label for="Marche_Maintenance_Num"> N° marché maintenance :</label>
                        <input type="text" id="Marche_Maintenance_Num" name="Marche_Maintenance_Num" placeholder="N° Marche Maintenance">
            
                        <label for="Designation_Marche_Maintenance"> Désignation marché maintenance :</label>
                        <input type="text" id="Designation_Marche_Maintenance" name="Designation_Marche_Maintenance" placeholder="Designation marche ">
            
                        <label for="Titulaire_Marche_Maintenance"> Titulaire marché maintenance :</label>
                        <input type="text" id="Titulaire_Marche_Maintenance" name="Titulaire_Marche_Maintenance" placeholder="Titulaire Marche_Maintenance ">
            
                        <label for="Date_Debut_Marche_Maintenance"> Date début marché maintenance :</label>
                        <input type="date" id="Date_Debut_Marche_Maintenance" name="Date_Debut_Marche_Maintenance">
            
                        <label for="Date_Fin_Marche_Maintenance"> Date fin marché maintenance :</label>
                        <input type="date" id="Date_Fin_Marche_Maintenance" name="Date_Fin_Marche_Maintenance">
            
                        <label for="Cout_Maintenance"> Coût maintenance :</label>
                        <input type="number" id="Cout_Maintenance" name="Cout_Maintenance" placeholder="Cout maintenance" step="0.01">
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

