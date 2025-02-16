<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .btn {
            border-radius: 5px;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->


<!-- Main Content -->
<div class="container mt-5">
    <h2 class="text-center mb-4">🏥 Hospital Management System</h2>

    <!-- Patients Table -->
    <div class="mb-5">
        <h3><i class="fas fa-users"></i> Patients</h3>
        <a href="add_patient.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add Patient</a>
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM patients");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['patient_id']}</td>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['date_of_birth']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['contact_number']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <a href='edit_patient.php?id={$row['patient_id']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>
                            <a href='delete_patient.php?id={$row['patient_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\");'><i class='fas fa-trash'></i></a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Appointments Table -->
    <div>
        <h3><i class="fas fa-calendar-alt"></i> Appointments</h3>
        <a href="add_appointment.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add Appointment</a>
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Patient ID</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM appointments");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['appointment_id']}</td>
                        <td>{$row['patient_id']}</td>
                        <td>{$row['doctor_name']}</td>
                        <td>{$row['appointment_date']}</td>
                        <td>{$row['department']}</td>
                        <td>
                            <span class='status-badge 
                                ".($row['status'] == 'Scheduled' ? 'bg-primary' : ($row['status'] == 'Completed' ? 'bg-success' : 'bg-danger'))."'>
                                {$row['status']}
                            </span>
                        </td>
                        <td>
                            <a href='edit_appointment.php?id={$row['appointment_id']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>
                            <a href='delete_appointment.php?id={$row['appointment_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\");'><i class='fas fa-trash'></i></a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
