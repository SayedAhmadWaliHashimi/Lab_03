<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Student</h2>

    <?php
    $message = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = trim($_POST["full_name"]);
        $email    = trim($_POST["email"]);
        $department = trim($_POST["department"]);

        if (empty($fullName) || empty($email) || empty($department)) {
            $message = '<div class="alert alert-warning">All fields are required.</div>';
        } else {
            
            $dbname = "wis_lab";
           
            $conn = new mysqli("localhost", "root", "", $dbname, 3307);
            
            if ($conn->connect_error) {
                $message = '<div class="alert alert-danger">Connection failed: ' . $conn->connect_error . '</div>';
            } else {
                // Use real_escape_string for safety
                $fullName = $conn->real_escape_string($fullName);
                $email    = $conn->real_escape_string($email);
                $department = $conn->real_escape_string($department);

                $sql = "INSERT INTO students (full_name, email, department) 
                        VALUES ('$fullName', '$email', '$department')";

                if ($conn->query($sql) === TRUE) {
                    $message = '<div class="alert alert-success">Student added successfully!</div>';
                } else {
                    $message = '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
                }
                $conn->close();
            }
        }
    }
    ?>

    <?php if (!empty($message)) echo $message; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="full_name" id="full_name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" name="department" id="department" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Student</button>
        <button type="reset" class="btn btn-secondary">Clear</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
