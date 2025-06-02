<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    $conn->query("INSERT INTO leave_requests (employee_id, start_date, end_date, reason, status) VALUES ($user_id, '$start_date', '$end_date', '$reason', 'Pending')");
    $success = "Pengajuan cuti berhasil dikirim.";
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
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f0f6ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            color: #000;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .success {
            background-color: #e0ffe0;
            color: #008000;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 16px;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            color: #0075FF;
            text-decoration: none;
            font-size: 14px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            margin-top: 16px;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 8px;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0075FF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #005fd1;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Ajukan Cuti</h2>
        <a href="dashboard.php">🏠 Dashboard</a>

        <?php if (isset($success)): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" name="start_date" required>

            <label for="end_date">Tanggal Selesai</label>
            <input type="date" name="end_date" required>

            <label for="reason">Alasan</label>
            <textarea name="reason" required></textarea>

            <button type="submit">Kirim Pengajuan</button>
        </form>
    </div>

</body>

</html>