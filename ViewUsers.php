<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>View Users</title>
</head>
<body class="text-center container">
    <br>
    <h1>View Users</h1>
    <div class="list-group">
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
                    echo "<button type='button' class='list-group-item list-group-item-action'>" . $row["user_id"] . "</button>";
                }
                /* free result set */
                $result->free();
               } 
        }
        $mysqli->close();
    ?>
    </div>
    <a class="nav-link" style="font-size: 24px;" href="AdminHome.html">Admin Home</a>
</body>
</html>