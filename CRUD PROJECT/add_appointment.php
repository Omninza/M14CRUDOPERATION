<?php include('db.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST["patient_id"];
    $doctor_name = $_POST["doctor_name"];
    $appointment_date = $_POST["appointment_date"];
    $department = $_POST["department"];
    $status = $_POST["status"];

    // Check if patient exists
    $patient_check = $conn->query("SELECT * FROM patients WHERE patient_id = '$patient_id'");
    
    if ($patient_check->num_rows == 0) {
        echo "<div class='alert alert-danger'>Error: Patient ID does not exist.</div>";
    } else {
        // Insert the appointment
        $sql = "INSERT INTO appointments (patient_id, doctor_name, appointment_date, department, status)
                VALUES ('$patient_id', '$doctor_name', '$appointment_date', '$department', '$status')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Appointment</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Patient ID</label>
                <input type="number" name="patient_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Doctor Name</label>
                <input type="text" name="doctor_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Appointment Date</label>
                <input type="datetime-local" name="appointment_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Department</label>
                <input type="text" name="department" class="form-control">
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Appointment</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
