<?php
require_once('../include/config.php');
?>

<html>
<head>
    <title> Генерація замін </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui.js"></script>
<!--    <script type="text/javascript" src="../js/replace.js"></script>-->
<!--    <script type="text/javascript" src="../js/repltable.js"></script>-->
    <style type="text/css">
        .dataTable tbody tr:nth-child(1n) {
            background-color: #bee5eb;
            border-color: white;
            border-style: solid;
            border-width: 1px;
        }

        .dataTable tbody tr:nth-child(2n) {
            background-color: #E3F2FD;
            border-color: white;
            border-style: solid;
            border-width: 1px;

        }

        td {
            text-align: center;
            border-color: white;
            border-style: solid;
            border-width: 1px;
        }

        .td-header {
            border-color: #17A2B8;
            font-size: 12px;
        }
    </style>
</head>
<body>
<!--TODO Передбачити аутентифікацію -->


<a href="../">Головна</a>

<div class="row mt-lg-5 ml-1 mr-1">
    <div class="col-sm  w-100 ">
        <p class=" ml-1" style="font-size: 22px;">Дані про відсутнього вчителя</p>
        <form method="post" action="controllers/replace_add_teacher.php">


            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label ">Відсутн. &nbsp;&nbsp;&nbsp; </label>
                <div class="col-sm-10">
                    <select name="teach_id" required id="id_teach" class="form-control" onchange="{
                        var a=document.getElementById('id_teach').value;
                        jQuery('#t_id').val(a);
                    }">
                        <option value="" selected>---------</option>
                        <?php
                        $sql = "SELECT * FROM `" . $config['timetable_teacher'] . "`";
                        $result = mysqli_query($connection, $sql);
                        while ($r1 = mysqli_fetch_assoc($result)) {
                            $id = $r1['id'];
                            $name = $r1['name'];
                            ?>
                            <option  value="<?php echo $id ?>"><?php echo $name ?></option> <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <input hidden id="t_id" name="teach_id" value = "">
            <input hidden id="reas" name="reason" value = "">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">з </label>
                <div class="col-sm-10">
                    <input type="text" name="date_st" id="datepicker1" name="datepicker1" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">по </label>
                <div class="col-sm-10">
                    <input type="text" name="date_fin" id="datepicker2" name="datepicker2" class="form-control"
                           required>


                </div>
            </div>


            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label mr-0">причина &nbsp; &nbsp; </label>
                <div class="col-sm-10">
                    <select id="id_reason" name="reason" required id="reason" class="form-control" onchange="{
                        var a=document.getElementById('id_reason').value;
                        jQuery('#reas').val(a);
                    }">
                        <option value="" selected>---------</option>
                        <?php
                        $sql = "SELECT * FROM `" . $config['timetable_reasons'] . "` ORDER BY `sort`";
                        $result = mysqli_query($connection, $sql);
                        while ($r1 = mysqli_fetch_assoc($result)) {
                            $id = $r1['id'];
                            $name = $r1['name'];
                            ?>
                            <option value="<?php echo $name ?>"><?php echo $name ?></option> <?php
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="form-inline">
                <div class="custom-control custom-checkbox  my-1 mr-sm-2 ml-lg-5">
                    <input name="kl_ker" type="checkbox" id="kl_ker" class="form-control"> Кл. керівн.
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input name="poch_kl" type="checkbox" id="poch_kl" class="form-control"> Поч. класи
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <button type="submit" class="btn btn-outline-primary ">Додати</button>
                </div>
            </div>
        </form>

        <?php
        function date_for_sql($arg_1)
        {
            $day = substr($arg_1,0,2);
            $month = substr($arg_1,3,2);
            $year = substr($arg_1,6,4);
            $retval = $year . '-' . $month . '-' . $day ;
            return $retval;
        }
        function date_from_sql($arg_1)
        {
            $day = substr($arg_1,8,2);
            $month = substr($arg_1,5,2);
            $year = substr($arg_1,0,4);
            $retval = $day . '.' . $month;
            return $retval;
        }
        function date_from_sql_full($arg_1)
        {
            $day = substr($arg_1,8,2);
            $month = substr($arg_1,5,2);
            $year = substr($arg_1,0,4);
            $retval = $day . '.' . $month . '.' . $year;
            return $retval;
        }
        //31.10.2019
            //2019-10-31
        ?>

        <div id="pnl">

            <table class="dataTable ">
                <tr class="bg-info text-white">
                    <td class="td-header">Вчитель</td>
                    <td class="td-header">Початок</td>
                    <td class="td-header">Кінець</td>
                    <td class="td-header">Причина</td>
                    <td class="td-header">Кл.кер.</td>
                    <td class="td-header">Поч.кл.</td>
                    <td class="td-header">Вилучити</td>
                </tr>
                <?php
                $sql = "SELECT * FROM `worktime_settings` WHERE `field`='startacyear'";
                $result = mysqli_query($connection, $sql);
                while ($r1 = mysqli_fetch_assoc($result)) {
                    $startacyear =date_for_sql( $r1['value']);
                    break;
                }
                $sql = "SELECT * FROM `worktime_settings` WHERE `field`='endacyear'";
                $result = mysqli_query($connection, $sql);
                while ($r1 = mysqli_fetch_assoc($result)) {
                    $endacyear = date_for_sql($r1['value']);
                    break;
                }
                $sql = "SELECT * FROM `worktime_settings` WHERE `field`='histzamst'";
                $result = mysqli_query($connection, $sql);
                while ($r1 = mysqli_fetch_assoc($result)) {
                    $st = date_for_sql($r1['value']);
                    break;
                }
                $sql = "SELECT * FROM `worktime_settings` WHERE `field`='histzamfin'";
                $result = mysqli_query($connection, $sql);
                while ($r1 = mysqli_fetch_assoc($result)) {
                    $fin = date_for_sql($r1['value']);
                    break;
                }



                $sql = "SELECT *, m.id as `miss_id` 
                        FROM `worktime_missing` AS m INNER JOIN `timetable_teacher` AS t
                        ON m.`teach_id` = t.`id` WHERE m.`date_st` >= '$startacyear' and m.`date_fin` <= '$endacyear' ;";


                $result = mysqli_query($connection, $sql);

                while ($r1 = mysqli_fetch_assoc($result)) {
                    $id = $r1['miss_id'];
                    $date_st = date_from_sql($r1['date_st']);
                    $date_fin = date_from_sql($r1['date_fin']);
                    $reason = $r1['reason'];
                    $kl_ker = $r1['kl_ker'];
                    $poch_kl = $r1['poch_kl'];
                    $teach_id = $r1['teach_id'];
                    $teach_short = $r1['short'];
                    ?>
                    <tr>
                        <td><?php echo $teach_short ?></td>
                        <td><?php echo $date_st ?></td>
                        <td><?php echo $date_fin ?></td>
                        <td><?php echo $reason ?></td>
                        <td>
                            <?php  if ($kl_ker == "1") {
                                echo "так";
                            } else {
                                echo "ні";
                            } ?>
                        </td>
                        <td>
                            <?php  if ($poch_kl == "1") {
                                echo "так";
                            } else {
                                echo "ні";
                            } ?>

                        </td>
                        <td>
                            <button class="btn  " type="button" onclick="del(<?php echo $id ?>);"> -</button>
                        </td>

                    </tr>
                    <?php

                }
                ?>


            </table>


        </div>
    </div>

    <script>
        function del(id) {
            console.log(id);
            if (confirm('Вилучити запис?')){
                $.ajax({
                        url: "controllers/replace_del_teacher.php/" ,
                        type: "POST",
                        cache: false,
                        data: { id:id},
                        error: function () {
                            console.log("Щось не те");
                        },
                        success: function () {
                            // перезавантажуємо сторінку
                            window.location.reload();

                        }
                    }
                );
            }

        }
    </script>



    <div class="col-sm   w-100 ">
        <p class=" ml-1" style="font-size: 22px;">Генерація таблиці замін</p>
        <form id="#update-form2" method="post">


            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Початок </label>
                <div class="col-sm-10">
                    <input type="text" id="datepicker3" name="datepicker3" class="form-control"
                           value="<?php echo date_from_sql_full($st); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Кінець </label>
                <div class="col-sm-10">
                    <input type="text" id="datepicker4" name="datepicker4" class="form-control"
                           value="<?php echo date_from_sql_full($fin); ?>">

                </div>

            </div>
        </form>
        <div class="custom-control custom-checkbox my-1 mr-sm-2">
            <button onclick="genRepl();" class="btn btn-outline-primary ml-lg-5">
                Розрахувати
            </button>
        </div>
        <p></p>
        <div class="form-group row mr-1 ml-3">

            <div class="input-group">
        <textarea type="text" rows="30" id="result" name="result"
                  class="form-control" style="overflow-x: auto;font-size:8px;"></textarea>
            </div>
        </div>


    </div>

    <div class=" ">
        <p class=" ml-3 mr-3" style="font-size: 22px;">Генерація пояснюючої записки</p>

        <form id="#uploadForm2" method="post" enctype="multipart/form-data">


            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Початок </label>
                <div class="col-sm-10">
                    <input type="text" id="datepicker5" name="datepicker5" class="form-control"
                           value="<?php echo date_from_sql_full($st); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Кінець </label>
                <div class="col-sm-10">
                    <input type="text" id="datepicker6" name="datepicker6" class="form-control"
                           value="<?php echo date_from_sql_full($fin); ?>">

                </div>

            </div>


            <div class="custom-file ">
                <input type="file" class="custom-file-input" id="validatedCustomFile" name="upload" accept=".xlsx"
                       required>
                <label class="custom-file-label" for="validatedCustomFile">Виберіть файл...</label>
                <div class="invalid-feedback">Файл Excel, до якого записоно заміни уроків</div>
            </div>

            <div class="custom-control row custom-checkbox my-1 mr-sm-1 mt-3">
                <button class="btn btn-outline-primary  btn-block"
                        id="hist_btn"
                        type="submit"
                        formaction="../repl_3/"
                        title="">
                    Генерувати П.З.
                </button>
            </div>
        </form>
        <p></p>
    </div>


</div>





<script type="text/javascript">


    $("#datepicker1").datepicker();
    $("#datepicker2").datepicker();
    $("#datepicker3").datepicker();
    $("#datepicker4").datepicker();
    $.datepicker.setDefaults({
        dayNames: ["Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота"],
        dayNamesShort: ["Нед", "Пон", "Вів", "Сер", "Чет", "П'я", "Суб"],
        dayNamesMin: ["Нд", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
        dateFormat: "dd.mm.yy",
        firstDay: 1,
        monthNames: ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"],
        monthNamesShort: ["Січ", "Лют", "Бер", "Кві", "Тра", "Чер", "Лип", "Сер", "Вер", "Жов", "Лис", "Гру"],
    });

</script>


<script type="text/javascript">


    function genRepl() {
        //Обробка кнопки початку генерації таблиці замін


        //Генеруємо
        {
            #var
            data = $("#update-form2").serialize();
            #
        }
        data = {};
        data['datepicker3'] = $('#datepicker3').val();
        data['datepicker4'] = $('#datepicker4').val();
        {
            #console.log($('#datepicker4').val());
            #
        }
        console.log(data);
        jQuery.ajax({
            url: "../replgen/",
            type: "POST",
            cache: false,
            data: data,
            error: function () {
                console.log("Щось не те");
            },
            success: function () {
                console.log("success");
                console.log(data);
                jQuery('#result').load('../resp/');
                {
                    #jQuery('#result').val(data['text']);
                    #
                }
                //Зберігаємо поля дат
            }
        });
        data['datepicker3'] = $('#datepicker3').val();
        data['datepicker4'] = $('#datepicker4').val();
        console.log('save');
        console.log(data);
        jQuery.ajax({
            url: "../datesave/",
            type: "POST",
            cache: false,
            data: data,
            error: function () {
                console.log("Щось не те в збереженні дат");
            },
            success: function () {
                console.log("success");

            }
        });


    }




</script>




</body>
</html>



