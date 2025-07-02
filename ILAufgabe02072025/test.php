<?php require 'db.php'; ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Produktverwaltung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Produkt hinzufügen</h2>

    <form class="row g-3" method="POST" action="hinzufuegen.php">
        <div class="col-md-6">
            <label for="bezeichnung" class="form-label">Bezeichnung</label>
            <input type="text" class="form-control" id="bezeichnung" name="bezeichnung" required>
        </div>
        <div class="col-md-3">
            <label for="preis" class="form-label">Preis (€)</label>
            <input type="number" step="0.01" class="form-control" id="preis" name="preis" required>
        </div>
        <div class="col-md-3">
            <label for="kategorie" class="form-label">Kategorie</label>
            <select class="form-select" id="kategorie" name="kategorie" required>
                <option selected disabled>Bitte wählen</option>
                <option>Elektronik</option>
                <option>Bücher</option>
                <option>Haushalt</option>
                <option>Sonstiges</option>
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Produkt speichern</button>
        </div>
    </form>

    <hr class="my-5">

    <h2 class="mb-4">Produktliste</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Bezeichnung</th>
                <th>Preis (€)</th>
                <th>Kategorie</th>
                <th>Aktion</th>
            </tr>
        </thead>
        <tbody>
        <!-- Hier werden Produkte dynamisch geladen -->
        <?php
        // Löschen
        if (isset($_GET['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM produkte WHERE id = ?");
            $stmt->execute([$_GET['delete']]);
            header("Location: test.php");
            exit;
        }

        // Laden
        $stmt = $pdo->query("SELECT * FROM produkte ORDER BY id DESC");
        foreach ($stmt as $row):
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['bezeichnung']) ?></td>
                <td><?= number_format($row['preis'], 2, ',', '.') ?></td>
                <td><?= htmlspecialchars($row['kategorie']) ?></td>
                <td>
                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Wirklich löschen?');">Löschen</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
