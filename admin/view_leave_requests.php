<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$sql = "SELECT lr.id, e.id AS employee_id, e.name AS employee_name, lr.start_date, lr.end_date, lr.reason, lr.status 
        FROM leave_requests lr
        JOIN employees e ON lr.employee_id = e.id
        ORDER BY lr.id DESC";
$result = $conn->query($sql);
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
            padding: 20px 40px;
            color: #222;
        }

        h2 {
            color: #0075FF;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #0075FF;
            margin-right: 15px;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        th,
        td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #f0f6ff;
            color: #333;
        }

        .status-pending {
            color: #ff9800;
            font-weight: 600;
        }

        .status-approved {
            color: #4caf50;
            font-weight: 600;
        }

        .status-rejected {
            color: #f44336;
            font-weight: 600;
        }

        td a {
            margin-right: 8px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <h2>Permintaan Cuti</h2>
    <a href="view_employees.php">⬅️ Kembali</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>ID</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Alasan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1; ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row['employee_name'] ?></td>
                <td><?= $row['employee_id'] ?></td>
                <td><?= $row['start_date'] ?></td>
                <td><?= $row['end_date'] ?></td>
                <td><?= nl2br($row['reason']) ?></td>
                <td class="status-<?= strtolower($row['status']) ?>">
                    <?= $row['status'] ?>
                </td>
                <td>
                    <?php if ($row['status'] == 'Pending'): ?>
                        <a href="approve_leave.php?id=<?= $row['id'] ?>&action=approve">✅ Approve</a>
                        <a href="approve_leave.php?id=<?= $row['id'] ?>&action=reject">❌ Reject</a>
                    <?php else: ?>
                        <?= $row['status'] == 'Approved' ? '✅' : '❌' ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>

</html>