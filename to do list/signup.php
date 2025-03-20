<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign Up </title>
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

        .box-container {
            background-color: #cce5ff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .box-container h2 {
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

        .button {
            display: flex;
            justify-content: space-between;
        }

        .button button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        #cancelBtn:hover {
            background-color: #0056b3;
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
            margin-bottom: 13px;
        }
        .error-icon {
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="box-container">
            <h2> Sign Up </h2>

            <form action="proses/sign_up.php" method="POST">
            <div class="input-group">
            <label for="username"></label>
            <input type="text" id="username" name="username" placeholder="Username" autocomplete="off" required>
            </div>

            <div class="input-group">
            <label for="email"></label> 
            <input type="email" id="email" name="email" placeholder="Email" autocomplete="off" required>
            </div>

            <div class="input-group">
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <?php 
            session_start();
            if (isset($_SESSION['error'])): ?>
                <div class="error"><span class="error-icon">❌</span> <?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

            <div class="button">
                <button type="submit" id="submitBtn"> Sign </button>
            </div>
    </div>
</form>
</body>
</html>