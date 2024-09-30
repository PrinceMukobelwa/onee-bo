<?php
S
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


    $stmt = $conn->prepare("SELECT * FROM licences WHERE id = ?");
    $stmt->execute([$id]);
    $licence = $stmt->fetch();

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $nomLogiciel = htmlspecialchars($_POST['nLogiciel']);
        $kLicences = htmlspecialchars($_POST['kLicences']);
        $tLicences = htmlspecialchars($_POST['tLicences']);
        $nServeur = htmlspecialchars($_POST['nServeur']);
        $dDebut = htmlspecialchars($_POST['dDebut']);
        $dFin = htmlspecialchars($_POST['dFin']);
        $titulaireL = htmlspecialchars($_POST['titulaireL']);
        $fourniseur = htmlspecialchars($_POST['fourniseur']);
        $coutL = htmlspecialchars($_POST['coutL']);


        $update = $conn->prepare("UPDATE licences SET nLogiciel = ?, kLicences = ?, tLicences = ?, nServeur = ?, dDebut = ?, dFin = ?, titulaireL = ?, fourniseur = ?, coutL = ? WHERE id = ?");
        $update->execute([$nomLogiciel, $kLicences, $tLicences, $nServeur, $dDebut, $dFin, $titulaireL, $fourniseur, $coutL, $id]);

        $succesMsg = "Licence modifiée avec succès";
    }
} else {
    die("Licence non spécifiée.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Licence - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include("./link.php") ?>
<main>
    <h2>Modifier une Licence</h2>
    <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
    <form method="POST">
        <label for="nLogiciel">Nom du logiciel</label>
        <input type="text" id="nLogiciel" name="nLogiciel" value="<?= htmlspecialchars($licence['nLogiciel']) ?>" required>
        
        <label for="kLicences">Clé de licence</label>
        <input type="text" id="kLicences" name="kLicences" value="<?= htmlspecialchars($licence['kLicences']) ?>" required>
        
        <label for="tLicences">Type de licence</label>
        <input type="text" id="tLicences" name="tLicences" value="<?= htmlspecialchars($licence['tLicences']) ?>" required>
        
        <label for="nServeur">Nombre de serveurs</label>
        <input type="number" id="nServeur" name="nServeur" value="<?= htmlspecialchars($licence['nServeur']) ?>" required>
        
        <label for="dDebut">Date de début</label>
        <input type="date" id="dDebut" name="dDebut" value="<?= htmlspecialchars($licence['dDebut']) ?>" required>
        
        <label for="dFin">Date de fin</label>
        <input type="date" id="dFin" name="dFin" value="<?= htmlspecialchars($licence['dFin']) ?>" required>
        
        <label for="titulaireL">Titulaire</label>
        <input type="text" id="titulaireL" name="titulaireL" value="<?= htmlspecialchars($licence['titulaireL']) ?>" required>
        
        <label for="fourniseur">Fournisseur</label>
        <input type="text" id="fourniseur" name="fourniseur" value="<?= htmlspecialchars($licence['fourniseur']) ?>" required>
        
        <label for="coutL">Coût de la licence (€)</label>
        <input type="number" step="0.01" id="coutL" name="coutL" value="<?= htmlspecialchars($licence['coutL']) ?>" required>
        
        <button type="submit">Mettre à jour</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 ONEE BO - Tous droits réservés</p>
</footer>
</body>
</html>
