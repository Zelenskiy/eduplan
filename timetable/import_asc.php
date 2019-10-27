<!DOCTYPE html>
<html lang="en">
<head>
    <meta
    'Content-Type: text/html; charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!--    <script type="text/javascript" src="../js/jquery-ui.js" rel="Stylesheet"></script>-->
    <!--    <script type="text/javascript" src="../js/jquery-ui-min.js"></script>-->
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.js"></script>

    <?php
    require_once('../include/config.php');


    ?>

    <title>Імпорт розкладу з ASC XML</title>


<body>
<form method="post"  action="controllers/import.php" enctype="multipart/form-data">
    <input type="file" name="userfile" />
    <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>

    <input type="submit" value="Розпочати"/>

</form>

</body>
</html>
