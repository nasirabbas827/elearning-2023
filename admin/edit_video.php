<?php
session_start();
include('config.php');

// Check if the user is logged in as an admin
if (!isset($_SESSION["usertype"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: admin_login.php");
    exit;
}

// Check if the form is submitted for video update
if (isset($_POST['update_video'])) {
    $video_id = $_POST['video_id'];
    $video_title = $_POST['video_title'];
    $video_duration = $_POST['video_duration']; // Add this line to get the video duration

    // Prepare the SQL statement using a prepared statement
    $query = "UPDATE Videos 
              SET Video_Title = ?, Duration = ? 
              WHERE Video_ID = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "sii", $video_title, $video_duration, $video_id); // Use "sii" for string, integer, integer

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Video updated successfully!";
        header("Location: view_videos_quizzes.php");
        exit(); 
    } else {
        echo "Error updating video: " . mysqli_stmt_error($stmt);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Fetch video details based on the video ID from the query parameter
if (isset($_POST['video_id'])) {
    $video_id = $_POST['video_id'];
    $query = "SELECT * FROM Videos WHERE Video_ID = $video_id";
    $result = mysqli_query($conn, $query);
    $video = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Video</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-color: aquamarine;

        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include('admin_navbar.php') ?>

    <div class="container">
        <h2 class="mt-4 text-center">Edit Video</h2>
        <?php if (isset($video)) : ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="video_id" value="<?php echo $video['Video_ID']; ?>">

            <label for="video_title">Video Title:</label>
            <input type="text" name="video_title" value="<?php echo $video['Video_Title']; ?>" required>

            <label for="video_duration">Video Duration (in minutes):</label>
            <input type="number" name="video_duration" value="<?php echo $video['Duration']; ?>" required> <br>
            <input type="submit" name="update_video" value="Update Video" class="mt-3 btn btn-primary">
        </form>
        <?php else : ?>
        <p>Invalid video ID. Please select a valid video to edit.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
