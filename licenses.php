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
        !empty($_POST['nLogiciel']) && !empty($_POST['kLicenses']) &&
        !empty($_POST['tLicenses']) && !empty($_POST['nServeur']) &&
        !empty($_POST['dDebut']) && !empty($_POST['dFin']) &&
        !empty($_POST['titulaireL']) && !empty($_POST['fourniseur']) &&
        !empty($_POST['coutL'])
    ) {
       
        $nLogiciel = htmlspecialchars($_POST['nLogiciel']);
        $kLicenses = htmlspecialchars($_POST['kLicenses']);
        $tLicenses= htmlspecialchars($_POST['tLicenses']);
        $nServeur= htmlspecialchars($_POST['nServeur']);
        $dDebut = htmlspecialchars($_POST['dDebut']);
        $dFin = htmlspecialchars($_POST['dFin']);
        $titulaireL = htmlspecialchars($_POST['titulaireL']);
        $fourniseur = htmlspecialchars($_POST['fourniseur']);
        $coutL= htmlspecialchars($_POST['coutL']);

        
        $insert = $conn->prepare('INSERT INTO licences(nLogiciel,kLicences,tLicences,nServeur,dDebut, dFin, titulaireL,fourniseur,coutL) VALUES(?,?,?,?,?,?,?,?,?)');
        $insert->execute(array($nLogiciel,$kLicenses,$tLicenses,$nServeur, $dDebut, $dFin, $titulaireL, $fourniseur, $coutL));

        $succesMsg="Licence ajoutée avec succès";
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
    <title>Licences - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include("./link.php")?>
    <main>

    <section id="licenses-section">
        <h2>Licences</h2>
        <a href="./listeLicences.php"> voir les licences </a>
        <?php if (isset($succesMsg)) {
    echo $succesMsg;
} elseif (isset($errorMsg)) {
    echo $errorMsg;
} ?>
        <form id="licensesForm" method="POST" action="">
         <input type="hidden" name="create" value="1">
            <label for="SoftwareName">Nom du logiciel :</label>
                <input type="text" id="SoftwareName" name="nLogiciel" placeholder="Nom du logiciel" required>
        
                <label for="LicenseKey">Clé de licence :</label>
                <input type="text" id="LicenseKey" name="kLicenses" placeholder="Clé de licence">
        
                <label for="LicenseType">Type de licence :</label>
                <select id="LicenseType" name="tLicenses">
                    <option value="Perpétuelle">Perpétuelle</option>
                    <option value="Abonnement">Abonnement</option>
                    <option value="Evaluation">Evaluation</option>
                </select>
        
                <label for="UserCount">Nombre d'utilisateurs/serveurs :</label>
                <input type="number" id="UserCount" name="nServeur" placeholder="Nombre d'utilisateurs/serveurs">
        
                <label for="StartDate">Date de début :</label>
                <input type="date" id="StartDate" name="dDebut">
        
                <label for="EndDate">Date de fin :</label>
                <input type="date" id="EndDate" name="dFin">
        
                <label for="LicenseHolder">Titulaire de la licence :</label>
                <input type="text" id="LicenseHolder" name="titulaireL" placeholder="Titulaire de la licence">
        
                <label for="Supplier">Fournisseur :</label>
                <input type="text" id="Supplier" name="fourniseur" placeholder="Fournisseur">
        
                <label for="LicenseCost">Coût de la licence :</label>
                <input type="number" id="LicenseCost" name="coutL" placeholder="Coût de la licence" step="0.01">
        
                <button type="submit" name="create">Enregistrer</button>
        </form>
    </section>
</main>
<footer>
    <p> &copy; 2024 ONEE BO - Tous droit réservés </p>
</footer>
</body>
</html>

