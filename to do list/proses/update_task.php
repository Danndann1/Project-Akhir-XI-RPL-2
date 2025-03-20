<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'dbtodolist';
$username = 'root';
$password = '';


if (!isset($_POST['task_id'], $_POST['task_name'], $_POST['category'], $_POST['due_date_day'], $_POST['due_date_time'])) {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap"]);
    exit();
}

$task_id = $_POST['task_id'];
$task_name = $_POST['task_name'];
$category = $_POST['category'];
$due_date_day = $_POST['due_date_day'];
$due_date_time = $_POST['due_date_time'];

$query = "UPDATE tb_list SET task_name = :task_name, category = :category, due_date_day = :due_date_day, due_date_time = :due_date_time WHERE id = :task_id";
$stmt = $conn->prepare($query);

$stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
$stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->bindParam(':due_date_day', $due_date_day, PDO::PARAM_STR);
$stmt->bindParam(':due_date_time', $due_date_time, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "id" => $task_id,
        "task_name" => $task_name,
        "category" => $category,
        "due_date_day" => $due_date_day,
        "due_date_time" => $due_date_time
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal mengupdate tugas."]);
}
exit();
?>
