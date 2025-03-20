<?php
session_start();
$host = 'localhost';
$dbname = 'dbtodolist';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["error" => "User belum login"]);
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM tb_list WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tasks);
} catch (PDOException $e) {
    echo json_encode(["error" => "Gagal mengambil data: " . $e->getMessage()]);
}
?>
