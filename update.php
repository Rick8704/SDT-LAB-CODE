<?php
session_start(); // Starting Session
if(!isset($_SESSION['username'])){ // If session is not set, redirect to Login Page
    header("Location: login.php"); // Redirecting to Login Page
    exit(); // Stop script
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color:#fff8e8;">
    <!-- UTM Logo and Title -->
    <div class="container py-4">
        <div class="text-center">
            <img src="logo_utm.png" alt="This is UTM Logo" width="300" height="100">
            <h1 class="my-3" style="background-color: #FFEAC5; padding: 10px; border-radius: 8px; font-style:italic; font-weight:bolder">
                Update Student Info
            </h1>
        </div>

        <!-- Update Form -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-4 shadow">
                    <?php
                    include "db_conn.php"; // Database connection

                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                        // Prepare statement for the SELECT query
                        $stmt = mysqli_prepare($conn, "SELECT * FROM students WHERE id = ?");
                        mysqli_stmt_bind_param($stmt, 'i', $id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                        } else {
                            echo "<div class='alert alert-danger text-center'>Student not found.</div>";
                            exit;
                        }

                        mysqli_stmt_close($stmt);
                    }
                    ?>

                    <h2 class="text-center mb-4">Edit Student's Info</h2>
                    <form action="update.php?id=<?php echo $row['id']; ?>" method="POST">
                        <!-- Student Name -->
                        <label for="name" class="form-label">Student Name:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill text-secondary"></i>
                            </span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="e.g., John Doe" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                            <span class="input-group-text">
                                <span class="tt" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter the student's full name.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>

                        <!-- Email -->
                        <label for="email" class="form-label">Email:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill text-secondary"></i>
                            </span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="e.g., student@example.com" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                            <span class="input-group-text">
                                <span class="tt" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter a valid email address.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>

                        <!-- Course -->
                        <label for="course" class="form-label">Course:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="bi bi-book-fill text-secondary"></i>
                            </span>
                            <input type="text" name="course" id="course" class="form-control" placeholder="e.g., Computer Science" value="<?php echo htmlspecialchars($row['course']); ?>" required>
                            <span class="input-group-text">
                                <span class="tt" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Specify the course the student is enrolled in.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>

                        <!-- Year of Study -->
                        <label for="year" class="form-label">Year of Study:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="bi bi-calendar-check-fill text-secondary"></i>
                            </span>
                            <select name="yr" id="year" class="form-select" required>
                                <option value="">Select Year</option>
                                <option value="1" <?php if($row['yr'] == 1) echo 'selected'; ?>>Year 1</option>
                                <option value="2" <?php if($row['yr'] == 2) echo 'selected'; ?>>Year 2</option>
                                <option value="3" <?php if($row['yr'] == 3) echo 'selected'; ?>>Year 3</option>
                                <option value="4" <?php if($row['yr'] == 4) echo 'selected'; ?>>Year 4</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $course = $_POST['course'];
            $year = $_POST['yr'];

            // Prepare statement for the UPDATE query
            $stmt = mysqli_prepare($conn, "UPDATE students SET name = ?, email = ?, course = ?, yr = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'sssii', $name, $email, $course, $year, $id);

            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success text-center mt-4'>Student info updated successfully</div>";
            } else {
                echo "<div class='alert alert-danger text-center mt-4'>Error: " . mysqli_error($conn) . "</div>";
            }

            mysqli_stmt_close($stmt);
        }
        ?>

        <!-- Link to Student List -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Back to Student List</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmJo6FfKwMbU7OGmZp6b8pqsRgl5/An1pKs2RalDqD5I5me8hm4t1G" crossorigin="anonymous"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('.tt'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>
