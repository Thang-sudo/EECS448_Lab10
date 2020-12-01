<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post backend</title>
</head>
<body>
    <a href="DeletePost.html">Back to Delete Post</a>
    <?php
        $delete_posts = $_POST;
        $mysqli = new mysqli("mysql.eecs.ku.edu", "minhe", "Mao4Nei9", "minhe");
	    if (!$mysqli -> connect_errno) {
            if(empty($delete_posts)){
                echo "<h1> No post was deleted </h1>";
            }
            else{
                foreach($delete_posts as $id => $value){
                    $query = $mysqli->prepare("DELETE FROM Posts WHERE post_id = ?");
                    $query->bind_param("s", $id);
                    $query->execute();
                    echo "<p>Deleted post $id  successfully</p>";
                } 
            }
        }
        else{
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        $mysqli->close();
    ?>
</body>
</html>
