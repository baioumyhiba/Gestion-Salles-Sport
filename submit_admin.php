<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tp_si";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO administrateur (NOM_ADMIN, PRENOM_ADMIN, ADR_ADMIN, TELE_ADMIN) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Erreur lors de la préparation de la requête SQL: " . $conn->error);
    }
    
    $stmt->bind_param("ssss", $nom, $prenom, $adresse, $telephone);
    
    if ($stmt->execute()) {
        echo "Nouvel administrateur ajouté avec succès.";
    } else {
        echo "Erreur: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
