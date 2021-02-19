<?php
/* Eunjoo Na, 000811369
 * Date: 2020.11.27
 * Description: joinaction.php for the group scheduler web application. It connects to the database and show the result of the registration.
 */
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <meta name="vieport" content="width=device-width" , initial-scale="1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Group Scheduler</title>
</head>

<body>
    <!-- nav for displaying the menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.html">Group Scheduler </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    Register Page
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a id="sign" href="signin.php" class="nav-link" role="button" style="padding-right: 60px">SIGN IN</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a id="join" href="join.php" class="nav-link" role="button" style="padding-right: 60px">JOIN</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
    include "connect.php";

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    $command = "SELECT userid FROM member WHERE username = ?";
    $stmt = $dbh->prepare($command);
    $params = [$username];
    $success = $stmt->execute($params);

    if ($success) {
        //display the error message when register process is failed
        if ($stmt->rowCount() === 1) {
    ?>
            <div class="container">
                <div class="col-lg-4">
                    <div class="jumbotron">
                        <h1 class="black">User Name is already exist.</br> Please try to use different name!</h1>
                        <br>
                        <a class="btn btn-primary btn-pull" href="join.php" role="button">
                            Back to Join</a>
                    </div>
                </div>
            </div>
        <?php
        } else {

            $command = "INSERT INTO member (`username`, `password`) VALUES (?,?)";
            $stmt = $dbh->prepare($command);
            $params = [$username, $password];
            $success = $stmt->execute($params);

            if (!$success) {
                echo "Fail to connect. Please check the connection.";
            }
        ?>
            <!-- nav for displaying the success message -->
            <div class="container">
                <div class="col-lg-4">
                    <div class="jumbotron black">
                        <h1>Successfully registered!</h1>
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