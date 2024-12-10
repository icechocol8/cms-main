<?php
include("includes.php");

$posts = new Posts($connDb);
error_reporting(0);

session_start();
if (empty($_SESSION["id"])) {
header ("location: index.php");
exit();
}
?>

<html>
    <head>
        <title></title>
            <link rel="stylesheet" type="text/css" href="assets/styles.css" />
    </head>
            <body>
    <div id="wrapper">
      <div class="header"></div>
      <div class="wrapper">
         <div class="left-sidebar">
        <ul>
    <li><a href="dashboard.php">Dashboard</a></li>
    <lis<a href="new-post.php">New post</a></1i>
    <li><a href="logout.php" onClick="return confirm('Are you sure you want to logout?')">Logout</a></li>
        </ul>
    </div>
        <div class="container">
            <h3>Welcome <u><?php echo $_SESSION["user_display_name"] ?></u></h3>
    <h2>New post</h2>

    <form method="post" action="actions/posts.actions.php">
    <label clas="required">Post title</label><br>
        <input type="text" name="post_title" class="form-control"><br>
     
        <label clas="required">Content</label><br>
        <textarea rows="5" name="post_content" class="form-control"></textarea><br>
        
         <label>Excerpt</label><br>
          <input type="text" name="post_excerpt" class="form-control">
          <input type="hidden" name="post_author_id" value="<?php echo $_SESSION["id"] ?>">
          <input type="hidden" name="post_status_id" value="1">
          <input type="hidden" name="post_type_id" value="1">

         <?php if (!empty($_GET["post_id"])): ?>
         <input type="hidden" name="id" value="<?php echo $_SESSION["post_id"] ?>">
         <?php endif; ?>
         <input type="submit" value="Save" name="post">
         <input type="reset" value="Reset">
         
    </form>
    </div>
        </div>
    </div>
        </body>
</html>