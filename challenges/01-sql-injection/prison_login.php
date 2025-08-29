<?php
$host = "localhost";
$user = "root";
$pass = "you_cant_predict!";
$db = "prison";

$conn = new mysqli($host, $user, $pass, $db);

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "";
$error = "";
$login_status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Intentionally vulnerable SQL query
    $query = "SELECT * FROM prisoners WHERE username = '$username' AND password = '$password'";

    $res = $conn->query($query);

    if ($res) {
        if ($res->num_rows > 0) {
            $login_status = "✅ Login Successful!<br><br>Results:<br>";

            while ($row = $res->fetch_assoc()) {
                $login_status .= "<pre>" . htmlspecialchars(print_r($row, true)) . "</pre>";
            }
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Login - Prison Break</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: #eaeaea;
            background-image: url('https://i.imgur.com/hVtbr39.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        h1 {
            font-size: 3em;
            text-align: center;
            padding-top: 100px;
            font-weight: bold;
            color: #ffd700;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
        }

        .container {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            padding: 40px;
            width: 50%;
            margin: auto;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.7);
        }

        input {
            background-color: #333;
            color: #eaeaea;
            border: 1px solid #444;
            padding: 10px;
            width: 80%;
            font-size: 16px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        button {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #d32f2f;
        }

        .output {
            color: #f4f4f4;
            margin-top: 20px;
        }

        pre {
            background: #333;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            font-size: 14px;
            text-align: left;
            margin-top: 20px;
        }

        .status {
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            background-color: #333;
            color: #eaeaea;
        }

        .error {
            color: #ff6347;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Prison Break Login</h1>

        <form method="POST">
            <input type="text" name="username" placeholder="Enter username" required><br>
            <input type="password" name="password" placeholder="Enter password" required><br>
            <button type="submit">Login</button>
        </form>

        <div class="output">
            
            <?php if ($error): ?>
                <div class="status error">
                    <h2>Error:</h2>
                    <pre><?= htmlspecialchars($error) ?></pre>
                </div>
            <?php endif; ?>

            <?php if ($login_status): ?>
                <div class="status">
                    <h2>Status:</h2>
                    <div><?= $login_status ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
