<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $conn->query("UPDATE employees SET name='$name', email='$email' WHERE id=$user_id");
    header('Location: view_profile.php');
    exit;
}

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
            margin-bottom: 24px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #005fd1;
        }

        form {
            max-width: 600px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            margin-top: 20px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            margin-top: 30px;
            padding: 12px 20px;
            background-color: #0075FF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #005fd1;
        }
    </style>
</head>

<body>
    <h2>Edit Profil Saya</h2>
    <a href="view_profile.php">⬅️ Kembali</a>
    <form method="POST" action="">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?= $user['name'] ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>

        <button type="submit">Simpan</button>
    </form>
</body>

</html>