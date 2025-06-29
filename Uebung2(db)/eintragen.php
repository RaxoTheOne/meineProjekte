<?php
// Verbindung zur Datenbank
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formular1_uebung";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung prüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Werte aus dem Formular holen und bereinigen
$name = trim($_POST["name"]);
$nachricht = trim($_POST["nachricht"]);

// Fehlerliste
$fehler = [];

// Validierung
if (empty($name)) {
    $fehler[] = "Name darf nicht leer sein.";
}
if (empty($nachricht)) {
    $fehler[] = "Nachricht darf nicht leer sein.";
}

// Wenn Fehler vorhanden → anzeigen
if (!empty($fehler)) {
    echo "<h3>Fehler:</h3><ul>";
    foreach ($fehler as $meldung) {
        echo "<li>" . htmlspecialchars($meldung) . "</li>";
    }
    echo "</ul><a href='formular.html'>Zurück zum Formular</a>";
    exit;
}

// In Datenbank einfügen (wenn alles okay)
$sql = "INSERT INTO eintraege (name, nachricht) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $nachricht);

if ($stmt->execute()) {
    echo "<p style='color:green;'>Nachricht erfolgreich gespeichert!</p>";
} else {
    echo "<p style='color:red;'>Fehler beim Speichern: " . htmlspecialchars($stmt->error) . "</p>";
}

$stmt->close();
$conn->close();
?>
