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
    <meta 'Content-Type: text/html;  charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
<!--    <script type="text/javascript" src="../js/jquery-ui.js" rel="Stylesheet"></script>-->
<!--    <script type="text/javascript" src="../js/jquery-ui-min.js"></script>-->
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.js"></script>

    <?php
    require_once ('../include/config.php');




//    $res = mysqli_query($connection, 'select `value` from `worktime_settings` where `field` = "plantable"  ;');
//    $r =mysqli_fetch_assoc($res);
//    $plantable = (String)$r['value'];
    $plantable = $config['plantable'];


    ?>

    <title><?php echo $config['title'];?></title>


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

        <select class="form-control small" id="exampleFormControlSelect2" name="rozdili"
                style="overflow-x:auto; ">
            <?php
            $sql = "select * from `plan_rubric` where `riven` = 1 and `plantable_id` = $plantable  order by `n_r` ";
            $result = mysqli_query($connection, $sql);
            while ($r1 = mysqli_fetch_assoc($result)) {
                $id = $r1['id'];
                echo '<option id="' . $r1['id'] . '" owner="' . $r1['id_owner_id'] . '"  hidden_child=true r="0">';
                echo $r1['n_r'] . '&nbsp;' . $r1['name'];
                echo '</option>';
                $sql2 = "select * from `plan_rubric` where `riven` = 2 and `id_owner_id` = $id and `plantable_id` = $plantable   order by `n_r` ";
                $result2 = mysqli_query($connection, $sql2);
                while ($r2 = mysqli_fetch_assoc($result2)) {
                    $id2 = $r2['id'];
                    echo '<option id="' . $r2['id'] . '" owner="' . $r2['id_owner_id'] . '"  hidden_child=true r="0">';
                    echo '&nbsp;' . '&nbsp;' . $r1['n_r'] . '.' . '&nbsp;' . $r2['n_r'] . '.' . '&nbsp;' . $r2['name'];
                    echo '</option>';
                    $sql3 = "select * from `plan_rubric` where `riven` = 2 and `id_owner_id` = $id2 and `plantable_id` = $plantable   order by `n_r` ";
                    $result3 = mysqli_query($connection, $sql3);
                    while ($r3 = mysqli_fetch_assoc($result3)) {
                        $id3 = $r3['id'];
                        echo '<option id="' . $r3['id'] . '" owner="' . $r3['id_owner_id'] . '"  hidden_child=true r="0">';
                        echo '&nbsp;' . '&nbsp;' . $r1['n_r'] . '.' . '&nbsp;' .$r2['n_r'] . '.' . '&nbsp;' . $r3['n_r'] . '.' . '&nbsp;' . $r3['name'];
                        echo '</option>';
                    }
                }
            }
            ?>


        </select>
    </div>

    <div id="tmp1" class="div-fix-1">
        <button class="button small" onclick="location.href="#">EW

        </button>


    </div>

    <div id="pl" class="container-fluid mt-lg-5">

    </div>


</div>

<?php
//mysqli_close($connection);
?>

</body>
</html>

<script type="text/javascript">
    var plantable = <?php
        $res = mysqli_query($connection, 'select `value` from `worktime_settings` where `field` = "plantable"  ;');
        $r =mysqli_fetch_assoc($res);
        echo $r['value'].';' ;
    ?>



    function sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds) {
                break;
            }
        }
    }

    jQuery('#exampleFormControlSelect2').on('change', function () {
        n = 1;
        a = jQuery(this).find(":selected").attr('id');

        s = "ribbon.php?r_id=" + a +"&plantable="+String(plantable);

        jQuery('#pl').load(s);
    });


    jQuery('.div-fix-1').on('mouseenter', function () {
        sleep(1000);
        jQuery(this).attr('style', 'left:1px')
    })
    jQuery('.div-fix-1').on('mouseleave', function () {
        sleep(2000);

        jQuery(this).attr('style', 'left:-28px')
    })




</script>

    <?php
    mysqli_close($connection);
} else {
    ?>
    Please <a href="../login.php">log in</a> first to see this page.
    <?php
}

?>


