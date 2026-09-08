<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Create Database</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="database_name" class="form-label">Database Name</label>
            <input type="text" class="form-control" name="database_name" id="database_name" 
                   placeholder="e.g., wis_lab" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Database</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $databaseName = trim($_POST["database_name"]);

        // 1. Connect to MySQL (without selecting a database)
        $conn = new mysqli("localhost", "root", "");
        if ($conn->connect_error) {
            echo '<div class="alert alert-danger mt-3">Connection failed: ' . $conn->connect_error . '</div>';
        } else {
            // 2. Validate database name: only letters, numbers, underscores
            if (!preg_match('/^[A-Za-z0-9_]+$/', $databaseName)) {
                echo '<div class="alert alert-danger mt-3">Invalid database name. Use only letters, numbers, and underscores.</div>';
            } else {
                // 3. Build and execute CREATE DATABASE query
                $sql = "CREATE DATABASE `$databaseName`";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success mt-3">Database "' . $databaseName . '" created successfully!</div>';
                } else {
                    echo '<div class="alert alert-danger mt-3">Error: ' . $conn->error . '</div>';
                }
            }
            // 4. Close connection
            $conn->close();
        }
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
