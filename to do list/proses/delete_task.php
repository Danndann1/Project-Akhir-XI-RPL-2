<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode(["success" => false, "message" => "ID tidak ditemukan"]);
        exit;
    }

    $taskId = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM tb_list WHERE id = ?");
    $stmt->bind_param("i", $taskId);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menghapus"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid Request"]);
}
