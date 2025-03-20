<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["task_id"];
    $task_name = $_POST["task_name"];
    $category = $_POST["category"];
    $due_date_day = $_POST["due_date_day"];
    $due_date_time = $_POST["due_date_time"];

    if (!empty($id)) {
        $query = "UPDATE tb_list SET task_name = ?, category = ?, due_date_day = ?, due_date_time = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $task_name, $category, $due_date_day, $due_date_time, $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "id" => $id, "task_name" => $task_name, "category" => $category, "due_date_day" => $due_date_day, "due_date_time" => $due_date_time]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal update data"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Task ID tidak ditemukan"]);
    }
    
    $conn->close();
}
?>
