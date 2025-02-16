<?php include('db.php'); ?>

<?php
if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];
    $result = $conn->query("SELECT * FROM patients WHERE patient_id = $patient_id");
    $patient = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $dob = $_POST["date_of_birth"];
    $gender = $_POST["gender"];
    $contact = $_POST["contact_number"];
    $email = $_POST["email"];
    
    $sql = "UPDATE patients SET first_name='$first_name', last_name='$last_name', date_of_birth='$dob', gender='$gender', 
            contact_number='$contact', email='$email' WHERE patient_id=$patient_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Patient</h2>
        <form method="POST">
            <div class="mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?= $patient['first_name'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?= $patient['last_name'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" value="<?= $patient['date_of_birth'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="Male" <?= ($patient['gender'] == "Male") ? "selected" : "" ?>>Male</option>
                    <option value="Female" <?= ($patient['gender'] == "Female") ? "selected" : "" ?>>Female</option>
                    <option value="Other" <?= ($patient['gender'] == "Other") ? "selected" : "" ?>>Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Contact Number</label>
                <input type="text" name="contact_number" class="form-control" value="<?= $patient['contact_number'] ?>">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $patient['email'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Patient</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
