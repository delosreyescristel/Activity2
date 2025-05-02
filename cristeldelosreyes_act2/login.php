<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">

        <div class="left-panel">
            <h1>Welcome Back!</h1>
            <p>Log In Now!</p>
        </div>

        <div class="form-container">
            <form id="loginForm" action="login_process.php" method="POST">
                <h1>Login to Your Account</h1>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert error" id="alertMessage"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert success" id="alertMessage"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>

                <div class="infield">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="infield">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" name="login">Sign In</button>
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
            </form>
        </div>
    </div>

    <script>
        setTimeout(() => {
            let alertMessage = document.getElementById("alertMessage");
            if (alertMessage) {
                alertMessage.style.transition = "opacity 0.5s ease";
                alertMessage.style.opacity = "0";
                setTimeout(() => alertMessage.style.display = "none", 500);
            }
        }, 5000);
    </script>

</body>
</html>
