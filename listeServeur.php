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
    $delete = $conn->prepare("DELETE FROM serveur WHERE id = ?");
    $delete->execute([$id]);
    $succesMsg = "Serveur supprimé avec succès";
}


$res = $conn->prepare("SELECT * FROM serveur ORDER BY id DESC");
$res->execute();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Serveurs - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("./link.php") ?>

    <main>
        <h1>Liste des Serveurs</h1>
        <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
        <div class="tab">         <table>
            <thead>
                <tr>
                    <th scope="col">Nom Machine</th>
                    <th scope="col">Désignation</th>
                    <th scope="col">Localisation</th>
                    <th scope="col">Position</th>
                    <th scope="col">Type</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Adresse IP</th>
                    <th scope="col">Responsable</th>
                    <th scope="col">Direction Métier</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">CPU</th>
                    <th scope="col">RAM (GO)</th>
                    <th scope="col">Capacité Disque</th>
                    <th scope="col">Système d'Exploitation</th>
                    <th scope="col">Langue</th>
                    <th scope="col">Marché Acquisition Num</th>
                    <th scope="col">Désignation Marché_Acquisition</th>
                    <th scope="col">Titulaire Marché_Acquisition </th>
                    <th scope="col">Date Début Marché_Acquisition</th>
                    <th scope="col">Date Fin Marché_Acquisition</th>
                    <th scope="col">Coût Acquisition</th>
                    <th scope="col">Marché Maintenance Num</th>
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
                        <th scope="row"><?= htmlspecialchars($row['Nom_Machine']) ?></th>
                        <td><?= htmlspecialchars($row['Designation']) ?></td>
                        <td><?= htmlspecialchars($row['Localisation']) ?></td>
                        <td><?= htmlspecialchars($row['Position']) ?></td>
                        <td><?= htmlspecialchars($row['Type']) ?></td>
                        <td><?= htmlspecialchars($row['Categorie']) ?></td>
                        <td><?= htmlspecialchars($row['Adresse_Ip']) ?></td>
                        <td><?= htmlspecialchars($row['Responsable']) ?></td>
                        <td><?= htmlspecialchars($row['Direction_Metier']) ?></td>
                        <td><?= htmlspecialchars($row['Marque']) ?></td>
                        <td><?= htmlspecialchars($row['Modele']) ?></td>
                        <td><?= htmlspecialchars($row['CPU']) ?></td>
                        <td><?= htmlspecialchars($row['RAM']) ?></td>
                        <td><?= htmlspecialchars($row['Capacite_Disque']) ?></td>
                        <td><?= htmlspecialchars($row['Systeme_Exploitation']) ?></td>
                        <td><?= htmlspecialchars($row['Langue']) ?></td>
                        <td><?= htmlspecialchars($row['Marché_Acquisition_Num']) ?></td>
                        <td><?= htmlspecialchars($row['Designation_Marché_Acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['Titulaire_Marché_Acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['Date_Debut_Marché_Acquisitioné']) ?></td>
                        <td><?= htmlspecialchars($row['Date_Fin_Marché_Acquisition']) ?></td>
                        <td><?= htmlspecialchars(number_format($row['Cout_Acquisition'], 2)) ?> €</td>
                        <td><?= htmlspecialchars($row['Marché_Maintenance_Num']) ?></td>
                        <td><?= htmlspecialchars($row['Designation_Marché_Maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['Titulaire_Marché_Maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['Date_Debut_Marché_Maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['Date_Fin_Marché_Maintenance']) ?></td>
                        <td>
                            <a href="modifierServeur.php?id=<?= $row['id'] ?>">Modifier</a>
                            <a href="listeServeur.php?id=<?= $row['id'] ?>&action=supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce serveur ?');">Supprimer</a>
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
