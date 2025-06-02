<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$tanggal = date('Y-m-d');
$check = $conn->query("SELECT * FROM attendance WHERE employee_id=$user_id AND date='$tanggal'");

if (isset($_POST['check_in'])) {
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO attendance (employee_id, date, time_in) VALUES ($user_id, '$tanggal', NOW())");
        header("Location: attendance.php");
        exit;
    }
}

if (isset($_POST['check_out'])) {
    $conn->query("UPDATE attendance SET time_out=NOW() WHERE employee_id=$user_id AND date='$tanggal'");
    header("Location: attendance.php");
    exit;
}

$data = $conn->query("SELECT * FROM attendance WHERE employee_id=$user_id ORDER BY date DESC");
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
            padding: 40px;
            color: #333;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        h3 {
            margin-top: 40px;
            margin-bottom: 15px;
        }

        a {
            display: inline-block;
            margin-bottom: 30px;
            color: #0075FF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            margin-bottom: 30px;
        }

        button {
            background-color: #0075FF;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #005fd1;
        }

        p {
            margin-top: 10px;
            color: green;
            font-weight: 500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f5faff;
            font-weight: 600;
        }

        tr:last-child td {
            border-bottom: none;
        }

        td {
            color: #444;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            table,
            th,
            td {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <h2>Absensi</h2>
    <a href="dashboard.php">🏠 Dashboard</a>

    <form method="POST">
        <?php if ($check->num_rows == 0): ?>
            <button name="check_in">Check In</button>
        <?php else: ?>
            <?php
            $row = $check->fetch_assoc();
            if (is_null($row['time_out'])): ?>
                <button name="check_out">Check Out</button>
            <?php else: ?>
                <p>✅ Kamu sudah Check In dan Check Out hari ini.</p>
            <?php endif; ?>
        <?php endif; ?>
    </form>

    <h3>Riwayat Absensi</h3>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Masuk</th>
            <th>Pulang</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $data->fetch_assoc()): ?>
            <tr>
                <td><?= $row['date'] ?></td>
                <td><?= $row['time_in'] ?: '-' ?></td>
                <td><?= $row['time_out'] ?: '-' ?></td>
                <td><?= $row['status'] ?: '-' ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>

</html>