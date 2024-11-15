<?php
session_start(); // Starting Session
if (!isset($_SESSION['username'])) { // If session is not set then redirect to Login Page
    header("Location: login.php"); // Redirecting To Login Page
    exit(); // Stop script
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: #fff8e8;">
    <div class="container py-4">
        <div class="text-center">
            <!-- Navbar --> 
                <nav class="navbar navbar-expand-md navbar-light pt-3 pb-4" style="background-color: #FFEAC5;">
                    <div class="container-xxl">
                        <a href="index.php" class="navbar-brand">
                            <span class="text-secondary fw-bold">
                                <i class="bi bi-people"></i>
                                Student Management
                            </span>
                        </a>
                        <!-- Toggle button for mobile nav -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar links -->
                        <div class="collapse navbar-collapse justify-content-end" id="main-nav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">List Students</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="create.php">Add Student</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            <img src="logo_utm.png" alt="This is UTM Logo" width="200" height="70">
            <h1 class="my-3" style="background-color: #FFEAC5; padding: 10px; border-radius: 8px; font-style: italic; font-weight: bolder;">
                Student Registration Form
            </h1>
        </div>

        <!-- Registration Form -->
        <div class="row justify-content-center my-5">
            <div class="col-lg-6">
                <div class="card p-4 shadow">
                    <h2 class="text-center mb-4">Register New Student's Info</h2>
                    <form action="create.php" method="POST">
                        <!-- Student Name -->
                        <label for="name" class="form-label">Student Name:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill text-secondary"></i>
                            </span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="e.g., Rick" required>
                            <span class="input-group-text">
                                <span class="tt" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter the full name of the student.">
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
                            <input type="email" name="email" id="email" class="form-control" placeholder="e.g., student@example.com" required>
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
                            <input type="text" name="course" id="course" class="form-control" placeholder="e.g., Computer Science" required>
                            <span class="input-group-text">
                                <span class="tt" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Specify the course the student is enrolling in.">
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
                                <option value="1">Year 1</option>
                                <option value="2">Year 2</option>
                                <option value="3">Year 3</option>
                                <option value="4">Year 4</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Link to Student List -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">View Student List</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmJo6FfKwMbU7OGmZp6b8pqsRgl5/An1pKs2RalDqD5I5me8hm4t1G" crossorigin="anonymous"></script>
    <script>
        const tooltips = document.querySelectorAll('.tt')
        tooltips.forEach(t => {
            new bootstrap.Tooltip(t)
        })
    </script>
</body>
</html>

<?php
include "db_conn.php"; // Using database connection file here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $year = $_POST['yr'];

    $sql = "INSERT INTO students (name, email, course, yr) VALUES ('$name', '$email', '$course', '$year')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center mt-4'>New record created successfully.Back to <a href='index.php'>Student List</a></div>";
    } else {
        echo "<div class='alert alert-danger text-center mt-4'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</div>";
    }
}
?>
