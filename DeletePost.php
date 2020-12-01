<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Delete Post backend</title>
</head>
<body>
    <?php
        $delete_posts = $_POST;
        $mysqli = new mysqli("mysql.eecs.ku.edu", "minhe", "Mao4Nei9", "minhe");
	    if (!$mysqli -> connect_errno) {
            if(empty($delete_posts)){
                echo "<br>";
                echo "<div class='text-center container'>";
                echo "<span class='alert alert-danger'> No post was deleted </span>";
                echo "<br>";
                echo "<a class='nav-link' href='DeletePost.html'>Delete Post</a>";
                echo "</div>";
            }
            else{
                foreach($delete_posts as $id => $value){
                    $query = $mysqli->prepare("DELETE FROM Posts WHERE post_id = ?");
                    $query->bind_param("s", $id);
                    $query->execute();
                    echo "<br>";
                    echo "<div class='text-center container'>";
                    echo "<span class='alert alert-success'> Post $id was deleted successfully </span>";
                    echo "<br>";
                    echo "<a class='nav-link' href='DeletePost.html'>Delete Post</a>";
                    echo "</div>";
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
