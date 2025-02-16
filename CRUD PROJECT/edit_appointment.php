<?php include('db.php'); ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM appointments WHERE appointment_id = $id");
    $appointment = $result->fetch_assoc();
}

// Initialize an error message variable
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST["patient_id"];
    $doctor_name = $_POST["doctor_name"];
    $appointment_date = $_POST["appointment_date"];
    $department = $_POST["department"];
    $status = $_POST["status"];

    // Check if the patient ID exists
    $patient_check = $conn->query("SELECT * FROM patients WHERE patient_id = '$patient_id'");

    if ($patient_check->num_rows == 0) {
        $error_message = "Error: The patient ID does not exist. Please enter a valid patient ID.";
    } else {
        // Update appointment only if the patient exists
        $sql = "UPDATE appointments SET patient_id='$patient_id', doctor_name='$doctor_name', 
                appointment_date='$appointment_date', department='$department', status='$status' 
                WHERE appointment_id=$id";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Appointment</h2>

        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger"><?= $error_message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Patient ID</label>
                <input type="number" name="patient_id" class="form-control" value="<?= $appointment['patient_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Doctor Name</label>
                <input type="text" name="doctor_name" class="form-control" value="<?= $appointment['doctor_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Appointment Date</label>
                <input type="datetime-local" name="appointment_date" class="form-control" value="<?= $appointment['appointment_date']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Department</label>
                <input type="text" name="department" class="form-control" value="<?= $appointment['department']; ?>">
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="Scheduled" <?= $appointment['status'] == 'Scheduled' ? 'selected' : ''; ?>>Scheduled</option>
                    <option value="Completed" <?= $appointment['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                    <option value="Cancelled" <?= $appointment['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Update Appointment</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
