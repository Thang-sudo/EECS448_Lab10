<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Create Posts backend</title>
</head>
<body>
    <?php
        $mysqli = new mysqli("mysql.eecs.ku.edu", "minhe", "Mao4Nei9", "minhe");
        $user_id = $_POST["username"];
        $text = $_POST["text"];
        // Check if text is empty
        if($text == "") errorHandle("Text must not be empty");
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
                    echo "<br>";
                    echo "<div class='text-center container'>";
                    echo "<span class='alert alert-success'> Post created successfully </span>";
                    echo "<a href='CreatePosts.html' class='nav-link'> Create Posts </a>";
                    echo "<div>";
                }
                // If user does not exist
                else errorHandle("User does not exist");
            }
            $mysqli -> close();
        }
        // Error message function
        function errorHandle($msg) {
            ?>
            <br>
            <div class="text-center container">
                <form method="GET" action="CreatePosts.html">
                    <span class="alert alert-danger">Error: <?=$msg?></span>
                    <button class="btn btn-secondary" type="submits">Try again!</button>
                </form>
            </div>
            <?php
        }
    ?>
</body>
</html>
