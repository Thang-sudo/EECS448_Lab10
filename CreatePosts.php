<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Posts backend</title>
</head>
<body>
    <?php
        $mysqli = new mysqli("mysql.eecs.ku.edu", "minhe", "Mao4Nei9", "minhe");
        $user_id = $_POST["username"];
        $text = $_POST["text"];
        // Check if text is empty
        if($text == "") error("Text must not be empty");
        else{
            // Check for connection
            if ($mysqli->connect_errno) {
                printf("Connect failed: %s\n", $mysqli->connect_error);
                exit();
            }
            else{
                // Check if user existed in Users table
                $query = $mysqli -> prepare("SELECT count(*) FROM Users WHERE user_id = ?");
                $query -> bind_param("s", $user_id);
                $query -> execute();

                $query -> bind_result($res);
                $query -> fetch();
                $query -> close();

                // If user exists, allow to submit the text to Posts table
                if($res > 0){
                    $query = $mysqli -> prepare("INSERT INTO Posts (author_id, content) VALUES (?,?)");
                    $query -> bind_param("ss", $user_id, $text);
                    $query -> execute();
                    $query -> close();
                    echo "<h1> Post created successfully </h1>";

                }
                // If user does not exist
                else error("User does not exist");
            }
            $mysqli -> close();
        }
        // Error message function
        function error($msg) {
            ?>
            <form method="GET" action="CreatePosts.html">
                <span>Error: <?=$msg?></span>
                <button type="submits">Try again!</button>
            </form>
            <?php
        }
    ?>
</body>
</html>
