<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            justify-content: center;
            align-items: center;
            margin: 0;
            height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
            display: flex;
        }

        .login-container {
            background-color: #cce5ff;
            padding: 30px 30px 7px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color:#000;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cce5ff;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .signup {
            text-align: left;
            font-size: 15px;
        }

        .signup a {
            text-decoration: none;
            color: #007bff
        }

        .button {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .button button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            margin-bottom: 20px;
        }

        #submitBtn:hover {
            background-color: #0056b3;
        }

        .error {
            color: #D8000C;
            background-color: #FFD2D2;
            border: 1px solid #D8000C;
            padding: 8px;
            margin-top: 5px;
            font-size: 14px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .error-icon {
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <h2> Sign in </h2>
        <form action="proses/sign_in.php" method="POST">
        <div class="input-group">
            <label for="username"></label>
            <input type="username" id="username" name="username" placeholder="Username" autocomplete="off" required>
        </div>

        <div class="input-group">
            <label for="password">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </label>
            </div>

         <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><span class="error-icon">❌</span> <?= $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="signup">
            <p> Doesn't have an account? <a href="signup.php"> Sign up </a></p>
        </div>

        <div class="button">
            <button type="submit" id="submitBtn"> Login </button>
        </div>
    </div>
</form>
</body>
</html>