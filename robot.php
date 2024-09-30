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
        !empty($_POST['nom']) && !empty($_POST['designation']) &&
        !empty($_POST['localisation']) && !empty($_POST['adresse_ip']) &&
        !empty($_POST['responsable']) && !empty($_POST['marque']) &&
        !empty($_POST['modele']) && !empty($_POST['generation']) &&
        !empty($_POST['lecteurs']) && !empty($_POST['cartouches']) &&
        !empty($_POST['num_marche_acquisition']) && !empty($_POST['designation_marche_acquisition']) &&
        !empty($_POST['titulaire_marche_acquisition']) && !empty($_POST['debut_marche_acquisition']) &&
        !empty($_POST['fin_marche_acquisition']) && !empty($_POST['cout_acquisition']) &&
        !empty($_POST['num_marche_maintenance']) && !empty($_POST['designation_marche_maintenance']) &&
        !empty($_POST['titulaire_marche_maintenance']) && !empty($_POST['debut_marche_maintenance']) &&
        !empty($_POST['fin_marche_maintenance']) && !empty($_POST['cout_maintenance'])
    ) {
        
        $nom = htmlspecialchars($_POST['nom']);
        $designation = htmlspecialchars($_POST['designation']);
        $localisation = htmlspecialchars($_POST['localisation']);
        $adresse_ip = htmlspecialchars($_POST['adresse_ip']);
        $responsable = htmlspecialchars($_POST['responsable']);
        $marque = htmlspecialchars($_POST['marque']);
        $modele = htmlspecialchars($_POST['modele']);
        $generation = htmlspecialchars($_POST['generation']);
        $lecteurs = (int)$_POST['lecteurs'];
        $cartouches = (int)$_POST['cartouches'];

        $num_marche_acquisition = htmlspecialchars($_POST['num_marche_acquisition']);
        $designation_marche_acquisition = htmlspecialchars($_POST['designation_marche_acquisition']);
        $titulaire_marche_acquisition = htmlspecialchars($_POST['titulaire_marche_acquisition']);
        $debut_marche_acquisition = htmlspecialchars($_POST['debut_marche_acquisition']);
        $fin_marche_acquisition = htmlspecialchars($_POST['fin_marche_acquisition']);
        $cout_acquisition = (float)$_POST['cout_acquisition'];

        $num_marche_maintenance = htmlspecialchars($_POST['num_marche_maintenance']);
        $designation_marche_maintenance = htmlspecialchars($_POST['designation_marche_maintenance']);
        $titulaire_marche_maintenance = htmlspecialchars($_POST['titulaire_marche_maintenance']);
        $debut_marche_maintenance = htmlspecialchars($_POST['debut_marche_maintenance']);
        $fin_marche_maintenance = htmlspecialchars($_POST['fin_marche_maintenance']);
        $cout_maintenance = (float)$_POST['cout_maintenance'];

        $insert = $conn->prepare('
            INSERT INTO robot (
                nom, designation, localisation, adresse_ip, responsable, marque,
                modele, generation, lecteurs, cartouches,
                num_marche_acquisition, designation_marche_acquisition,
                titulaire_marche_acquisition, debut_marche_acquisition,
                fin_marche_acquisition, cout_acquisition,
                num_marche_maintenance, designation_marche_maintenance,
                titulaire_marche_maintenance, debut_marche_maintenance,
                fin_marche_maintenance, cout_maintenance
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $insert->execute(array(
            $nom, $designation, $localisation, $adresse_ip, $responsable, $marque,
            $modele, $generation, $lecteurs, $cartouches,
            $num_marche_acquisition, $designation_marche_acquisition,
            $titulaire_marche_acquisition, $debut_marche_acquisition,
            $fin_marche_acquisition, $cout_acquisition,
            $num_marche_maintenance, $designation_marche_maintenance,
            $titulaire_marche_maintenance, $debut_marche_maintenance,
            $fin_marche_maintenance, $cout_maintenance
        ));

        $succesMsg="Robot ajoutée avec succès";
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
    <title>Robot - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include("./link.php")?>
    <main>

    <section id="robot-section">
        <h2>Ajouter ou Modifier un Robot de Sauvegarde</h2>
        <a href="./listeRobot.php"> voir les Robot </a>
        <?php if (isset($succesMsg)) {
    echo $succesMsg;
} elseif (isset($errorMsg)) {
    echo $errorMsg;
} ?>
        <form id="robotform" method="POST" action="">
            <input type="hidden" name="create" value="1">  

            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Nom du robot">
   
            <label for="designation">Désignation</label>
            <input type="text" id="designation" name="designation" placeholder="Désignation">
   
            <label for="localisation">Localisation</label>
            <select id="localisation" name="localisation">
               <option value="datacenter">Datacenter</option>
               <option value="backup">Backup</option>
            </select>
   
            <label for="ip">Adresse IP</label>
            <input type="text" id="adresse_ip" name="adresse_ip" placeholder="Adresse Ip">
   
            <label for="responsable">Responsable</label>
            <select id="responsable" name="responsable">
               <option value="dsi-aa">DSI/AA</option>
               <option value="dsi-ab">DSI/AB</option>
               <option value="dsi-r">DSI/R</option>
               <option value="dsi-p">DSI/P</option>
            </select>
   
            <label for="marque">Marque</label>
            <select id="marque" name="marque">
               <option value="dell">DELL</option>
               <option value="fujitsu">FUJITSU</option>
            </select>
   
            <label for="modele">Modèle</label>
            <input type="text" id="modele" name="modele" placeholder="Modèle">
   
            <label for="generation">Génération</label>
            <input type="text" id="generation" name="generation" placeholder="Génération">
   
            <label for="lecteurs">Nombre de lecteurs</label>
            <input type="number" id="lecteurs" name="lecteurs" placeholder="Nombre de lecteurs">
   
            <label for="cartouches">Nombre de cartouches</label>
            <input type="number" id="cartouches" name="cartouches" placeholder="Nombre de cartouches">
   
            <h3>Marchés d'acquisition</h3>
   
            <label for="num-marche-acquisition">N° marché acquisition</label>
            <input type="text" id="num_marche_acquisition" name="num_marche_acquisition" placeholder="N° marché acquisition">
   
            <label for="designation-marche-acquisition">Désignation marché acquisition</label>
            <input type="text" id="designation_marche_acquisition" name="designation_marche_acquisition" placeholder="Désignation_marché_acquisition">
   
            <label for="titulaire_marche_acquisition">Titulaire marché acquisition</label>
            <input type="text" id="titulaire_marche_acquisition" name="titulaire_marche_acquisition" placeholder="Titulaire_marché_acquisition">
   
            <label for="debut-marche-acquisition">Date début marché acquisition</label>
            <input type="date" id="debut_marche_acquisition" name="debut_marche_acquisition">
   
            <label for="fin-marche-acquisition">Date fin marché acquisition</label>
            <input type="date" id="fin_marche_acquisition" name="fin_marche_acquisition">
   
            <label for="cout-acquisition">Coût acquisition</label>
            <input type="number" id="cout_acquisition" name="cout_acquisition" placeholder="Coût_acquisition">
   
            <h3>Marchés de maintenance</h3>
   
            <label for="num-marché-maintenance">"N° marché maintenance"</label>
            <input type="text" id="num_marche_maintenance" name="num_marche_maintenance" placeholder="N° marché maintenance">
   
            <label for="designation-marche-maintenance">Désignation marché maintenance</label>
            <input type="text" id="designation_marche_maintenance" name="designation_marche_maintenance" placeholder="Désignation_marché_maintenance ">
   
            <label for="titulaire-marche-maintenance">Titulaire marché maintenance</label>
            <input type="text" id="titulaire_marche_maintenance" name="titulaire_marche_maintenance" placeholder="Titulaire_marché_maintenance ">
   
            <label for="debut-marche-maintenance">Date début marché maintenance</label>
            <input type="date" id="debut_marche_maintenance" name="debut_marche_maintenance">
   
            <label for="fin-marche-maintenance">Date fin marché maintenance</label>
            <input type="date" id="fin_marche_maintenance" name="fin_marche_maintenance">
   
            <label for="cout-maintenance">Coût maintenance</label>
            <input type="number" id="cout_maintenance" name="cout_maintenance" placeholder="Cout_maintenance">
   
            <button type="submit" name="create">Soumettre</button>
         </fieldset>

      </form>
   </section>
</main>
<footer>
    <p> &copy; 2024 ONEE BO - Tous droit réservés </p>
</footer>
</body>
</html>

