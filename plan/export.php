<?php
session_start();


?>

<?php
//
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
//echo "Welcome to the member area, " . $_SESSION['username'] . "!";
    include "../include/menubar.php";
    ?>


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

        $plantable = $config['plantable'];


        ?>

        <title><?php echo $config['title']; ?></title>


    <body>


    <style>
        img.resize {
            width: 100px; /* you can use % */
            height: auto;
        }

        .menu {
            position: fixed;
            right: 10px;
            top: 20%;
            padding: 10px;
            background: #e3f2fd;
            border: 1px solid #333;
        }

        .text {
            height: 1000px;
        }
    </style>
    <style type="text/css">
        .div-fix-1 {
            position: fixed;
            top: 120px;
            left: -28px;
            width: 42px;
            height: 32px;
            z-index: 2;
        }

    </style>

    <?php
    include "../include/menubar.php";
    ?>

    <div class="row mt-lg-4 ml-3 mr-3">
        <div class="container-fluid mt-lg-5">
            Експорт плану з розділами
            <form method="POST">
                Виконавець:
                <input type="text" name="resp">
                <button type="submit"  formaction="controllers/exportw.php">Виконати</button>

            </form>

        </div>


    </div>

    <?php
    //mysqli_close($connection);
    ?>

    </body>
    </html>


    <?php
    mysqli_close($connection);
} else {
    ?>
    Please <a href="../login.php">log in</a> first to see this page.
    <?php
}

?>


