<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tp_si";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupération des administrateurs depuis la base de données
$sql = "SELECT * FROM administrateur";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="list_admin.css">
    <title>Liste des Administrateurs</title>
</head>
<body>
    <h2>Liste des Administrateurs</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Affichage des administrateurs dans le tableau
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["NOM_ADMIN"] . "</td>";
                    echo "<td>" . $row["PRENOM_ADMIN"] . "</td>";
                    echo "<td>" . $row["ADR_ADMIN"] . "</td>";
                    echo "<td>" . $row["TELE_ADMIN"] . "</td>";
                    echo "<td>";
                    echo "<a href='delete_admin.php?id=" . $row["ID_ADMIN"] . "' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?')\">Supprimer</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun administrateur trouvé</td></tr>";
            }
            ?>
            
        </tbody>
    </table>
</body>
</html>

<?php
// Fermeture de la connexion
$conn->close();
?>
