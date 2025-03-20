<?php
session_start();
header("Content-Type: application/json");
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User belum login"]);
    exit;
}

$user_id = $_SESSION['user_id'];
var_dump($user_id);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM tb_list WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Tugas tidak ditemukan atau bukan milik Anda"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "ID tidak ditemukan"]);
}
?>
