<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>

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

        input[type="text"],
        input[type="password"] {
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

        .switch {
            margin-top: 15px;
            text-align: center;
            color: #0d6efd;
            cursor: pointer;
            font-size: 14px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>

    <div class="card">

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

        <h1 id="title">Login</h1>

        <form id="authForm" action="/login" method="post">

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <div id="confirmGroup" class="hidden">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password">
            </div>

            <input type="submit" id="submitBtn" value="Login">

        </form>

        <div class="switch" onclick="toggleMode()">
            Pas encore de compte ? Register
        </div>

    </div>

    <script>
        let isLogin = true;

        function toggleMode() {
            isLogin = !isLogin;

            const title = document.getElementById("title");
            const submitBtn = document.getElementById("submitBtn");
            const confirmGroup = document.getElementById("confirmGroup");
            const switchText = document.querySelector(".switch");
            const form = document.getElementById("authForm");
            const errorMsg = document.getElementById("errorMsg");

            if (errorMsg) errorMsg.remove();

            if (isLogin) {
                title.textContent = "Login";
                submitBtn.value = "Login";
                confirmGroup.classList.add("hidden");
                switchText.textContent = "Pas encore de compte ? Register";
                form.action = "/login";
            } else {
                title.textContent = "Register";
                submitBtn.value = "Register";
                confirmGroup.classList.remove("hidden");
                switchText.textContent = "Déjà un compte ? Login";
                form.action = "/register";
            }

            clearValidationStyles();
        }

        function clearValidationStyles() {
            const inputs = document.querySelectorAll('input[type="password"]');
            inputs.forEach(input => {
                input.style.borderColor = "#ccc";
                input.style.backgroundColor = "white";
            });
        }

        function validatePasswords() {
            if (!isLogin) {
                const password = document.querySelector('input[name="password"]');
                const confirmPassword = document.querySelector('input[name="confirm_password"]');

                if (password.value !== confirmPassword.value) {
                    password.style.borderColor = "#dc3545";
                    password.style.backgroundColor = "#ffe6e6";
                    confirmPassword.style.borderColor = "#dc3545";
                    confirmPassword.style.backgroundColor = "#ffe6e6";
                    return false;
                } else {
                    password.style.borderColor = "#28a745";
                    password.style.backgroundColor = "#e6ffe6";
                    confirmPassword.style.borderColor = "#28a745";
                    confirmPassword.style.backgroundColor = "#e6ffe6";
                    return true;
                }
            }
            return true;
        }

        function validateForm(event) {
            event.preventDefault();

            const username = document.querySelector('input[name="username"]').value.trim();
            const password = document.querySelector('input[name="password"]').value;
            let errorMsg = document.getElementById("errorMsg");

            // Supprimer ancien message d'erreur
            if (errorMsg) errorMsg.remove();

            // Validation username
            if (!username) {
                showError("Le nom d'utilisateur est requis");
                return false;
            }

            if (username.length < 1) {
                showError("Le nom d'utilisateur doit contenir au moins 3 caractères");
                return false;
            }

            // Validation password
            if (!password) {
                showError("Le mot de passe est requis");
                return false;
            }

            if (password.length < 1) {
                showError("Le mot de passe doit contenir au moins 4 caractères");
                return false;
            }

            // Validation en mode Register
            if (!isLogin) {
                const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

                if (!confirmPassword) {
                    showError("Veuillez confirmer votre mot de passe");
                    return false;
                }

                if (password !== confirmPassword) {
                    showError("Les mots de passe ne correspondent pas");
                    validatePasswords();
                    return false;
                }
            }

            // Si tout est valide, soumettre le formulaire
            document.getElementById("authForm").submit();
        }

        function showError(message) {
            const form = document.getElementById("authForm");
            const errorDiv = document.createElement("div");
            errorDiv.id = "errorMsg";
            errorDiv.style.cssText = `
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 6px;
        padding: 12px;
        margin-bottom: 20px;
        font-size: 14px;
    `;
            errorDiv.textContent = message;
            form.insertBefore(errorDiv, form.firstChild);
        }

        // Écouteurs d'événements
        document.addEventListener("DOMContentLoaded", function () {
            const passwordInput = document.querySelector('input[name="password"]');
            const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');
            const form = document.getElementById("authForm");

            form.addEventListener("submit", validateForm);

            // Validation en temps réel pour les mots de passe en mode Register
            passwordInput.addEventListener("input", function () {
                if (!isLogin) {
                    validatePasswords();
                }
            });

            confirmPasswordInput.addEventListener("input", function () {
                if (!isLogin) {
                    validatePasswords();
                }
            });

            // Nettoyer les styles quand on focus
            passwordInput.addEventListener("focus", function () {
                if (isLogin) {
                    this.style.borderColor = "#ccc";
                    this.style.backgroundColor = "white";
                }
            });

            confirmPasswordInput.addEventListener("focus", function () {
                if (!isLogin) {
                    validatePasswords();
                }
            });
        });
    </script>

</body>

</html>