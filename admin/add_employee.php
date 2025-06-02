<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'user';

    $sql = "INSERT INTO employees (name, email, password, role) 
            VALUES ('$name', '$email', '$password', '$role')";
    $conn->query($sql);

    header('Location: view_employees.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>AbseninHR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #fff;
            padding: 30px 40px;
            color: #222;
        }

        h2 {
            color: #0075FF;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #0075FF;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            margin-top: 30px;
            max-width: 400px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            padding: 10px 20px;
            background-color: #0075FF;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background-color: #005ec2;
        }
    </style>
</head>

<body>

    <h2>Tambah Karyawan Baru</h2>
    <a href="view_employees.php">⬅️ Kembali</a>

    <form method="POST">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Simpan</button>
    </form>

</body>

</html>