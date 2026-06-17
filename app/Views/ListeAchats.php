<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des achats</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; }
        body { background: #f4f6f9; padding: 30px; }
        .container { max-width: 900px; margin: 0 auto; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 20px; }
        h1 { text-align: center; margin-bottom: 25px; color: #333; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        select, input[type="submit"] { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 16px; }
        input[type="submit"] { background: #0d6efd; color: white; cursor: pointer; margin-top: 10px; }
        input[type="submit"]:hover { background: #0b5ed7; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; font-size: 14px; }
        th { background: #f8f9fa; font-weight: 600; color: #555; }
        .achat-header { background: #e8f0fe; font-weight: 600; }
        .achat-header td { padding: 8px 10px; }
        .total { text-align: right; font-weight: 600; margin-top: 10px; }
        .empty { text-align: center; color: #999; padding: 30px; }
        .nav { text-align: center; margin-bottom: 20px; }
        .nav a { color: #0d6efd; text-decoration: none; margin: 0 10px; }
        .nav a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/home">Accueil</a>
            <a href="/liste-produits">Produits</a>
            <a href="/liste-achats">Achats</a>
        </div>

        <div class="card">
            <h1>Liste des achats</h1>
            <form method="get" action="/liste-achats">
                <label for="caisse">Caisse</label>
                <select name="caisse" id="caisse" required>
                    <option value="">-- Sélectionner une caisse --</option>
                    <?php foreach ($caisses as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= $idCaisse === (int) $c['id'] ? 'selected' : '' ?>>
                            Caisse <?= $c['id'] ?> <?= htmlspecialchars($c['designation']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Voir les achats">
            </form>
        </div>

        <?php if ($idCaisse > 0): ?>
            <div class="card">
                <?php if (empty($achats)): ?>
                    <div class="empty">Aucun achat pour cette caisse.</div>
                <?php else: ?>
                    <?php foreach ($achats as $a): ?>
                        <table>
                            <tr class="achat-header">
                                <td colspan="4">Achat #<?= $a['id'] ?> — <?= date('d/m/Y H:i', strtotime($a['dateAchat'])) ?> — Total: <?= number_format($a['total'], 0, ',', ' ') ?> F</td>
                            </tr>
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>PU</th>
                                    <th>Qté</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($a['produits'] as $ap): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($ap['label']) ?></td>
                                        <td><?= number_format($ap['puProduit'], 0, ',', ' ') ?> F</td>
                                        <td><?= $ap['qte'] ?></td>
                                        <td><?= number_format($ap['qte'] * $ap['puProduit'], 0, ',', ' ') ?> F</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <br>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
