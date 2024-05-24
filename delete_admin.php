<?php
// Vérifiez d'abord si un ID est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirigez l'utilisateur vers la page de liste des administrateurs s'il manque l'ID
    header("Location: list_admin.php");
    exit();
}

// Récupérez l'ID de l'administrateur à supprimer
$id_admin = $_GET['id'];

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

// Suppression de l'administrateur de la base de données
$sql = "DELETE FROM administrateur WHERE ID_ADMIN = $id_admin";

if ($conn->query($sql) === TRUE) {
    header("Location: list_admin.php");
} else {
    echo "Erreur lors de la suppression de l'administrateur: " . $conn->error;
}

// Fermeture de la connexion
$conn->close();
?>
