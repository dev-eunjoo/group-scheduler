<?php
/* Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: scheduler.php for the group scheduler web application. It shows the group scheduler and schedule management. 
 */
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <meta name="vieport" content="width=device-width" , initial-scale="1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scheduler.js"></script>
    <title>Group Scheduler</title>
</head>

<body>
    <?php
    include "connect.php";

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    $command = "SELECT userid FROM member WHERE username = ? AND `password` = ?";
    $stmt = $dbh->prepare($command);
    $params = [$username, $password];
    $success = $stmt->execute($params);

    if ($success) {
        //get the user id information and display the schedlue when the connection succeed. 
        if ($stmt->rowCount() === 1) {
            while ($row = $stmt->fetch()) {
                $userid = $row["userid"];
            }
    ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light black">
                <a class="navbar-brand" href="index.html">Group Scheduler </a>
                <a id="sign" class="menu" href="index.html" class="nav-link" role="button" style="padding-right: 60px">SIGN OUT</a>
            </nav>
            <div id="container">
                <div id="left">
                    <!-- table for displaying the group schedule -->
                    <table id="schedules">
                        <h2>Group Schedule</h2>
                    </table>
                </div>
                <div id="right">
                    <div id="header">
                        <h2><span id="title">Schedule Management</h2>
                    </div>
                    <div id="body">
                        <input type="date" id="date" />
                        <input type="text" id="title1" placeholder="add title" size="23" />
                        <input type="text" id="text" placeholder="add text" size="40" />
                        <input type="hidden" id="userid" value=<?= $userid ?> />
                        <input type="submit" id="clickme" value="Add" />
                        <span id="target"> </span>
                        <!-- div for displaying the user's own schedule list -->
                        <div id="list"></div>
                    </div>
                    <div id="user"><?= $userid ?></div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="container">
                <div class="col-lg-4">
                    <div class="jumbotron">
                        <h1 class="black">Failed. Check the name and the password.</h1>
                        <br>
                        <a class="btn btn-primary btn-pull" href="signin.php" role="button">
                            Go to Sign in Page</a>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        //show the error massage if the connection is failed
        echo "Fail to connect. Please check the connection.";
    }
    ?>
    </div>
</body>

</html>
<script>
    //modify the current history entry to prevent the schedule records for security 
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>