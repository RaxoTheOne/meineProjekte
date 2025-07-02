<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $stmt = $pdo->prepare("INSERT INTO produkte (bezeichnung, preis, kategorie) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['bezeichnung'],
        $_POST['preis'],
        $_POST['kategorie']
    ]);
    header("Location: test.php");
    exit;
}
?>