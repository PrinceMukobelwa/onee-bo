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
    $delete = $conn->prepare("DELETE FROM licences WHERE id = ?");
    $delete->execute([$id]);
    $succesMsg = "Licence supprimée avec succès";
}

$res = $conn->prepare("SELECT * FROM licences ORDER BY id DESC");
$res->execute();
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
    <?php include("./link.php") ?>

    <main>
        <h1>Liste des licences</h1>
        <?php if (isset($succesMsg)) { echo "<p>$succesMsg</p>"; } ?>
        <div class="tab">
    <table>
        <thead>
            <tr>
                <th scope="col">Nom du logiciel</th>
                <th scope="col">Clé de licence</th>
                <th scope="col">Type de licence</th>
                <th scope="col">Nombre de serveurs</th>
                <th scope="col">Date de début</th>
                <th scope="col">Date de fin</th>
                <th scope="col">Titulaire</th>
                <th scope="col">Fournisseur</th>
                <th scope="col">Coût de la licence (€)</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $res->fetch()) { ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($row['nLogiciel']) ?></th>
                    <td><?= htmlspecialchars($row['kLicences']) ?></td>
                    <td><?= htmlspecialchars($row['tLicences']) ?></td>
                    <td><?= htmlspecialchars($row['nServeur']) ?></td>
                    <td><?= htmlspecialchars($row['dDebut']) ?></td>
                    <td><?= htmlspecialchars($row['dFin']) ?></td>
                    <td><?= htmlspecialchars($row['titulaireL']) ?></td>
                    <td><?= htmlspecialchars($row['fourniseur']) ?></td>
                    <td><?= htmlspecialchars(number_format($row['coutL'], 2)) ?> € </td>
                    <td>
                        <a href="modifierLicence.php?id=<?= $row['id'] ?>">Modifier</a>
                        <a href="listeLicences.php?id=<?= $row['id'] ?>&action=supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette licence ?');">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
    </main>

    <footer>
        <p>&copy; 2024 ONEE BO - Tous droits réservés</p>
    </footer>
</body>
</html>
