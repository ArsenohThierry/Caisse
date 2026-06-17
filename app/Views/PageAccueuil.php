<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix de la caisse</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f6f9;
        }

        .card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #0d6efd;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #0b5ed7;
        }

        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 16px;
            background: white;
        }
    </style>
</head>

<body>

    <div class="card">
        <h1>Choix de la caisse</h1>

        <form action="/achats">
            <label for="caisse">Numéro de caisse</label>

            <select name="caisse" id="caisse" required>
                <option value="">-- Sélectionner une caisse --</option>
                <option value="1">Caisse 1</option>
                <option value="2">Caisse 2</option>
            </select>

            <input type="submit" value="Valider">
        </form>
    </div>

    


</body>

</html>