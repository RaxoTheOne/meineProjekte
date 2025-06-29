<!-- verarbeite.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]); // Sicherstellen, dass der Name sicher ist Schütz vor XSS
    echo "Hallo, $name!";
} else {
    echo "<p>Keine Daten empfangen.</p>";
}
?>
<!-- -->