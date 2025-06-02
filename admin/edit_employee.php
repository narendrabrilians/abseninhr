<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM employees WHERE id=$id LIMIT 1";
$res = $conn->query($sql);
$employee = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE employees SET name='$name', email='$email' WHERE id=$id";
    $conn->query($sql);
    header('Location: view_employees.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>AbseninHR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: white;
            color: #222;
            padding: 30px;
        }

        h2 {
            color: #0075FF;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #0075FF;
            font-weight: 600;
            margin-bottom: 20px;
            display: inline-block;
        }

        form {
            max-width: 400px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px 12px;
            margin-bottom: 16px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #0075FF;
            outline: none;
        }

        button {
            background-color: #0075FF;
            color: white;
            padding: 10px 18px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #005ecb;
        }
    </style>
</head>

<body>
    <h2>Edit Karyawan</h2>
    <a href="view_employees.php">⬅️ Kembali</a>
    <form method="POST">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?= $employee['name'] ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $employee['email'] ?>" required>

        <button type="submit">Update</button>
    </form>
</body>

</html>