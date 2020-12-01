<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
</head>
<body>
    <?php
        $mysqli = new mysqli("mysql.eecs.ku.edu", "minhe", "Mao4Nei9", "minhe");
        // Check connection
        if($mysqli -> connect_errno){
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        else{
            $query = "SELECT user_id from Users ORDER by user_id ASC";
            if ($result = $mysqli->query($query)) {
                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    echo "<p>" . $row["user_id"] . "</p>";
                }
                /* free result set */
                $result->free();
               } 
        }
        $mysqli->close();
    ?>
</body>
</html>