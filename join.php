<?php
/* Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: join.php for the group scheduler web application. It gets the information of the register from the user.
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
        <a id="sign" class="menu" href="signin.php" class="nav-link" role="button" style="padding-right: 30px; padding-left: 30px">SIGN IN</a>
        <a id="join" class="menu" href="join.php" class="nav-link" role="button" style="padding-right: 60px">JOIN</a>
    </nav>
    <div class="container">

        <div class="col-lg-4">
            <div class="jumbotron" style="padding-top: 20px;">
                <!-- form for getting and sending the information from the user  -->
                <form method="post" action="joinaction.php">
                    <h3 class="black" style="text-align: center; margin-top:25px;">JOIN NOW</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" name="username" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" maxlength="20" required>
                    </div>
                    <div class="form-group" style="text-align:center;">
                        <input type="submit" class="btn btn-primary btn-block" value="Join">
                    </div>

                </form>

            </div>

        </div>

    </div>
</body>

</html>