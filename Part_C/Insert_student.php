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
        // 1. Get and trim form data
        $fullName = trim($_POST["full_name"]);
        $email    = trim($_POST["email"]);
        $department = trim($_POST["department"]);

        // 2. Validate that fields are not empty
        if (empty($fullName) || empty($email) || empty($department)) {
            $message = '<div class="alert alert-warning">All fields are required.</div>';
        } else {
            // 3. Connect to the database
            $conn = new mysqli("localhost", "root", "", "wis_lab");
            if ($conn->connect_error) {
                $message = '<div class="alert alert-danger">Connection failed: ' . $conn->connect_error . '</div>';
            } else {
                // 4. Build INSERT query (using real_escape_string for basic safety)
                $fullName = $conn->real_escape_string($fullName);
                $email    = $conn->real_escape_string($email);
                $department = $conn->real_escape_string($department);

                $sql = "INSERT INTO students (full_name, email, department) 
                        VALUES ('$fullName', '$email', '$department')";

                // 5. Execute and show feedback
                if ($conn->query($sql) === TRUE) {
                    $message = '<div class="alert alert-success">Student added successfully!</div>';
                    // Optionally clear the form fields after success (we'll use JavaScript later)
                } else {
                    $message = '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
                }
                // 6. Close connection
                $conn->close();
            }
        }
    }
    ?>

    <!-- Display any message -->
    <?php if (!empty($message)) echo $message; ?>

    <!-- Bootstrap Form -->
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
        <!-- Clear/Reset button (Part D) -->
        <button type="reset" class="btn btn-secondary">Clear</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
