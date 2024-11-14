<?php

include "db_conn.php"; // Using database connection file here

if (isset($_GET['id']) && !isset($_GET['confirm'])) {
    $id = $_GET['id'];
    
    // JavaScript confirmation prompt
    echo "<script>
        if (confirm('Are you sure you want to delete this student info?')) {
            window.location = 'delete.php?id=" . $id . "&confirm=true';
        } else {
            window.location = 'index.php';
        }
    </script>";
} 

// Proceed with deletion if confirmed
if (isset($_GET['id']) && isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Student Info Deleted Successfully'); window.location='index.php'</script>";
    } else {
        echo "<script>alert('Student Info Not Deleted'); window.location='index.php'</script>";
    }
}
?>


