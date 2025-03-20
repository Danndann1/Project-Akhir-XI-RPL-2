<?php
session_start();
$conn = new mysqli("localhost", "root", "", "dbtodolist");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        $_SESSION['error'] = "Data tidak lengkap!";
        header("Location: ../signin.php");
        exit();
    }

    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    $sql = "SELECT id, username, password FROM tb_signup WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            error_log("User login berhasil: " . $_SESSION['user_id']);
            var_dump($_SESSION);

            header("Location: ../home.php");
            exit();
        } else {
            $_SESSION['error'] = "Password salah!";
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan!";
    }

    header("Location: ../signin.php");
    exit();
}

$conn->close();
?>
