<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">

        <div class="left-panel">
            <h1>Welcome Back!</h1>
            <p>Sign Up Now!</p>
        </div>

        <div class="form-container">
            <form id="registrationForm" action="register_process.php" method="POST">
                <h1>Create Account</h1>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert success" id="alertMessage"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert error" id="alertMessage"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <div class="infield">
                    <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
                </div>
                <div class="infield">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="infield">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="infield">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" name="register">Sign Up</button>
                <a href="login.php">Sign In</a>
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