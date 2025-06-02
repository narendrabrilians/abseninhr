<?php
session_start();
include 'config/db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM employees WHERE email='$email' AND password='$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header('Location: admin/view_employees.php');
        } else {
            header('Location: user/dashboard.php');
        }
        exit;
    } else {
        $error = "Email atau password salah!";
    }
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

        .header {
            position: absolute;
            top: 30px;
            left: 40px;
            font-size: 36px;
            font-weight: 700;
            color: #000;
            user-select: none;
        }

        .login-container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            color: #000;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .login-container p.motivation {
            color: #666;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .login-container label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            text-align: left;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #0075FF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #005fd1;
        }

        .error {
            color: red;
            margin-bottom: 16px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        AbseninHR
    </div>

    <div class="login-container">
        <h2>Hai, Talenta Hebat!</h2>
        <p class="motivation">Mulai hari dengan kebaikan & semangat 🔥</p>
        <?php if (isset($error))
            echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>

</body>

</html>