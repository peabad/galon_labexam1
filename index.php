<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
                
$selectall = "SELECT * FROM students";
$result = mysqli_query($conn, $selectall);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-end align-items-start" style="height: 100px;">
        <button type="button" class="btn btn-danger" onclick="window.location.href='logout.php'">Logout</button>
    </div>

        <h2>Student Records</h2>
        
        <div class="mb-1 d-grid gap-2">
        <button class="btn btn-primary btn-lg btn-block mb-3" onclick="window.location.href='create.php'">Add Student</button>
        </div>
        
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="card mb-3">
            <div class="card-body col-md-6">
                <div class="row md-6">
                    <h3 class="card-title"><?php echo $row['name'];?></h3>
                    <p class="card-text">ID Number: <?php echo $row['student_id'];?></p>
                    <p class="card-text">Email: <?php echo $row['email'];?></p>
                    <p class="card-text">Course: <?php echo $row['course'];?></p>
                </div>
                <div class="row md-6">
                    <div class="text-end">
                        <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-secondary">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                </div>
                </div>  
            </div>
        </div>
        <?php endwhile; ?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>