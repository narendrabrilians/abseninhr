<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM attendance WHERE employee_id=$id");
$conn->query("DELETE FROM leave_requests WHERE employee_id=$id");
$conn->query("DELETE FROM employees WHERE id=$id");
header('Location: view_employees.php');
exit;
