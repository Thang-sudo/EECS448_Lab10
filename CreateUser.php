<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Create User backend</title>
</head>
<body>
    
    <?php
        $mysqli = new mysqli("mysql.eecs.ku.edu", "minhe", "Mao4Nei9", "minhe");
        // Check if user id is emoty
        $user_id = $_POST['username'];
        if($user_id == '') errorHandle("User ID is empty");
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
                if($res > 0) errorHandle("Username has already existed");
                // Username is not taken
                else{
                    // Insert username into Users table
                    $query = $mysqli -> prepare("INSERT INTO Users (user_id)  VALUES (?)");
                    $query -> bind_param("s", $user_id);
                    $query -> execute();
                    $query -> close();
                    echo "<br>";
                    echo "<div class='text-center container'>";
                    echo "<span class='alert alert-success'> User created successfully </span>";
                    echo "<a class='nav-link' href='CreatePosts.html'>Create Posts</a>";
                    echo "</div>";

                }
                $mysqli -> close();
            }
        }
        
        // Error message output function
        function errorHandle($msg) {
            ?>
            <div class="text-center container">
                <br>
                <form method="GET" action="CreateUser.html">
                    <span class="alert alert-danger">Error: <?=$msg?></span>
                    <button class="btn btn-secondary" type="submits">Try again!</button>
                </form>
            </div>
            <?php
        }
    ?>    
</body>
</html>

