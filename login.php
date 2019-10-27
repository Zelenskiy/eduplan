
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        include('include/config.php');
        echo $config['title'] ?></title>
</head>
<body>
<form method="POST" action="logincode.php">
    <input name="username" type="text">
    <input name="password"  type="password">
    <input type="submit">

</form>
<?php

?>
</body>
</html>

