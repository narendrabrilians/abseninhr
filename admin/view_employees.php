<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$sql = "SELECT * FROM employees WHERE role='user' ORDER BY id";
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
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
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

        main.content h2 {
            font-weight: 600;
            font-size: 28px;
            color: #0075FF;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 14px 18px;
            text-align: left;
            font-size: 16px;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f9f9f9;
            font-weight: 700;
            color: #333;
        }

        td a {
            color: #0075FF;
            text-decoration: none;
            margin-right: 10px;
            font-weight: 600;
        }

        td a:hover {
            text-decoration: underline;
        }

        tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <aside class="sidebar">
            <header class="sidebar-header">
                <h1>AbseninHR</h1>
                <p>Daftar Karyawan</p>
            </header>

            <nav class="sidebar-nav">
                <ul class="menu">
                    <li><a href="add_employee.php"><span class="icon">👤</span> Tambah Karyawan</a></li>
                    <li><a href="view_attendance.php"><span class="icon">🕒</span> Attendance</a></li>
                    <li><a href="view_leave_requests.php"><span class="icon">📌</span> Permintaan Cuti</a></li>
                    <li><a href="../logout.php" class="logout"><span class="icon">🚀</span> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <h2>Daftar Karyawan</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td>
                                <a href="edit_employee.php?id=<?= $row['id'] ?>">✏️ Edit</a>
                                <a href="delete_employee.php?id=<?= $row['id'] ?>"
                                    onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </main>
    </div>
</body>

</html>