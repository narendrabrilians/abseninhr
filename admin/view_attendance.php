<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

$data = $conn->query("SELECT a.*, e.name FROM attendance a JOIN employees e ON a.employee_id = e.id ORDER BY date DESC");
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
        }

        body {
            background-color: #fff;
            color: #222;
            padding: 20px 40px;
        }

        h2 {
            color: #0075FF;
            margin-bottom: 20px;
        }

        a {
            color: #0075FF;
            text-decoration: none;
            font-weight: 600;
            margin-right: 15px;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 30px;
            margin-bottom: 30px;
            font-size: 14px;
            overflow: hidden;
        }

        thead tr {
            background-color: #f0f6ff;
        }

        th,
        td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        td.status {
            font-weight: 600;
            color: #0075FF;
        }
    </style>
</head>

<body>
    <h2>Semua Data Absensi</h2>
    <a href="view_employees.php">⬅️ Kembali</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Pulang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php while ($row = $data->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['time_in'] ?></td>
                    <td><?= $row['time_out'] ?></td>
                    <td class="status"><?= $row['status'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>