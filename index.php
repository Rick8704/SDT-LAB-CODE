<?php
session_start(); // Starting Session
if (!isset($_SESSION['username'])) { // If session is not set then redirect to Login Page
    header("Location: login.php"); // Redirecting To Login Page
    exit(); // Stop script
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Viewport meta tag for responsiveness -->
    <title>Users List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color:#fff8e8; text-align: center;">

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
    <br>
    <img src="logo_utm.png" alt="This is UTM Logo" width="300" height="100">
    <br><br>

    <h2 style="background-color:#FFEAC5;padding: 10px; border-radius: 8px;">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <h1 style="font-style:italic ;font-weight:bolder ">Registered Students List</h1>

    <div class="container">
        <div class="card" style="background-color: #fff; padding: 20px; border-radius: 10px;">
            <div class="card-body">
                <h5 class="card-title" style="font-style:italic; font-weight:strong">All Registered Students</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Year of Study</th>
                                <th>Update Info</th>
                                <th>Delete Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "db_conn.php"; // Using database connection file here

                            $sql = "SELECT * FROM students";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['course'] . "</td>";
                                    echo "<td>" . $row['yr'] . "</td>";
                                    echo "<td><a href='update.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a></td>";
                                    echo "<td><a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No Data Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="create.php" class="btn btn-success mt-3">Add New Student</a><br>
    <a href="logout.php" class="btn btn-secondary mt-2">Logout</a>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmJo6FfKwMbU7OGmZp6b8pqsRgl5/An1pKs2RalDqD5I5me8hm4t1G" crossorigin="anonymous"></script>
    <script>
    const tooltips = document.querySelectorAll('.tt')
    tooltips.forEach(t => {
      new bootstrap.Tooltip(t)
    })
  </script>
</body>
</html>
