<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie Achat</title>
</head>
<body>
    <h1>Saisie Achat</h1>
    <h1>Id Caisse : <?= $idCaisse ?></h1>
    <form method="post" action="/saisie-achat">

        <label for="produit">Produit:</label>
        <select name="produit" id="produit" required>
            <?php foreach ($produits as $produit): ?>
                <option value="<?= $produit['label'] ?>"><?= htmlspecialchars($produit['label']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="dateAchat">Date achat:</label>
        <input type="datetime-local" name="dateAchat" id="dateAchat" required>

        <label for="quantite">Quantité:</label>
        <input type="number" name="quantite" id="quantite" required>

        <button type="submit">Ajouter l'achat</button>
    </form>
</body>
</html>