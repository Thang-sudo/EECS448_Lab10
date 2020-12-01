<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>View User Posts backend</title>
</head>
<body class="text-center container">
    <?php
        $user_id = $_POST["username"];
        $mysqli = new mysqli("mysql.eecs.ku.edu", "minhe", "Mao4Nei9", "minhe");
        // Check connection
        echo "<h1> View " . $user_id . " Posts</h1>";
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
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th> Post ID </th>
                            <th> Content </th>
                        </tr>
                    </thead
                        ";
            while ($query -> fetch()){
                echo "<tr><td>" . $res_id . "</td>";
                echo "<td> $res_content </td></tr>";
            }
            echo "</table>";
        }
        $mysqli->close();
    ?>
    <a class="nav-link" style="font-size: 24px;" href="ViewUserPosts.html">Choose another user</a>
</body>
</html>
