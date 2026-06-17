<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie Achat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f9fa;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            color: #222;
        }

        .caisse-id {
            font-size: 14px;
            color: #666;
            background: #f0f2f5;
            padding: 8px 12px;
            border-radius: 6px;
            display: inline-block;
        }

        .form-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
            color: #222;
            font-size: 14px;
        }

        input[type="text"],
        input[type="number"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
            background: white;
            font-family: inherit;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="datetime-local"]:focus,
        select:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 32px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
            flex: 1;
        }

        .btn-primary {
            background: #0d6efd;
            color: white;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5c636a;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .panier-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .panier-section h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #222;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }

        th {
            padding: 12px;
            text-align: left;
            font-weight: 500;
            color: #222;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f9f9f9;
        }

        td:last-child {
            text-align: right;
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }

        .total-section {
            background: #f0f2f5;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-weight: 500;
            color: #222;
            font-size: 16px;
        }

        .total-amount {
            font-size: 22px;
            font-weight: 600;
            color: #0d6efd;
        }

        .footer-actions {
            display: flex;
            gap: 12px;
        }

        .footer-actions form {
            flex: 1;
        }

        .footer-actions button {
            width: 100%;
        }

        @media (max-width: 600px) {
            .header, .form-card, .panier-section {
                padding: 20px;
            }

            h1 {
                font-size: 22px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="text-align:center;margin-bottom:20px;">
            <a href="/home" style="color:#0d6efd;text-decoration:none;margin:0 10px;">Accueil</a>
            <a href="/liste-produits" style="color:#0d6efd;text-decoration:none;margin:0 10px;">Produits</a>
            <a href="/liste-achats" style="color:#0d6efd;text-decoration:none;margin:0 10px;">Achats</a>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div style="background:#f8d7da;color:#721c24;border:1px solid #f5c6cb;border-radius:6px;padding:12px;margin-bottom:20px;font-size:14px;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
            <div style="background:#d4edda;color:#155724;border:1px solid #c3e6cb;border-radius:6px;padding:12px;margin-bottom:20px;font-size:14px;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="header">
            <h1>Saisie Achat</h1>
            <span class="caisse-id">Id Caisse : <?= htmlspecialchars($idCaisse) ?></span>
        </div>

        <div class="form-card">
            <form method="post" action="/saisie-achat">
                <input type="hidden" name="idCaisse" value="<?= htmlspecialchars($idCaisse) ?>">
                
                <div class="form-group">
                    <label for="produit">Produit</label>
                    <select name="produit" id="produit" required>
                        <option value="">-- Sélectionner un produit --</option>
                        <?php foreach ($produits as $produit): ?>
                            <option value="<?= htmlspecialchars($produit['id']) ?>">
                                <?= htmlspecialchars($produit['label']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dateAchat">Date achat</label>
                    <input type="datetime-local" name="dateAchat" id="dateAchat" required>
                </div>

                <div class="form-group">
                    <label for="quantite">Quantité</label>
                    <input type="number" name="quantite" id="quantite" min="1" required>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-primary">Ajouter l'achat</button>
                </div>
            </form>
        </div>

        <div class="panier-section">
            <h2>Panier</h2>
            
            <?php if (count($panier) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($panier as $item): ?>
                            <?php $ligne = ($item['pu'] ?? 0) * ($item['qte'] ?? 0); ?>
                            <tr>
                                <td><?= htmlspecialchars($item['label']) ?></td>
                                <td><?= number_format($item['pu'], 0, ',', ' ') ?></td>
                                <td><?= $item['qte'] ?></td>
                                <td><?= number_format($ligne, 0, ',', ' ') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="total-section">
                    <span class="total-label">Total achat</span>
                    <span class="total-amount"><?= number_format($total, 0, ',', ' ') ?></span>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>Le panier est vide</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (count($panier) > 0): ?>
            <div class="footer-actions">
                <form method="post" action="/cloturer-achat">
                    <input type="hidden" name="idCaisse" value="<?= htmlspecialchars($idCaisse) ?>">
                    <button type="submit" class="btn-danger">Clôturer l'achat</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>