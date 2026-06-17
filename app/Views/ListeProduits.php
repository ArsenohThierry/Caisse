<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; }
        body { background: #f4f6f9; padding: 30px; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { text-align: center; margin-bottom: 25px; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; color: #555; }
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
            <h1>Liste des produits</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>Prix unitaire</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><?= htmlspecialchars($p['label']) ?></td>
                            <td><?= number_format($p['pu'], 0, ',', ' ') ?> F</td>
                            <td><?= $p['qteStock'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
