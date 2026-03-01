<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin_dashboard.php');
    exit;
}

// Import PDO connection
require_once("includes/connect.php");

$login_error = '';

// Handle login submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    try {
        // Get admin from database
        $sql = "SELECT * FROM admin WHERE username = :username LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $admin = $stmt->fetch();

        // Verify password (simplified - use password_hash in production)
        if ($admin && $admin['password'] === $password) {
            // Set session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: admin_dashboard.php');
            exit;
        } else {
            $login_error = "Invalid username or password";
        }
    } catch (PDOException $e) {
        $login_error = "Database error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Yi Cheng</title>
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 5rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .error-msg {
            color: #D8000C;
            background: #FFCCCB;
            padding: 0.5rem;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body style="background-color: #F8F8F8;">
    <div class="login-container">
        <h1 class="text-2xl mb-4 text-center" style="font-family: 'Poppins', sans-serif; color: #0D0D0D;">Admin Login</h1>
        
        <?php if ($login_error): ?>
            <div class="error-msg"><?php echo htmlspecialchars($login_error); ?></div>
        <?php endif; ?>

        <form method="POST" action="admin_login.php" class="space-y-4">
            <div>
                <label for="username" class="block text-sm mb-1" style="color: #6E7B8B;">Username</label>
                <input type="text" id="username" name="username" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none" 
                    style="border-color: #6E7B8B;"
                    onfocus="this.style.borderColor='#FF6F61'" 
                    onblur="this.style.borderColor='#6E7B8B'">
            </div>
            <div>
                <label for="password" class="block text-sm mb-1" style="color: #6E7B8B;">Password</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none" 
                    style="border-color: #6E7B8B;"
                    onfocus="this.style.borderColor='#FF6F61'" 
                    onblur="this.style.borderColor='#6E7B8B'">
            </div>
            <button type="submit" class="w-full px-4 py-2 rounded-full text-sm" 
                style="background-color: #FF6F61; color: #FFFFFF;"
                onmouseover="this.style.backgroundColor='#FF8A7A'" 
                onmouseout="this.style.backgroundColor='#FF6F61'">
                Login
            </button>
        </form>
    </div>
</body>
</html>