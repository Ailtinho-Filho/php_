<?php
require_once 'User.php';

$user = new User();

// Handling Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user->create($name, $email);
    header('Location: index.php'); // Redirect to avoid form resubmission
    exit();
}

// Handling Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user->update($id, $name, $email);
    header('Location: index.php'); // Redirect to avoid form resubmission
    exit();
}

// Handling Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $user->delete($id);
    header('Location: index.php'); // Redirect to avoid form resubmission
    exit();
}

// Fetch all users for display
$users = $user->read();
?>
