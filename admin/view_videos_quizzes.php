<?php
session_start();
include('config.php');

// Check if the user is logged in as an admin
if (!isset($_SESSION["usertype"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: admin_login.php");
    exit;
}

// Function to fetch all videos for a course from the database
function fetchVideosFromDatabase($conn, $course_id) {
    $query = "SELECT * FROM Videos WHERE Course_ID = $course_id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to fetch all quizzes for a course from the database
function fetchQuizzesFromDatabase($conn, $course_id) {
    $query = "SELECT * FROM Quizzes WHERE Course_ID = $course_id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Fetch all courses from the database
$courses_query = "SELECT * FROM Courses";
$courses_result = mysqli_query($conn, $courses_query);
$courses = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);

// Check if the form is submitted for video or quiz deletion
if (isset($_POST['delete_video'])) {
    $video_id = $_POST['video_id'];
    $delete_video_query = "DELETE FROM Videos WHERE Video_ID = $video_id";
    mysqli_query($conn, $delete_video_query);
}

if (isset($_POST['delete_quiz'])) {
    $quiz_id = $_POST['quiz_id'];
    $delete_quiz_query = "DELETE FROM Quizzes WHERE Quiz_ID = $quiz_id";
    mysqli_query($conn, $delete_quiz_query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Videos and Quizzes</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-color: aquamarine;

        }
        h2 {
            margin-bottom: 20px;
        }
        h3 {
            margin-bottom: 10px;
        }
        h4 {
            margin-bottom: 10px;
        }
        p {
            margin: 0;
        }
        form {
            display: inline-block;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php include('admin_navbar.php') ?>

    <div class="container">
        <h2 class="text-center">View Videos and Quizzes</h2>
        <?php foreach ($courses as $course) : ?>
            <h3 class="text-center mt-3 mb-2" ><?php echo $course['Course_Title']; ?></h3>
            <h4>Videos</h4>
            <?php
            $videos = fetchVideosFromDatabase($conn, $course['Course_ID']);
            if (!empty($videos)) {
                foreach ($videos as $video) {
                    echo '<h3>' . $video['Video_Title'] . ' - ' . $video['Video_URL'] . '</h3>';
                    echo '<h3>' . $video['Duration'] . ' Minutes </h3>';
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="video_id" value="<?php echo $video['Video_ID']; ?>">
                        <input type="submit" name="delete_video" value="Delete Video" class="btn btn-danger">
                    </form>
                    <form action="edit_video.php" method="post">
                        <input type="hidden" name="video_id" value="<?php echo $video['Video_ID']; ?>">
                        <input type="submit" value="Edit Video" class="btn btn-primary">
                    </form>
                    <hr>
                    <?php
                }
            } else {
                echo '<p>No videos available for this course.</p>';
            }
            ?>

            <h4>Quizzes</h4>
            <?php
            $quizzes = fetchQuizzesFromDatabase($conn, $course['Course_ID']);
            if (!empty($quizzes)) {
                foreach ($quizzes as $quiz) {
                    echo '<p>Quiz Title: ' . $quiz['Quiz_Title'] . '</p>';
                    echo '<p>Quiz Question: ' . $quiz['Quiz_Question'] . '</p>';
                    $options = json_decode($quiz['Quiz_Options']);
                    if (!empty($options)) {
                        echo '<p>Quiz Options:</p>';
                        foreach ($options as $option) {
                            echo '<p>' . $option . '</p>';
                        }
                    }
                    echo '<p>Correct Answer: ' . $quiz['Quiz_Correct_Answer'] . '</p>';
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="quiz_id" value="<?php echo $quiz['Quiz_ID']; ?>">
                        <input type="submit" name="delete_quiz" value="Delete Quiz" class="btn btn-danger">
                    </form>
                    <hr>
                    <?php
                }
            } else {
                echo '<p>No quizzes available for this course.</p>';
            }
            ?>
            <hr>
        <?php endforeach; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
