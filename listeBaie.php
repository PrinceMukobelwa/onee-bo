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


if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'supprimer') {
    $id = (int)$_GET['id'];
    $delete = $conn->prepare("DELETE FROM baie WHERE id = ?");
    $delete->execute([$id]);
    $succesMsg = "Baie supprimée avec succès.";
}


$res = $conn->prepare("SELECT * FROM baie ORDER BY id DESC");
$res->execute();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baies de Stockage - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("./link.php") ?>

    <main>
        <h1>Liste des baies de stockage</h1>
        <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
        <div class="tab">         <table>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Désignation</th>
                    <th scope="col">Localisation</th>
                    <th scope="col">Adresse IP</th>
                    <th scope="col">Responsable</th>
                    <th scope="col">Capacité Disque SSD Brut</th>
                    <th scope="col">Capacité Disque SSD Utilisé</th>
                    <th scope="col">Capacité Disque SAS Brut</th>
                    <th scope="col">Capacité Disque SAS Utilisé</th>
                    <th scope="col">Capacité Disque SATA Brut</th>
                    <th scope="col">Capacité Disque SATA Utilisé</th>
                    <th scope="col">Numéro Marché Acquisition</th>
                    <th scope="col">Désignation Marché Acquisition</th>
                    <th scope="col">Titulaire Marché Acquisition</th>
                    <th scope="col">Date Début Marché Acquisition</th>
                    <th scope="col">Date Fin Marché Acquisition</th>
                    <th scope="col">Coût Acquisition</th>
                    <th scope="col">Numéro Marché Maintenance</th>
                    <th scope="col">Désignation Marché Maintenance</th>
                    <th scope="col">Titulaire Marché Maintenance</th>
                    <th scope="col">Date Début Marché Maintenance</th>
                    <th scope="col">Date Fin Marché Maintenance</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $res->fetch()) { ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($row['Nom']) ?></th>
                        <td><?= htmlspecialchars($row['Designation']) ?></td>
                        <td><?= htmlspecialchars($row['Localisation']) ?></td>
                        <td><?= htmlspecialchars($row['Adresse_Ip']) ?></td>
                        <td><?= htmlspecialchars($row['Responsable']) ?></td>
                        <td><?= htmlspecialchars($row['capacité_disque_ssd_brut']) ?></td>
                        <td><?= htmlspecialchars($row['capacité_disque_ssd_utilisé']) ?></td>
                        <td><?= htmlspecialchars($row['capacité_disque_sas_brut']) ?></td>
                        <td><?= htmlspecialchars($row['capacité_disque_sas_utilisé']) ?></td>
                        <td><?= htmlspecialchars($row['capacité_disque_sata_brut']) ?></td>
                        <td><?= htmlspecialchars($row['capacité_disque_sata_utilisé']) ?></td>
                        <td><?= htmlspecialchars($row['Marché_Acquisition_Num']) ?></td>
                        <td><?= htmlspecialchars($row['Designation_Marché_Acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['Titulaire_Marché_Acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['Date_Debut_Marché_Acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['Date_Fin_Marché_Acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['Cout_Acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['Marché_Maintenance_Num']) ?></td>
                        <td><?= htmlspecialchars($row['Designation_Marché_Maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['Titulaire_Marché_Maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['Date_Debut_Marché_Maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['Date_Fin_Marché_Maintenance']) ?></td>
                        <td>
                            <a href="listeBaie.php?id=<?= $row['id'] ?>&action=supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette baie ?');">Supprimer</a>
                            <a href="modifierBaie.php?id=<?= $row['id'] ?>">Modifier</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table></div>

    </main>

    <footer>
        <p>&copy; 2024 ONEE BO - Tous droits réservés</p>
    </footer>
</body>
</html>
