<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.js"></script>
    <link type="text/css" href="../css/jquery-ui.css" rel="Stylesheet"/>
    <script type="text/javascript" src="../js/jquery-ui.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-min.js"></script>

    <?php
    require_once('../include/config.php');

    //    $plantable = $config['plantable'];


    ?>

    <title><?php echo $config['title']; ?> - Робочі дні</title>


<body>
<?php
//
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
//echo "Welcome to the member area, " . $_SESSION['username'] . "!";
include "../include/menubar.php";
?>


<style>
    .td-cal {
        width: 80px;
    }

    .tr-cal {
        height: 50px;
        color: blue;
    }

    .red-cal {
        color: red;
    }

    .orange-cal {
        color: orange;
    }

    .green-cal {
        color: green;
    }

    .blue-cal {
        color: blue;
    }


    table {
        text-align: center;
        border-color: #80bdff;

    }

    .div-fix-1 {
        position: fixed;
        top: 130px;
        left: 650px;
        width: 650px;
        height: 550px;
        z-index: 2;
        background-color: #E3F2FD;
    }

    .div-menu {

        position: fixed;
        width: 165px;
        height: 55px;
        z-index: 3;
        background-color: #6f42c1;
    }

    .div-nofix-1 {
        background-color: #E3F2FD;
    }
</style>

<div id="cont" class="div-fix-1">
    <p></p>

    <div id="div-mnu" hidden class="div-menu">
        <!--               Блок для меню-->
        <select id="sel-mnu"
                style="outline:none;  width: 100%;border-color: #d39e00;overflow: hidden;border: none" size="3"
                multiple>
            <option id="mn-1" style="color: green;">Зробити чисельник</option>
            <option id="mn-2" style="color: orange;">Зробити знаменник</option>
            <option id="mn-0" style="color: red;">Зробити вихідний</option>
        </select>


    </div>

    <a style='position: fixed; bottom: 30px; right: 1px; cursor:pointer; display:none;'
       id='Top'>
        <img src="../static/images/up.png" alt="Вверх" title="Вверх">
    </a>
    <a style='position: fixed; bottom: 30px; right: 1px; cursor:pointer; display:none;'
       id='Bottom'>
        <img src="../static/images/down.png" alt="Вниз" title="Вниз">
    </a>


    <select id="sel_month" class=" ml-5 mb-2">
        <option>Вересень</option>
        <option>Жовтень</option>
        <option>Листопад</option>
        <option>Грудень</option>
        <option>Січень</option>
        <option>Лютий</option>
        <option>Березень</option>
        <option>Квітень</option>
        <option>Травень</option>

    </select> &nbsp;&nbsp;&nbsp; <span id="year"></span>

    <table id="cal-table" class=" ml-5 mb-5" border=1>
        <tr class="tr-cal bg-info">
            <td class="td-cal">Пн</td>
            <td class="td-cal">Вт</td>
            <td class="td-cal">Ср</td>
            <td class="td-cal">Чт</td>
            <td class="td-cal">Пт</td>
            <td class="td-cal red-cal">Сб</td>
            <td class="td-cal red-cal">Нд</td>
        </tr>
        <tr class="tr-cal">
            <td class="td-cal" id="0"></td>
            <td class="td-cal" id="1"></td>
            <td class="td-cal" id="2"></td>
            <td class="td-cal" id="3"></td>
            <td class="td-cal" id="4"></td>
            <td class="td-cal" id="5"></td>
            <td class="td-cal" id="6"></td>
        </tr>
        <tr class="tr-cal">
            <td class="td-cal" id="7"></td>
            <td class="td-cal" id="8"></td>
            <td class="td-cal" id="9"></td>
            <td class="td-cal" id="10"></td>
            <td class="td-cal" id="11"></td>
            <td class="td-cal" id="12"></td>
            <td class="td-cal" id="13"></td>
        </tr>
        <tr class="tr-cal">
            <td class="td-cal" id="14"></td>
            <td class="td-cal" id="15"></td>
            <td class="td-cal" id="16"></td>
            <td class="td-cal" id="17"></td>
            <td class="td-cal" id="18"></td>
            <td class="td-cal" id="19"></td>
            <td class="td-cal" id="20"></td>
        </tr>
        <tr class="tr-cal">
            <td class="td-cal" id="21"></td>
            <td class="td-cal" id="22"></td>
            <td class="td-cal" id="23"></td>
            <td class="td-cal" id="24"></td>
            <td class="td-cal" id="25"></td>
            <td class="td-cal" id="26"></td>
            <td class="td-cal" id="27"></td>
        </tr>
        <tr class="tr-cal">
            <td class="td-cal" id="28"></td>
            <td class="td-cal" id="29"></td>
            <td class="td-cal" id="30"></td>
            <td class="td-cal" id="31"></td>
            <td class="td-cal" id="32"></td>
            <td class="td-cal" id="33"></td>
            <td class="td-cal" id="34"></td>
        </tr>
        <tr id="lastRow" class="tr-cal">
            <td class="td-cal" id="35"></td>
            <td class="td-cal" id="36"></td>
            <td class="td-cal" id="37"></td>
            <td class="td-cal" id="38"></td>
            <td class="td-cal" id="39"></td>
            <td class="td-cal" id="40"></td>
            <td class="td-cal" id="41"></td>
        </tr>


    </table>


    <p>Дата: <input type="text" id="datepicker"></p>


</div>

<p>&nbsp;</p>
<div class="container-fluid mt-lg-5 ml-1 div-nofix-1">


    <p><strong>Навчальний рік:</strong>&nbsp;<?php echo $config['academic_year']; ?></p>
    <p><strong>Список робочих днів: </strong>&nbsp;</p>
    <form method="post">

        <button id="btn" type="submit">Зберегти зміни</button>
        <table id="pnl">
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp; Номер дня</td>
                <td>&nbsp; Дата дня</td>
                <td>&nbsp; Номер тижня</td>
                <td>&nbsp; День тижня</td>
                <td>&nbsp; Непарний/<br/>&nbsp; парний</td>
            </tr>
            <?php
            $worktimetable = (int)$config['worktimetable'];
            $sql = "select * from `worktime_workday` where  `worktimetable_id` = $worktimetable  order by `wday` ";
            $result = mysqli_query($connection, $sql);
            $counter = 0;

            $lengthWorkdays = mysqli_num_rows($result);


            while ($r1 = mysqli_fetch_assoc($result)) {
                $id = $r1['id'];
                $num = $r1['num'];
                $wday = $r1['wday'];
                $numworkweek = $r1['numworkweek'];
                $dayweek = $r1['dayweek'];
                $weekchzn = $r1['weekchzn'];
                $counter++;

                ?>
                <tr class="tr_wday" id="trid_<?php echo $counter; ?>">
                    <td>&nbsp; <input class="i" name="i-<?php echo $id; ?>" hidden type="text"
                                      value="<?php echo $id; ?>"
                                      size="8">&nbsp;
                    </td>
                    <td>&nbsp; <input class="n" name="n-<?php echo $id; ?>" type="text" value="<?php echo $num; ?>"
                                      oldvalue="<?php echo $num; ?>" size="8">&nbsp;
                    </td>
                    <td>&nbsp; <input class="w" name="w-<?php echo $id; ?>" type="text"
                                      value="<?php echo $wday; ?>"
                                      oldvalue="<?php echo $wday; ?>" size="8" class="calendar_my">&nbsp;
                    </td>
                    <td>&nbsp; <input class="u" name="u-<?php echo $id; ?>" type="text"
                                      value="<?php echo $numworkweek; ?>"
                                      oldvalue="<?php echo $numworkweek; ?>"
                                      size="8">&nbsp;
                    </td>
                    <td>&nbsp; <input class="d" name="d-<?php echo $id; ?>" type="text" value="<?php echo $dayweek; ?>"
                                      oldvalue="<?php echo $dayweek; ?>" size="8">&nbsp;
                    </td>
                    <td>&nbsp; <input class="e" name="e-<?php echo $id; ?>" type="text" value="<?php echo $weekchzn; ?>"
                                      oldvalue="<?php echo $weekchzn; ?>" size="8">&nbsp;
                    </td>

                </tr>
                <?php
            }
            ?>


        </table>


        <p> &nbsp;<?php echo $wday; ?></p>


        <button id="btn" type="submit">Зберегти</button>
    </form>

    <form id="date-cal-plan-form" method="post">
        <table>
            <tr>
                <td colspan="3">Чисельник</td>
                <td></td>
                <td colspan="3">Знаменник</td>

            </tr>
            <tr>
                <td>Пн</td>
                <td><input name="d1_1" type="checkbox" value="false"></td>
                <td><input type="number" name="t1_1" value="1" min="1" max="8"></td>

                <td></td>

                <td>Пн</td>
                <td><input name="d2_1" type="checkbox" value="false"></td>
                <td><input type="number" name="t2_1" value="1" min="1" max="8"></td>
            </tr>
            <tr>
                <td>Вт</td>
                <td><input name="d1_2" type="checkbox" value="false"></td>
                <td><input type="number" name="t1_2" value="1" min="1" max="8"></td>

                <td></td>

                <td>Вт</td>
                <td><input name="d2_2" type="checkbox" value="false"></td>
                <td><input type="number" name="t2_2" value="1" min="1" max="8"></td>
            </tr>
            <tr>
                <td>Ср</td>
                <td><input name="d1_3" type="checkbox" value="false"></td>
                <td><input type="number" name="t1_3" value="1" min="1" max="8"></td>

                <td></td>

                <td>Ср</td>
                <td><input name="d2_3" type="checkbox" value="false"></td>
                <td><input type="number" name="t2_3" value="1" min="1" max="8"></td>

            </tr>
            <tr>
                <td>Чт</td>
                <td><input name="d1_4" type="checkbox" value="false"></td>
                <td><input type="number" name="t1_4" value="1" min="1" max="8"></td>

                <td></td>

                <td>Чт</td>
                <td><input name="d2_4" type="checkbox" value="false"></td>
                <td><input type="number" name="t2_4" value="1" min="1" max="8"></td>

            </tr>
            <tr>
                <td>Пт</td>
                <td><input name="d1_5" type="checkbox" value="false"></td>
                <td><input type="number" name="t1_5" value="1" min="1" max="8"></td>
                <td></td>
                <td>Пт</td>
                <td><input name="d2_5" type="checkbox" value="false"></td>
                <td><input type="number" name="t2_5" value="1" min="1" max="8"></td>

            </tr>
            <tr>
                <td>Сб</td>
                <td><input name="d1_6" type="checkbox" value="false"></td>
                <td><input type="number" name="t1_6" value="1" min="1" max="8"></td>
                <td></td>
                <td>Сб</td>
                <td><input name="d2_6" type="checkbox" value="false"></td>
                <td><input type="number" name="t2_6" value="1" min="1" max="8"></td>
            </tr>
            <tr>
                <td>Нд</td>
                <td><input name="d1_7" type="checkbox" value="false"></td>
                <td><input type="number" name="t1_7" value="1" min="1" max="8"></td>
                <td></td>
                <td>Нд</td>
                <td><input name="d2_7" type="checkbox" value="false"></td>
                <td><input type="number" name="t2_7" value="1" min="1" max="8"></td>
            </tr>
            <tr>
                <td colspan="4">
                    <input name="short" type="checkbox" value="false">без року
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input name="nameDay" type="checkbox" value="false"> день тижня
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <input type="submit" formaction="controllers/calplandates.php">
                </td>
            </tr>
        </table>


    </form>

</div>


</body>
</html>

    <script type="text/javascript">


        var month = {
            'Вересень': 9,
            'Жовтень': 10,
            'Листопад': 11,
            'Грудень': 12,
            'Січень': 1,
            'Лютий': 2,
            'Березень': 3,
            'Квітень': 4,
            'Травень': 5
        }

        var stDate = <?php echo '\'' . $config['startacyear'] . '\';'?>;
        var endDate = <?php echo '\'' . $config['endacyear'] . '\';'?>;
        var id_00 = 0;
        console.log('stDate=' + stDate);
        console.log('endDate=' + endDate);

        function datediff(first, second) {
            // Take the difference between the dates and divide by milliseconds per day.
            // Round to nearest whole number to deal with DST.
            return Math.round((second - first) / (1000 * 60 * 60 * 24));
        }

        function changeChZn(date, cz) {
            //Шукаємо поле з записом потрібної дати й замінюємо поле chzn
            //Визначаємо кількість днів від першого дня року до дати date
            day_ = parseInt(date.substring(0, 2));
            month_ = parseInt(date.substring(3, 5));
            year_ = parseInt(date.substring(6));
            dateF = new Date(year_, month_ - 1, day_, 0, 0, 0, 0);

            day_ = parseInt(stDate.substring(0, 2));
            month_ = parseInt(stDate.substring(3, 5));
            year_ = parseInt(stDate.substring(6));
            dateS = new Date(year_, month_ - 1, day_, 0, 0, 0, 0);


            var diffDays = datediff(dateS, dateF);

            jQuery('#trid_' + String(diffDays + 1)).find('.e').attr('value', String(cz));
            id_ = jQuery('#trid_' + String(diffDays + 1)).find('.i').attr('value');

            jQuery.ajax({
                    url: "controllers/setchzn.php?id_=" + id_ + "&cz=" + String(cz) + "",
                    type: "GET",
                    data: {},
                    error: function () {
                        console.log("Щось не те");
                    },
                    success: function () {
                        console.log("Все Ok");
                    }
                }
            );


            y = parseInt(date.substring(6));
            m = parseInt(date.substring(3, 5));
            fillCalendar(m, y);

        }

        var date;


        jQuery('#cont').on('click', function () {
            jQuery('#div-mnu').attr("hidden", true);
        });

        jQuery('#cal-table').on('keydown', function () {
            jQuery('#div-mnu').attr("hidden", true);
        })


        jQuery('#sel-mnu').on('change', function () {
            jQuery('#div-mnu').attr("hidden", true);
            a = jQuery(this).find(":selected").attr('id');
            jQuery(this).find(":selected").attr('selected', false);
            a = a.substring(3);
            changeChZn(date, parseInt(a));
            jQuery('#div-mnu').attr("hidden", true);
        });

        jQuery('.td-cal').on('click', function () {
            jQuery('#div-mnu').attr("hidden", true);
        });

        jQuery('.td-cal').bind('contextmenu', function () {
            td = jQuery(this).attr('id');
            d = jQuery('#' + String(td)).text();
            if (d.length > 0) {
                date = jQuery('#' + String(td)).attr("date");
                chzna = jQuery('#' + String(td)).attr("chzn1");
                ident = jQuery('#' + String(td)).attr("ident");
                id_00 = parseInt(ident);
                //Тут промалюємо контекстре меню
                top_ = jQuery('#' + String(td)).offset().top;
                left_ = jQuery('#' + String(td)).offset().left;
                jQuery('#div-mnu').offset({top: top_ + 25, left: left_ + 40})
                jQuery('#div-mnu').attr("hidden", false);
            } else {
                jQuery('#div-mnu').attr("hidden", true);
            }
            return false;

        })


        function getDaysInMonth(m, y) {
            return /8|3|5|10/.test(--m) ? 30 : m == 1 ? (!(y % 4) && y % 100) || !(y % 400) ? 29 : 28 : 31;
        }


        function chzn_1(month, day) {
            r = 0;
            var lengthWorkdays = <?php echo $lengthWorkdays;?>;
            console.log('lengthWorkdays=' + lengthWorkdays);
            year_ = parseInt(stDate.substr(6));
            if (month < 9) {
                year_ += 1;
            }
            dateF = new Date(year_, month - 1, day, 0, 0, 0, 0);

            day_ = parseInt(stDate.substring(0, 2));
            month_ = parseInt(stDate.substring(3, 5));
            year_ = parseInt(stDate.substr(6));
            dateS = new Date(year_, month_ - 1, day_, 0, 0, 0, 0);

            var diffDays = datediff(dateS, dateF)
            r = jQuery('#trid_' + String(diffDays + 1)).find('.e').attr('value');

            return r
        }

        function NumToStr2(s) {
            if (s < 10)
                return '0' + String(s);
            else
                return String(s);


        }

        function fillCalendar(m, y) {
            d1 = new Date(y, m - 1, 1);
            dw = d1.getDay();
            for (i = 0; i < 43; i++) {
                nam = '#' + String(i);
                jQuery(nam).text("");
            }
            cd = getDaysInMonth(m, y)
            n = (dw + 5) % 7;
            for (i = 1; i <= cd; i++) {
                jQuery('#' + String(i + n)).text(String(i));
                chzn = chzn_1(m, i);
                jQuery('#' + String(i + n)).attr("date", NumToStr2(i) + '.' + NumToStr2(m) + '.' + NumToStr2(y))
                jQuery('#' + String(i + n)).attr("chzn1", String(chzn));
                if (chzn == 0) {
                    jQuery('#' + String(i + n)).attr("class", "red-cal")
                } else if (chzn == 1) {
                    jQuery('#' + String(i + n)).removeAttr("class");
                    jQuery('#' + String(i + n)).attr("class", "green-cal")
                } else if (chzn == 2) {
                    jQuery('#' + String(i + n)).removeAttr("class");
                    jQuery('#' + String(i + n)).attr("class", "orange-cal")
                }

            }
            if (cd + n < 35) {
                jQuery("#lastRow").attr('hidden', true)
            } else {
                jQuery("#lastRow").attr('hidden', false)
            }
            jQuery('#year').text(String(y) + " рік");


        }


        jQuery("#sel_month").on('change', function () {
            el = jQuery(this).find(":selected");
            s = el.val();
            m = month[s];
            if (m > 8) {
                y = parseInt(stDate.substring(6));
            } else {
                y = parseInt(endDate.substring(6));
            }
            jQuery('#year').text(String(y) + " рік");
            // Формуємо календар на місяць в таблиці
            fillCalendar(m, y);


        });


        jQuery('input').on('exit', function () {
            jQuery(this).attr('style', 'background-color: deeppink;');
        });

        jQuery('#btn').on('click', function () {

            jQuery('html').attr('style', 'cursor: progress;')
        })

    </script>
    <script type="text/javascript">
        jQuery("#cont").draggable(); // эта строка кода, которая делает элемент перетаскиваемым
    </script>


    <script type="text/javascript">


        jQuery("#datepicker").datepicker();

        jQuery.datepicker.setDefaults({
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

        jQuery(document).ready(function () {
            y = parseInt(stDate.substring(6));
            fillCalendar(9, y);
        });


        jQuery(function () {
            jQuery("#Top").hide().removeAttr("href");
            if (jQuery(window).scrollTop() >= "200") jQuery("#Top").fadeIn("slow")
            jQuery(window).scroll(function () {
                if (jQuery(window).scrollTop() <= "200") jQuery("#Top").fadeOut("slow")
                else jQuery("#Top").fadeIn("slow")
            });

            jQuery("#Bottom").hide().removeAttr("href");
            if (jQuery(window).scrollTop() <= jQuery(document).height() - "999") jQuery("#Bottom").fadeIn("slow")
            jQuery(window).scroll(function () {
                if (jQuery(window).scrollTop() >= jQuery(document).height() - "999") jQuery("#Bottom").fadeOut("slow")
                else jQuery("#Bottom").fadeIn("slow")
            });

            jQuery("#Top").click(function () {
                jQuery("html, body").animate({scrollTop: 0}, "slow")
            })
            jQuery("#Bottom").click(function () {
                jQuery("html, body").animate({scrollTop: jQuery(document).height()}, "slow")
            })
        });

    </script>


<?php
} else {
    ?>
    Please <a href="../login.php">log in</a> first to see this page.
    <?php
}

?>




