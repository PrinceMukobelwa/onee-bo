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
    $delete = $conn->prepare("DELETE FROM robot WHERE id = ?");
    $delete->execute([$id]);
    $succesMsg = "Robot supprimé avec succès";
}


$res = $conn->prepare("SELECT * FROM robot ORDER BY id DESC");
$res->execute();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Robots - ONEE BO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("./link.php") ?>

    <main>
        <h1>Liste des Robots</h1>
        <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
        <div class="tab">         <table>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Désignation</th>
                    <th scope="col">Localisation</th>
                    <th scope="col">Adresse IP</th>
                    <th scope="col">Responsable</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Génération</th>
                    <th scope="col">Nombre de Lecteurs</th>
                    <th scope="col">Nombre de Cartouches</th>
                    <th scope="col">N° Marché Acquisition</th>
                    <th scope="col">Désignation Marché Acquisition</th>
                    <th scope="col">Titulaire Marché Acquisition</th>
                    <th scope="col">Date Début Marché Acquisition</th>
                    <th scope="col">Date Fin Marché Acquisition</th>
                    <th scope="col">Coût Acquisition (€)</th>
                    <th scope="col">N° Marché Maintenance</th>
                    <th scope="col">Désignation Marché Maintenance</th>
                    <th scope="col">Titulaire Marché Maintenance</th>
                    <th scope="col">Date Début Marché Maintenance</th>
                    <th scope="col">Date Fin Marché Maintenance</th>
                    <th scope="col">Coût Maintenance (€)</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $res->fetch()) { ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($row['nom']) ?></th>
                        <td><?= htmlspecialchars($row['designation']) ?></td>
                        <td><?= htmlspecialchars($row['localisation']) ?></td>
                        <td><?= htmlspecialchars($row['adresse_ip']) ?></td>
                        <td><?= htmlspecialchars($row['responsable']) ?></td>
                        <td><?= htmlspecialchars($row['marque']) ?></td>
                        <td><?= htmlspecialchars($row['modele']) ?></td>
                        <td><?= htmlspecialchars($row['generation']) ?></td>
                        <td><?= htmlspecialchars($row['lecteurs']) ?></td>
                        <td><?= htmlspecialchars($row['cartouches']) ?></td>
                        <td><?= htmlspecialchars($row['num_marche_acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['designation_marche_acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['titulaire_marche_acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['debut_marche_acquisition']) ?></td>
                        <td><?= htmlspecialchars($row['fin_marche_acquisition']) ?></td>
                        <td><?= htmlspecialchars(number_format($row['cout_acquisition'], 2)) ?> €</td>
                        <td><?= htmlspecialchars($row['num_marche_maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['designation_marche_maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['titulaire_marche_maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['debut_marche_maintenance']) ?></td>
                        <td><?= htmlspecialchars($row['fin_marche_maintenance']) ?></td>
                        <td><?= htmlspecialchars(number_format($row['cout_maintenance'], 2)) ?> €</td>
                        <td>
                            <a href="modifierRobot.php?id=<?= $row['id'] ?>">Modifier</a>
                            <a href="listeRobot.php?id=<?= $row['id'] ?>&action=supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce robot?');">Supprimer</a>
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
