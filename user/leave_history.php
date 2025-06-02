<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM leave_requests WHERE employee_id=$user_id ORDER BY id DESC";
$result = $conn->query($sql);
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
            margin-bottom: 20px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #005fd1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #0075FF;
            color: #fff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9faff;
        }
    </style>
</head>

<body>

    <h2>Riwayat Cuti Saya</h2>
    <a href="dashboard.php">🏠 Dashboard</a>

    <table>
        <tr>
            <th>No</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Alasan</th>
            <th>Status</th>
        </tr>
        <?php $i = 1; ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $row['start_date'] ?></td>
                <td><?= $row['end_date'] ?></td>
                <td><?= $row['reason'] ?></td>
                <td>
                    <?php
                    if ($row['status'] === 'Approved') {
                        echo "✅ Approved";
                    } elseif ($row['status'] === 'Rejected') {
                        echo "❌ Rejected";
                    } else {
                        echo "⏳ Pending";
                    }
                    ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>

</html>