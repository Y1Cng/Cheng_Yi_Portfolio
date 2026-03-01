<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Import PDO connection
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get raw JSON data (for AJAX)
    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    // Fallback for traditional form submission (if needed)
    if (!$data) {
        $data = $_POST;
    }

    // Get and sanitize form data
    $name = trim(strip_tags($data["name"] ?? ""));
    $phone = trim(strip_tags($data["phone"] ?? ""));
    $email = filter_var(trim($data["email"] ?? ""), FILTER_SANITIZE_EMAIL);
    $message = trim(strip_tags($data["message"] ?? ""));
    $date = date("Y-m-d H:i:s");

    // Validation
    $errors = [];
    if (empty($name)) $errors[] = "Name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($message)) $errors[] = "Message is required.";
    if (empty($phone)) $errors[] = "Phone number is required.";

    if (!empty($errors)) {
        // For AJAX: return JSON error
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => implode(" ", $errors)]);
        exit;
    }

    try {
        // PDO prepared statement (prevent SQL injection)
        $sql = "INSERT INTO message (name, email, created, message, phone) 
                VALUES (:name, :email, :created, :message, :phone)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':created' => $date,
            ':message' => $message,
            ':phone' => $phone
        ]);

        // For AJAX: return JSON success
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => "Thank you, $name! Your message has been sent."]);
        exit;

    } catch (PDOException $e) {
        // Database error
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => "Database error: " . $e->getMessage()]);
        exit;
    }
}

// If not POST request
header('Content-Type: application/json');
echo json_encode(['status' => 'error', 'message' => "Invalid request method."]);
exit;
?>