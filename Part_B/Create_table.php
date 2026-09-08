<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Students Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Create Students Table</h2>
    <?php
// Sayed Ahmad Wali son of Sayed Gharib
// Connect to the database you created in Part A
    $conn = new mysqli("localhost", "root", "", "wis_lab");

    if ($conn->connect_error) {
        die('<div class="alert alert-danger">Connection failed: ' . $conn->connect_error . '</div>');
    }

    // SQL to create students table
    $sql = "CREATE TABLE students (
        id INT PRIMARY KEY AUTO_INCREMENT,
        full_name VARCHAR(100) NOT NULL,
        email VARCHAR(120) NOT NULL,
        department VARCHAR(80) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success">Table "students" created successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Error creating table: ' . $conn->error . '</div>';
    }

    $conn->close();
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
