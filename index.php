<?php
session_start();
include('config.php');

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
  // User is logged in, redirect to another page
  header("Location: home.php"); 
  exit;
}

// Function to fetch free or paid courses from the database based on the filter
function fetchCoursesFromDatabase($conn, $filter) {
    if ($filter === 'free') {
        $query = "SELECT * FROM Courses WHERE Course_Price = 0";
    } else if ($filter === 'paid') {
        $query = "SELECT * FROM Courses WHERE Course_Price > 0";
    } else {
        $query = "SELECT * FROM Courses";
    }
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Fetch all courses from the database based on the filter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$courses = fetchCoursesFromDatabase($conn, $filter);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS styles */
        body {
            background-color: aquamarine;

        }
        .course-card {
            margin-bottom: 20px;
        }
        .jumbotron{
          background-color: aquamarine;

        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to E-Learning Platform</h1>
        <p class="lead">Explore a wide range of courses for your learning needs.</p>
    </div>
    <div class="container">
        <h2 class="mb-4 mt-4 text-center">Available Courses</h2>
        <div>
            <a class="btn btn-sm btn-primary mr-2" href="<?php echo $_SERVER['PHP_SELF']; ?>">All</a>
            <a class="btn btn-sm btn-primary mr-2" href="<?php echo $_SERVER['PHP_SELF']; ?>?filter=free">Free</a>
            <a class="btn btn-sm btn-primary" href="<?php echo $_SERVER['PHP_SELF']; ?>?filter=paid">Paid</a>
        </div>

        <div class="row mt-4">
            <?php foreach ($courses as $course) : ?>
                <div class="col-md-4">
                    <div class="card course-card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $course['Course_Title']; ?></h5>
                            <p class="card-text">Instructor: <?php echo $course['Course_Instructor']; ?></p>
                            <p class="card-text">Price: <?php echo '$' . $course['Course_Price']; ?></p>
                            <a href="course_details.php?id=<?php echo $course['Course_ID']; ?>" class="btn btn-info">Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery links (at the end of the body) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
