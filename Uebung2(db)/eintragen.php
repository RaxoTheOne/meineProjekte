<?php
// Verbindung zur Datenbank
$servername = "localhost";
$username = "root"; // Standard in XAMPP
$password = "";     // kein Passwort in XAMPP
$dbname = "formular1_uebung";

// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung prüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Werte aus dem Formular holen
$name = $_POST["name"];
$nachricht = $_POST["nachricht"];

// Einfügen in die Datenbank
$sql = "INSERT INTO eintraege (name, nachricht) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $nachricht);

if ($stmt->execute()) {
    echo "Nachricht erfolgreich gespeichert!";
} else {
    echo "Fehler: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
