<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie des Achats</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        select {
            cursor: pointer;
            background: white;
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 25px;
        }

        button {
            padding: 10px 30px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-valider {
            background: #6c757d;
            color: white;
        }

        .btn-valider:hover {
            background: #5a6268;
        }

        .btn-reset {
            background: #e74c3c;
            color: white;
        }

        .btn-reset:hover {
            background: #c0392b;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-delete:hover {
            background: #c0392b;
        }

        table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
        }

        th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
            background: #e9ecef;
        }

        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        .montant {
            text-align: right;
            font-weight: bold;
        }

        .total-row {
            background: #f8f9fa;
            font-weight: bold;
        }

        .total-row td {
            text-align: right;
            padding: 12px;
        }

        .empty-message {
            text-align: center;
            padding: 30px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Créer la page de saisie des achats</h1>

    <form id="achatForm">
        <div class="form-group">
            <label for="produit">Produit</label>
            <select id="produit" required>
                <option value="">-- Sélectionner un produit --</option>
                <option value="Biscuit|1000">Biscuit - 1000 Ar</option>
                <option value="Pain|400">Pain - 400 Ar</option>
                <option value="Lait|800">Lait - 800 Ar</option>
                <option value="Fromage|2500">Fromage - 2500 Ar</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" id="quantite" min="1" required>
        </div>

        <div class="button-group">
            <button type="button" class="btn-valider" onclick="ajouterAchat()">Valider</button>
            <button type="reset" class="btn-reset" onclick="reinitialiser()">Réinitialiser</button>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix Unit</th>
                <th>Qté</th>
                <th>Montant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <tr class="empty-message">
                <td colspan="5">Aucun achat ajouté</td>
            </tr>
        </tbody>
    </table>

    <div id="totalDiv"></div>
</div>

<script>
    let achats = [];

    function ajouterAchat() {
        const produitSelect = document.getElementById('produit');
        const quantite = parseInt(document.getElementById('quantite').value);

        if (!produitSelect.value || !quantite || quantite <= 0) {
            alert('Veuillez remplir tous les champs correctement');
            return;
        }

        const [produit, prix] = produitSelect.value.split('|');
        const prixUnit = parseInt(prix);
        const montant = prixUnit * quantite;

        achats.push({
            produit,
            prixUnit,
            quantite,
            montant
        });

        afficherTableau();
        reinitialiser();
        produitSelect.focus();
    }

    function supprimerAchat(index) {
        achats.splice(index, 1);
        afficherTableau();
    }

    function afficherTableau() {
        const tbody = document.getElementById('tableBody');
        const totalDiv = document.getElementById('totalDiv');

        if (achats.length === 0) {
            tbody.innerHTML = '<tr class="empty-message"><td colspan="5">Aucun achat ajouté</td></tr>';
            totalDiv.innerHTML = '';
            return;
        }

        let html = '';
        let total = 0;

        achats.forEach((achat, index) => {
            total += achat.montant;
            html += `
                <tr>
                    <td>${achat.produit}</td>
                    <td>${achat.prixUnit}</td>
                    <td>${achat.quantite}</td>
                    <td class="montant">${achat.montant}</td>
                    <td><button type="button" class="btn-delete" onclick="supprimerAchat(${index})">Supprimer</button></td>
                </tr>
            `;
        });

        tbody.innerHTML = html;

        totalDiv.innerHTML = `
            <table style="margin-top: 0;">
                <tr class="total-row">
                    <td colspan="4">Total</td>
                    <td class="montant">${total}</td>
                </tr>
            </table>
        `;
    }

    function reinitialiser() {
        document.getElementById('achatForm').reset();
        document.getElementById('produit').focus();
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('produit').focus();
    });

    // Enter pour ajouter
    document.getElementById('quantite').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') ajouterAchat();
    });
</script>

</body>
</html>