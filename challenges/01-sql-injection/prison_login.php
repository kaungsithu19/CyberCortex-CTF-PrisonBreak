<?php
/**
 * Prison Break — Intentionally Vulnerable Login (SQLi Stage)
 * NOTE: This file is DELIBERATELY INSECURE for training purposes.
 * Do NOT deploy to the public internet.
 *
 * Setup:
 *   - Create DB using challenges/01-sql-injection/setup.sql
 *   - Update the placeholder credentials below to match your lab.
 */

$host = "localhost";          // e.g., "127.0.0.1"
$user = "root";               // e.g., "root"
$pass = "changeme!";          // <-- PLACEHOLDER (intentionally weak for the lab)
$db   = "prison";             // created by setup.sql

// Safety toggle to avoid accidental production exposure
$ENABLE_VULN_LOGIN = true;    // set to false to immediately exit

if (!$ENABLE_VULN_LOGIN) {
    http_response_code(503);
    die("This intentionally vulnerable page is disabled. Enable \$ENABLE_VULN_LOGIN to use it in a lab.");
}

mysqli_report(MYSQLI_REPORT_OFF); // keep errors quiet in output; we surface them manually
$conn = @new mysqli($host, $user, $pass, $db);

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}

$query = "";
$error = "";
$login_status = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // ⚠️ INTENTIONALLY VULNERABLE: unsanitized string interpolation (SQL Injection)
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Vulnerable Login - Prison Break</title>
  <style>
    body {
      font-family: 'Courier New', Courier, monospace;
      margin: 0; padding: 0;
      background-color: #1a1a1a; color: #eaeaea;
      background-image: url('https://i.imgur.com/hVtbr39.jpg');
      background-size: cover; background-position: center; min-height: 100vh;
      display: flex; align-items: center; justify-content: center;
    }
    .container {
      width: min(680px, 92%); margin: 40px auto;
      background-color: rgba(0,0,0,0.7);
      border-radius: 12px; padding: 32px;
      box-shadow: 0 0 18px rgba(0,0,0,0.65);
    }
    h1 { margin: 0 0 6px; color: #ffd700; text-align: center; }
    .banner {
      margin: 10px 0 24px; padding: 12px 14px; border-radius: 8px;
      background: #2a1f00; color: #ffd700; border: 1px solid #5b4300;
      font-size: 14px; text-align: center;
    }
    input, button {
      width: 100%; font-size: 16px; border-radius: 6px;
      padding: 12px; box-sizing: border-box;
    }
    input {
      background: #2c2c2c; color: #eee; border: 1px solid #444; margin: 8px 0 14px;
    }
    button {
      background: #f44336; color: #fff; border: 0; cursor: pointer;
    }
    button:hover { background: #d32f2f; }
    .status { margin-top: 18px; padding: 16px; border-radius: 10px; background: #222; }
    .error { color: #ff6347; }
    pre {
      background: #333; color: #fff; padding: 12px; border-radius: 6px;
      overflow-x: auto;
    }
    .sql {
      margin-top: 16px; font-size: 13px; color: #c9c9c9;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Prison Break Login</h1>
    <div class="banner">
      ⚠️ <strong>Training Only:</strong> This page is intentionally vulnerable to SQL Injection for CTF practice. Use in an isolated lab.
    </div>

    <form method="POST" autocomplete="off">
      <input type="text" name="username" placeholder="Enter username" required />
      <input type="password" name="password" placeholder="Enter password" required />
      <button type="submit">Login</button>
    </form>

    <div class="sql">
      <em>Executed query (vulnerable):</em><br>
      <code><?= htmlspecialchars($query) ?></code>
    </div>

    <?php if ($error): ?>
      <div class="status error">
        <h3>Error</h3>
        <pre><?= htmlspecialchars($error) ?></pre>
      </div>
    <?php endif; ?>

    <?php if ($login_status): ?>
      <div class="status">
        <h3>Status</h3>
        <div><?= $login_status ?></div>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
