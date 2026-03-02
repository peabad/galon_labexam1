<?php
include "db.php";
$message = "";

$id=$_GET['id'];
$id=mysqli_real_escape_string($conn, $id);
$get=mysqli_query($conn, "SELECT * FROM students WHERE id='$id'");
$users=mysqli_fetch_assoc($get);

if (!$users){
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    if($name=="" || $email=="" || $course=="") {
        $message = "All fields are required.";
    } else {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $course = mysqli_real_escape_string($conn, $course);
        
    $sql = "UPDATE students SET name='$name', email='$email', course='$course' WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">

        <h2 class="text-center">Edit Student</h2>

        <form method="POST">
            
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" name="id" value="<?php echo $users['student_id']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $users['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $users['email']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" id="course" name="course" value="<?php echo $users['course']; ?>" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                <a href="index.php" class="btn btn-secondary">Back to List</a>
            </div>

        </form>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>