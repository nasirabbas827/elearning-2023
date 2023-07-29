<?php
session_start();
include('config.php');

// Check if the user is logged in as an admin
if (!isset($_SESSION["usertype"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: admin_login.php");
    exit;
}

function fetchCoursesFromDatabase($conn) {
    $query = "SELECT * FROM Courses";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Fetch all courses from the database
$courses = fetchCoursesFromDatabase($conn);

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the course ID from the form
    $course_id = $_POST['course_id'];

    // Insert videos into the database
    // Insert videos into the database
    $video_titles = $_POST['video_title'];
    $video_files = $_FILES['video_file'];
    $video_durations = $_POST['video_duration']; // Add this line to get the video durations

    if (!empty($video_titles) && !empty($video_files) && !empty($video_durations)) {
        for ($i = 0; $i < count($video_titles); $i++) {
            $video_title = mysqli_real_escape_string($conn, $video_titles[$i]);
            $video_tmp_name = $video_files['tmp_name'][$i];
            $video_name = $video_files['name'][$i];
            $video_name = mysqli_real_escape_string($conn, $video_name);
            $video_destination = 'uploads/' . $video_name;

            // Get the video duration from the form
            $video_duration = mysqli_real_escape_string($conn, $video_durations[$i]);

            if (move_uploaded_file($video_tmp_name, $video_destination)) {
                // Include the Video_Duration in the database query
                $video_query = "INSERT INTO Videos (Course_ID, Video_Title, Video_URL, Duration)
                                VALUES ($course_id, '$video_title', '$video_destination', $video_duration)";
                mysqli_query($conn, $video_query);
            }
        }
    }

    $quiz_titles = $_POST['quiz_title'];
    $quiz_questions = $_POST['quiz_question'];
    $quiz_options = $_POST['quiz_options'];
    $quiz_correct_answers = $_POST['quiz_correct_answers'];

    if (!empty($quiz_titles) && !empty($quiz_questions) && !empty($quiz_options) && !empty($quiz_correct_answers)) {
        for ($i = 0; $i < count($quiz_titles); $i++) {
            $quiz_title = mysqli_real_escape_string($conn, $quiz_titles[$i]);
            $quiz_question = mysqli_real_escape_string($conn, $quiz_questions[$i]);
            $quiz_options_json = json_encode($quiz_options[$i]);
            $quiz_correct_answer = mysqli_real_escape_string($conn, $quiz_correct_answers[$i]);

            $quiz_query = "INSERT INTO Quizzes (Course_ID, Quiz_Title, Quiz_Question, Quiz_Options, Quiz_Correct_Answer)
                           VALUES ($course_id, '$quiz_title', '$quiz_question', '$quiz_options_json', '$quiz_correct_answer')";
            mysqli_query($conn, $quiz_query);
        }
    }
    
    echo "Videos and Quizzes added to the course successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Videos and Quizzes</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-color: aquamarine;

        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            width: 50%;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        #videos-container,
        #quizzes-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        .video-item,
        .quiz-item {
            margin-bottom: 20px;
        }
        button {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include('admin_navbar.php') ?>

    <div class="container mb-4">
        <h2 class="text-center mt-3 mb-3">Add Videos and Quizzes</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <label for="course_id">Select Course:</label>
            <select name="course_id" required>
                <option value="" disabled selected>Select a course</option>
                <?php foreach ($courses as $course) : ?>
                    <option value="<?php echo $course['Course_ID']; ?>"><?php echo $course['Course_Title']; ?></option>
                <?php endforeach; ?>
            </select>
            <br>

            <hr>

            <h3>Videos</h3>
            <div id="videos-container">
                <div class="video-item">
                    <label for="video_title">Video Title:</label>
                    <input type="text" name="video_title[]">

                    <label for="video_file">Upload Video:</label>
                    <input type="file" name="video_file[]" accept="video/*">
                    <label for="video_duration">Duration (in minutes):</label>
                    <input type="number" name="video_duration[]">
                </div>
            </div>
            <button type="button" onclick="addVideo()">Add Video</button>

            <hr>

            <h3 class="mt-2 text-center">Quizzes</h3>
            <div id="quizzes-container">
                <div class="quiz-item">
                    <label for="quiz_title">Quiz Title:</label>
                    <input type="text" name="quiz_title[]">

                    <label for="quiz_question">Quiz Question:</label>
                    <textarea name="quiz_question[]"></textarea>

                    <label>Quiz Options:</label>
                    <input type="text" name="quiz_options[0][]"><br>
                    <input type="text" name="quiz_options[0][]"><br>
                    <input type="text" name="quiz_options[0][]"><br>
                    <input type="text" name="quiz_options[0][]"><br>

                    <label for="quiz_correct_answer">Correct Answer (option number):</label>
                    <input type="number" name="quiz_correct_answers[]">
                </div>
            </div>
            <button type="button" onclick="addQuiz()">Add Quiz</button>

            <input type="submit" name="submit" value="Add Videos and Quizzes" class="btn btn-primary">
            <a href="view_videos_quizzes.php" class="btn btn-secondary">View Videos and Quizzes</a>
        </form>
    </div>


    <script>
        // JavaScript functions to add new video and quiz input fields
        function addVideo() {
        var videosContainer = document.getElementById("videos-container");
        var videoItem = document.createElement("div");
        videoItem.classList.add("video-item");

        var videoTitleLabel = document.createElement("label");
        videoTitleLabel.textContent = "Video Title:";
        var videoTitleInput = document.createElement("input");
        videoTitleInput.type = "text";
        videoTitleInput.name = "video_title[]";

        var videoFileLabel = document.createElement("label");
        videoFileLabel.textContent = "Upload Video:";
        var videoFileInput = document.createElement("input");
        videoFileInput.type = "file";
        videoFileInput.name = "video_file[]";
        videoFileInput.accept = "video/*";

        // Add a new input field for video duration
        var videoDurationLabel = document.createElement("label");
        videoDurationLabel.textContent = "Duration (in minutes):";
        var videoDurationInput = document.createElement("input");
        videoDurationInput.type = "number";
        videoDurationInput.name = "video_duration[]";

        videoItem.appendChild(videoTitleLabel);
        videoItem.appendChild(videoTitleInput);
        videoItem.appendChild(videoFileLabel);
        videoItem.appendChild(videoFileInput);
        videoItem.appendChild(videoDurationLabel);
        videoItem.appendChild(videoDurationInput); // Add the duration input field

        videosContainer.appendChild(videoItem);
    }

        function addQuiz() {
            var quizzesContainer = document.getElementById("quizzes-container");
            var quizItem = document.createElement("div");
            quizItem.classList.add("quiz-item");

            var quizTitleLabel = document.createElement("label");
            quizTitleLabel.textContent = "Quiz Title:";
            var quizTitleInput = document.createElement("input");
            quizTitleInput.type = "text";
            quizTitleInput.name = "quiz_title[]";

            var quizQuestionLabel = document.createElement("label");
            quizQuestionLabel.textContent = "Quiz Question:";
            var quizQuestionTextarea = document.createElement("textarea");
            quizQuestionTextarea.name = "quiz_question[]";

            var quizOptionsLabel = document.createElement("label");
            quizOptionsLabel.textContent = "Quiz Options:";
            var quizOptionsInput = document.createElement("input");
            quizOptionsInput.type = "text";
            quizOptionsInput.name = "quiz_options[0][]";
            var br = document.createElement("br");

            quizItem.appendChild(quizTitleLabel);
            quizItem.appendChild(quizTitleInput);
            quizItem.appendChild(quizQuestionLabel);
            quizItem.appendChild(quizQuestionTextarea);
            quizItem.appendChild(quizOptionsLabel);
            quizItem.appendChild(quizOptionsInput);
            quizItem.appendChild(br.cloneNode());
            quizItem.appendChild(br.cloneNode());
            quizItem.appendChild(br.cloneNode());

            var quizCorrectAnswerLabel = document.createElement("label");
            quizCorrectAnswerLabel.textContent = "Correct Answer (option number):";
            var quizCorrectAnswerInput = document.createElement("input");
            quizCorrectAnswerInput.type = "number";
            quizCorrectAnswerInput.name = "quiz_correct_answers[]";

            quizItem.appendChild(quizCorrectAnswerLabel);
            quizItem.appendChild(quizCorrectAnswerInput);

            quizzesContainer.appendChild(quizItem);
        }
    </script>
        <!-- Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

</body>
</html>


