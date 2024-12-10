<?php
class Posts     
{
    public $id;
    public $post_type_id;
    public $post_status_id;
    public $post_title;
    public $post_content;
    public $post_date;
    public $post_excerpt;
    public $post_author_id;

    private $connDb;

    function __construct($connDb)
    {
        $this->connDb = $connDb;


    }
   
    function save()
    {
        try {
            $sql = "";
    
            if (empty($this->id)) {
                $sql = "INSERT INTO posts (
                            post_type_id,
                            post_status_id,
                            post_title,
                            post_content,
                            post_date,
                            post_excerpt,
                            post_author_id
                        ) VALUES (
                            '" . $this->post_type_id . "',
                            '" . $this->post_status_id . "',
                            '" . mysqli_real_escape_string($this->connDb, $this->post_title) . "',
                            '" . mysqli_real_escape_string($this->connDb, $this->post_content) . "',
                            '" . $this->post_date . "',
                            '" . mysqli_real_escape_string($this->connDb, $this->post_excerpt) . "',
                            '" . $this->post_author_id . "'
                        )";
            } else {
                $sql = "UPDATE posts SET
                            post_type_id = '" . $this->post_type_id . "',
                            post_status_id = '" . $this->post_status_id . "',
                            post_title = '" . mysqli_real_escape_string($this->connDb, $this->post_title) . "',
                            post_content = '" . mysqli_real_escape_string($this->connDb, $this->post_content) . "',
                            post_date = '" . $this->post_date . "',
                            post_excerpt = '" . mysqli_real_escape_string($this->connDb, $this->post_excerpt) . "',
                            post_author_id = '" . $this->post_author_id . "'
                        WHERE id = '" . $this->id . "'";
            }
    
            if (!mysqli_query($this->connDb, $sql)) {
                die("Database Error: " . mysqli_error($this->connDb));
            }
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
    
function getAll()

{
try
{
    $sql = "SELECT * FROM posts";
    
    $query = mysqli_query($this->connDb, $sql) or die (mysqli_error ($this->connDb));
    while ($result = mysqli_fetch_object($query))
    {
    echo
    "<tr>".
        "<td>".$result->post_title."</td>".
        "<td align='center'>
            <a href='new-post.php?action=edit&post_id".$result->id."'>Edit</a> /
            <a href='actions/posts.actions.php?action=delete&post_id=".$result->id."'>Delete</a>
        </td>".
        "</tr>";
}
    }
    catch(Exception $ex)
    {
    echo $ex->getMessage();
    }
}

function getSingle($id)

{
try
{
    $sql = "SELECT * FROM posts WHERE id = '".$id."'";
    $result = mysqli_query($this->connDb, $sql) or die (mysqli_error ($this->connDb));
    $row = mysqli_fetch_row($result);
    
    return $row;
}
    catch(Exception $ex)
    {
    echo $ex->getMessage();
    }
}
function delete($id)

{
try
    {
    $sql = "DELETE FROM posts WHERE id = '".$id."'";
    mysqli_query($this->connDb, $sql) or die (mysqli_error ($this->connDb));

}
    catch(Exception $ex)
    {
    echo $ex->getMessage();
    }
}

function myPosts()
{
    try 
    {
         $sql = "SELECT posts.*, user_accounts.user_display_name 
                 FROM posts 
                 LEFT JOIN user_accounts ON posts.post_author_id = user_accounts.id 
                 ORDER BY posts.post_date DESC";
                 
         $query = mysqli_query($this->connDb, $sql) or die(mysqli_error($this->connDb));
         
         while ($result = mysqli_fetch_object($query))
         {
             echo "<div class='post-container'>
                     <div class='post-header'>
                         <h2 class='post-title'>".$result->post_title."</h2>
                         <p class='post-meta'>Posted by <span class='post-author'>".$result->user_display_name."</span> on <span class='post-date'>".$result->post_date."</span></p>
                     </div>
                     
                    <div class='post-body'>
                         <p class='post-excerpt'>".$result->post_content."</p>
                         
                     </div>

                     <div class='post-body'>
                         <p class='post-excerpt'>".$result->post_excerpt."</p>
                         
                     </div>

                     
                     <div class='comment-section'>
                    <input type='text' placeholder='Write a comment...' />
                    <button>Comment</button>
                </div>
                  </div>";
         }
    }
    catch(Exception $ex)
    {
        echo $ex->getMessage();
    }
}


}