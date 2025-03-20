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
    $task_name = $_POST['task_name'];
    $category = $_POST['category'];
    $due_date_day = $_POST['due_date_day'];
    $due_date_time = $_POST['due_date_time'];

    $query = "INSERT INTO tb_list (user_id, task_name, category, due_date_day, due_date_time) 
              VALUES (:user_id, :task_name, :category, :due_date_day, :due_date_time)";
    $stmt = $conn->prepare($query);
    
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':task_name', $task_name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':due_date_day', $due_date_day);
    $stmt->bindParam(':due_date_time', $due_date_time);

    if ($stmt->execute()) {
        $task_id = $conn->lastInsertId();

        echo json_encode([
            "success" => true,
            "id" => $task_id, 
            "task_name" => $task_name,
            "category" => $category,
            "due_date_day" => $due_date_day,
            "due_date_time" => $due_date_time
        ]);
    } else {
        echo json_encode(["error" => "Gagal menambahkan tugas"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Gagal menyimpan data: " . $e->getMessage()]);
}
?>
