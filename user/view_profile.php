<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM employees WHERE id=$user_id LIMIT 1";
$user = $conn->query($sql)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>AbseninHR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #fff;
            padding: 40px 20px;
            color: #000;
        }

        h2 {
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 24px;
        }

        a {
            text-decoration: none;
            color: #0075FF;
            font-weight: 600;
            margin-right: 12px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #005fd1;
        }

        .profile-item {
            margin-bottom: 16px;
            font-size: 18px;
        }

        label {
            font-weight: 600;
            color: #555;
        }
    </style>
</head>

<body>
    <h2>Profil Saya</h2>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="edit_profile.php">✏️ Edit Profil</a>
    <br /><br />
    <div class="profile-item"><label>Nama:</label> <?= $user['name'] ?></div>
    <div class="profile-item"><label>Email:</label> <?= $user['email'] ?></div>
</body>

</html>