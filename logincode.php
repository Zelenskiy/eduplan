<?php

if ($_POST){
    $username = $_POST['username'];
    $pass = $_POST['password'];


    session_start();

    require 'include/config.php';
    $res = mysqli_query($connection, "SELECT * FROM `users` WHERE `username`='$username' and `password`= '$pass'");
    if (mysqli_num_rows($res) != 0){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        ?>
        <script type="text/javascript">
            document.location = '/';
        </script>
        <?php
    } else {
        $_SESSION['loggedin'] = false;
        $_SESSION['username'] = '';
        ?>
            <script type="text/javascript">
                alert("Логін чи пароль невірні");
                document.location = 'login.php';
            </script>
        <?php

    }

}

?>
<!--<script type="text/javascript">-->
<!--    document.location = '/';-->
<!---->
<!--</script>-->
