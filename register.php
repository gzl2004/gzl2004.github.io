<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>

    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="register.css" rel="stylesheet" type="text/css"/>
        <script src="login.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body>

        <?php
        require_once 'helper.php';
        $err = [];
        if (isset($_POST['mreg'])) {
            //Yes, user clicked the button
            (isset($_POST["uname"])) ? $Uname = trim($_POST["uname"]) : $Uname = "";
            (isset($_POST["pw"])) ? $passT = trim($_POST["pw"]) : $passT = "";
            (isset($_POST["pw1"])) ? $pass = trim($_POST["pw1"]) : $pass = "";

            if ($passT != $pass) {
                $err[] = 'Password not match. ';
            }
            $err[] = strongPass($passT);

            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = "SELECT * FROM user";
            $dupli = 0;
            if ($result = $con->query($sql)) {
                while ($record = $result->fetch_Object()) {
                    if ($record->Username == $Uname) {
                        $dUN = 'Username already exists. ';
                    }
                }
                if (!empty($dUN)) {
                    $err[] = $dUN;
                    $Uname = '';
                }
                $err = array_filter($err);

                if (empty($err)) {
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $sql = "SELECT MAX(User_ID) AS max_id FROM user";
                    $result = $con->query($sql);
                    $row = $result->fetch_assoc();
                    $max_id = $row['max_id'];

                    $id_num = (int) substr($max_id, 1) + 1;
                    $new_id = sprintf("U%04d", $id_num);

                    $result->free();
                    $con->close();

                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $sql = "INSERT INTO user(User_ID, Username, Password) VALUES(?,?,?)";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param('sss', $new_id, $Uname, $pass);
                    $stmt->execute();
                    if ($stmt->affected_rows == 0) {
                        $err[] = "Unable to insert. Please try again. ";
                    } else {
                        echo "<script>alert('Successfully register. ');</script>";
                        echo "<script>window.location.href = 'login.php';</script>";
                    }
                } else {
                    echo "<script>alert('";
                    foreach ($err as $value) {
                        printf('%s', $value);
                    }
                    echo "');</script>";
                }
            }
        }
        ?>
        <div class="wrap">
            <div class="form">
                <div class="right">
                    <div class="right-con">
                        <h1>Register</h1>
                        <form id="reg" method="post" action="" name="reg">   
                            <div id="user">
                                <p><label for="uname">Username</label></p>
                                <p><input type="text" id="uname" name="uname" value="<?php
                                    if (isset($_POST['mreg'])) {
                                        echo "$Uname";
                                    } else {
                                        echo '';
                                    }
                                    ?>" onChange="ajaxFunction();"  required/></p>
                            </div>
                            <div id="passw">
                                <p style="margin-top: 11px;"><label for="pw">Password</label></p>
                                <p><input type="password" class="pws" id="pw" name="pw" value="" required/></p>
                                <p><input type="checkbox" id="rcbpw" onclick="showpw('pw')"><label class="cbpwtext" for="rcbpw">Show Password</label></p>
                            </div>
                            <div id="passw">
                                <p><label for="pw1">Confirm Password</label></p>
                                <p><input type="password" class="pws" id="pw1" name="pw1" value="" required/></p>
                                <p><input type="checkbox" id="rcbpw1" onclick="showpw('pw1')"><label class="cbpwtext" for="rcbpw1">Show Password</label></p>
                            </div>
                            <table>
                                <tr>
                                    <td style="padding-right: 10px;"><input class="btn" type="submit" value="Register" name="mreg" id="mreg"/>
                                    </td>
                                    <td><input class="btn" type="button" value="Back To Login" onclick="window.location.href = 'login.php'" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        document.getElementById('Spic').focus();
        $(document).ready(function () {
<?php if (!empty($err)): ?>
                console.log('Showing pop-up window with error message.');
                $('.popup').fadeIn();
                $('.close-btn').click(function () {
                    console.log('Closing pop-up window.');
                    $('.popup').fadeOut();
                });
<?php endif; ?>
        });
    </script>
</html>