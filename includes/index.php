<?php
// Include PDO connection
require_once("includes/connect.php");

try {
    // Get all projects from database (PDO)
    $sql = "SELECT * FROM project ORDER BY id ASC";
    $stmt = $pdo->query($sql);
    $projects = $stmt->fetchAll(); // Get all projects as array
} catch (PDOException $e) {
    die("Failed to fetch projects: " . $e->getMessage());
}
?>