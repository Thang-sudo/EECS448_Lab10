<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Posts backend</title>
</head>
<body>
    <?php
        $user_id = $_POST["username"];
        $mysqli = new mysqli("mysql.eecs.ku.edu", "minhe", "Mao4Nei9", "minhe");
        // Check connection
        echo "<h1>" . $user_id . "</h1>";
        if($mysqli -> connect_errno){
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        else{
            $command = "SELECT post_id, content FROM Posts WHERE author_id = ? ORDER by post_id ASC";
            $query = $mysqli -> prepare($command);
            $query -> bind_param("s", $user_id);
            $query -> bind_result($res_id, $res_content);
            $query -> execute();
            
            while ($query -> fetch()){
                echo "<p>" . $res_id . "</p>";
                echo "<p> $res_content </p>";
            }
        }
        $mysqli->close();
    ?>
</body>
</html>
