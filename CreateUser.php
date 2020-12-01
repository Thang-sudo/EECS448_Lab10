<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User backend</title>
</head>
<body>
    <a href="CreatePosts.html">Create Posts</a>
    <?php
        $mysqli = new mysqli("mysql.eecs.ku.edu", "minhe", "Mao4Nei9", "minhe");
        // Check if user id is emoty
        $user_id = $_POST['username'];
        if($user_id == '') error("User ID is empty");
        else{
            // Check connection
            if ($mysqli->connect_errno) {
                printf("Connect failed: %s\n", $mysqli->connect_error);
                exit();
            }
            else{
                // Get all users with the same username
                $query = $mysqli -> prepare("SELECT count(*) FROM Users WHERE user_id = ?");
                $query -> bind_param("s", $user_id);
                $query -> execute();
                // Get result to res
                $query -> bind_result($res);
                $query -> fetch();
                $query -> close();
                // Username is taken
                if($res > 0) error("Username has already existed");
                // Username is not taken
                else{
                    // Insert username into Users table
                    $query = $mysqli -> prepare("INSERT INTO Users (user_id)  VALUES (?)");
                    $query -> bind_param("s", $user_id);
                    $query -> execute();
                    $query -> close();
                    echo "<h1> User created successfully </h1>";

                }
                $mysqli -> close();
            }
        }
        
        // Error message output function
        function error($msg) {
            ?>
            <form method="GET" action="CreateUser.html">
                <span>Error: <?=$msg?></span>
                <button type="submits">Try again!</button>
            </form>
            <?php
        }
    ?>    
</body>
</html>

