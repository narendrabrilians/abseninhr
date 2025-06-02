<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT name, email FROM employees WHERE id=$user_id LIMIT 1";
$user = $conn->query($sql)->fetch_assoc();

$leave_sql = "SELECT start_date, end_date, reason, status FROM leave_requests WHERE employee_id=$user_id ORDER BY id DESC LIMIT 3";
$leave_result = $conn->query($leave_sql);
$leave_history = [];
while ($row = $leave_result->fetch_assoc()) {
    $leave_history[] = $row;
}
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

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: white;
            color: #222;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .wrapper {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        aside.sidebar {
            display: flex;
            flex-direction: column;
            border-right: 2px solid #ccc;
            width: 280px;
            min-height: 100vh;
            background-color: white;
        }

        header.sidebar-header {
            padding: 30px 30px 20px 30px;
            user-select: none;
        }

        header.sidebar-header h1 {
            font-weight: 700;
            font-size: 36px;
            color: black;
            margin-bottom: 4px;
        }

        header.sidebar-header p {
            color: #555;
            font-size: 14px;
            font-weight: 500;
        }

        nav.sidebar-nav {
            flex-grow: 1;
            padding: 10px 20px 30px 20px;
        }

        nav.sidebar-nav ul.menu {
            list-style: none;
        }

        nav.sidebar-nav ul.menu li {
            margin-bottom: 12px;
        }

        nav.sidebar-nav ul.menu li a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: black;
            font-weight: 400;
            font-size: 18px;
            padding: 10px 14px;
            border-radius: 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        nav.sidebar-nav ul.menu li a:hover {
            background-color: #0075FF;
            color: white;
        }

        nav.sidebar-nav ul.menu li a.logout {
            color: #d33;
            padding-left: 14px;
        }

        nav.sidebar-nav ul.menu li a.logout:hover {
            background-color: #d33;
            color: white;
        }

        nav.sidebar-nav ul.menu li a span.icon {
            margin-right: 10px;
            font-size: 20px;
            user-select: none;
        }

        main.content {
            flex-grow: 1;
            padding: 20px 30px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        main.content .welcome {
            font-weight: 600;
            font-size: 22px;
            margin-bottom: 30px;
            color: #444;
        }

        main.content .user-info {
            margin-bottom: 30px;
        }

        main.content .user-info h3 {
            font-weight: 600;
            font-size: 22px;
            color: #0075FF;
            margin-bottom: 6px;
        }

        main.content .user-info p {
            font-size: 16px;
            color: #444;
        }

        main.content h3.section-title {
            font-weight: 600;
            font-size: 24px;
            color: #0075FF;
            margin-bottom: 14px;
        }

        main.content table {
            width: 100%;
            border-collapse: collapse;
        }

        main.content table th,
        main.content table td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            font-size: 16px;
            color: #333;
        }

        main.content table th {
            background-color: #f9f9f9;
            font-weight: 700;
        }

        main.content table td.status {
            font-weight: 700;
            color: #0075FF;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <aside class="sidebar">
            <header class="sidebar-header">
                <h1>AbseninHR</h1>
                <p>Dashboard User</p>
            </header>

            <nav class="sidebar-nav">
                <ul class="menu">
                    <li><a href="view_profile.php"><span class="icon">👤</span> Profil Saya</a></li>
                    <li><a href="attendance.php"><span class="icon">🕒</span> Attendance</a></li>
                    <li><a href="apply_leave.php"><span class="icon">📌</span> Ajukan Cuti</a></li>
                    <li><a href="leave_history.php"><span class="icon">📅</span> Riwayat Cuti</a></li>
                    <li><a href="../logout.php" class="logout"><span class="icon">🚀</span> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <p class="welcome">Selamat datang, <?= $user['name'] ?>!</p>

            <section class="user-info">
                <h3>Informasi Karyawan</h3>
                <p>Nama: <?= $user['name'] ?></p>
                <p>Email: <?= $user['email'] ?></p>
            </section>

            <section class="leave-history">
                <h3 class="section-title">Riwayat Cuti Terakhir</h3>
                <?php if (count($leave_history) === 0): ?>
                    <p>Tidak ada data cuti.</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Alasan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leave_history as $leave): ?>
                                <tr>
                                    <td><?= $leave['start_date'] ?></td>
                                    <td><?= $leave['end_date'] ?></td>
                                    <td><?= $leave['reason'] ?></td>
                                    <td class="status"><?= $leave['status'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>

</html>