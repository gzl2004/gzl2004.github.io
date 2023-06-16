<?php
require_once 'helper.php';
if (isset($_POST['Userlogin'])) {
    // retrieve the username and password from the user input
    $username = $_POST['uname'];
    $password = $_POST['pw'];

    // connect to the database
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // select all from the database
    $sql = "SELECT * FROM user";
    $result = $con->query($sql);

    // check if there are any results
    if ($result = $con->query($sql)) {
        // loop through all the results
        while ($row = $result->fetch_assoc()) {
            // check if the username and password match
            if ($row["Username"] == $username && $row["Password"] == $password) {
                // if they match
                $UID = $row["User_ID"];
                setcookie("phar", $UID, time() + 365 * 24 * 60 * 60);
                echo "<script>window.location.href = 'dashboard.php';</script>";
            }
        }
    }
    (isset($_POST["uname"])) ? $uname = trim($_POST["uname"]) : $name = "";
    echo "<script>alert('Incorrect staff ID or password. Please try again. ');</script>";

    $result->free();
    $con->close();
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>

    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="login.css" rel="stylesheet" type="text/css"/>
        <script src="login.js" type="text/javascript"></script>
    </head>

    <body>
        <div class="wrap">
            <div class="form">
                <div class="left">
                    <video src="video1.mp4" type="video/mp4" muted autoplay loop></video>
                </div>
                <div class="right">
                    <div class="right-con">
                        <h1>Login</h1>
                        <form id="Ulogin" action="" method="post">
                            <div id="user">
                                <p><label for="uname">Username</label></p>
                                <p><input type="text" id="uname" name="uname" style="margin-bottom: 15px;" value="<?php
                                    if (isset($_POST['Userlogin'])) {
                                        echo "$uname";
                                    } else {
                                        echo '';
                                    }
                                    ?>" required></p>
                            </div>
                            <div id="passw">
                                <p><label for="pw">Password</label></p>
                                <p><input type="password" id="pw" name="pw" value="" required/></p>
                                <p><input type="checkbox" id="cbpw" onclick="showpw('pw')"><label id="cbpwtext" for="cbpw">Show Password</label></p>
                            </div>
                            <table>
                                <tr>
                                    <td style="padding-right: 10px;"><input class="btn" type="submit" value="Login" name="Userlogin" id="Userlogin"/>
                                    </td>
                                    <td><input class="btn" type="button" value="Register" onclick="window.location.href = 'register.php'" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>