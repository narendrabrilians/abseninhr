<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include '../config/db.php';

$id = $_GET['id'];
$action = $_GET['action'];

if ($action == 'approve') {
    $status = 'Approved';
} elseif ($action == 'reject') {
    $status = 'Rejected';
} else {
    header('Location: view_leave_requests.php');
    exit;
}

$conn->query("UPDATE leave_requests SET status='$status' WHERE id=$id");

header('Location: view_leave_requests.php');
exit;