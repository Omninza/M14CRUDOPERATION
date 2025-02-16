<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM appointments WHERE appointment_id = $id");
}

header("Location: index.php");
exit();
?>
