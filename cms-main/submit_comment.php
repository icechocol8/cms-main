
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $post_id = intval($_POST['post_id']);
        $user_id = 1; // Replace with actual user ID from session or authentication system
        $comment_content = mysqli_real_escape_string($this->connDb, $_POST['comment_content']);
        $comment_date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO comments (post_id, user_id, comment_content, comment_date) 
                VALUES ('$post_id', '$user_id', '$comment_content', '$comment_date')";

        if (mysqli_query($this->connDb, $sql)) {
            header("Location: index.php"); // Redirect to the posts page
            exit;
        } else {
            echo "Error: " . mysqli_error($this->connDb);
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>