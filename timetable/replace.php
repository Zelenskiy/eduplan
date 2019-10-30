<?php
require_once('../include/config.php');
?>

<html>
<head>
    <title>
        Генерація замін
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-min.js"></script>
    <script type="text/javascript" src="../js/replace.js"></script>

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
<!--TODO-->
<!--Передбачити аутентифікацію-->

<a href="../">Головна</a>

<div class="row mt-lg-5 ml-1 mr-1">
    <div class="col-sm  w-100 ">
        <p class=" ml-1" style="font-size: 22px;">Дані про відсутнього вчителя</p>
        <form method="post" action="controllers/replace_cntrl.php">


            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label ">Відсутн. &nbsp;&nbsp;&nbsp; </label>
                <div class="col-sm-10">
                    <select name="teach" required id="id_teach"  class="form-control" >
                        <option value="" selected>---------</option>
                        <?php
                        $sql = "SELECT * FROM `" . $config['timetable_teacher'] . "`";
                        $result = mysqli_query($connection, $sql);
                        while ($r1 = mysqli_fetch_assoc($result)) {
                            $id = $r1['id'];
                            $name = $r1['name'];
                            ?>
                            <option value="<?php echo $id ?>"><?php echo $name ?></option> <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

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
                <label for="inputEmail3" class="col-sm-2 col-form-label mr-0">причина  &nbsp; &nbsp; </label>
                <div class="col-sm-10">
                    <select name="teach" required id="reason"  class="form-control" >
                        <option value="" selected>---------</option>
                        <?php
                        $sql = "SELECT * FROM `" . $config['timetable_reasons'] . "` ORDER BY `sort`";
                        $result = mysqli_query($connection, $sql);
                        while ($r1 = mysqli_fetch_assoc($result)) {
                            $id = $r1['id'];
                            $name = $r1['name'];
                            ?>
                            <option value="<?php echo $id ?>"><?php echo $name ?></option> <?php
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="form-inline">
                <div class="custom-control custom-checkbox  my-1 mr-sm-2 ml-lg-5">
                    <input type="checkbox" id="kl_ker"  class="form-control"> Кл. керівн.
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" id="poch_kl"  class="form-control">  Поч. класи
                </div>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <button type="submit" class="btn btn-outline-primary ">Додати</button>
                </div>
            </div>
        </form>


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
                {% for miss in missing %}
                <tr>
                    <td>{{ miss.teach.short }}</td>
                    <td>{{ miss.date_st|date:"d.m" }}</td>
                    <td>{{ miss.date_fin|date:"d.m" }}</td>
                    <td>{{ miss.reason }}</td>
                    <td>
                        {% if miss.kl_ker %}
                        Так
                        {% else %}
                        Ні
                        {% endif %}
                    </td>
                    <td>
                        {% if miss.poch_kl %}
                        Так
                        {% else %}
                        Ні
                        {% endif %}
                    </td>
                    <td>
                        <button class="btn  " type="button" onclick="del({{ miss.id }});"> -</button>
                    </td>

                </tr>
                {% endfor %}


            </table>


        </div>
    </div>

    <div class="col-sm   w-100 ">
        <p class=" ml-1" style="font-size: 22px;">Генерація таблиці замін</p>
        <form id="#update-form2" method="post"> {% csrf_token %}


            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Початок </label>
                <div class="col-sm-10">
                    <input type="text" id="datepicker3" name="datepicker3" class="form-control"
                           value="{{ st }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Кінець </label>
                <div class="col-sm-10">
                    <input type="text" id="datepicker4" name="datepicker4" class="form-control"
                           value="{{ fin }}">

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

        <form id="#uploadForm2" method="post" enctype="multipart/form-data"> {% csrf_token %}


            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Початок </label>
                <div class="col-sm-10">
                    <input type="text" id="datepicker5" name="datepicker5" class="form-control"
                           value="{{ sthist }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Кінець </label>
                <div class="col-sm-10">
                    <input type="text" id="datepicker6" name="datepicker6" class="form-control"
                           value="{{ finhist }}">

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
                        {# onclick="genReplhist();" #}
                        formaction="../repl_3/"
                        title="">
                    Генерувати П.З.
                </button>
            </div>
        </form>
        <p></p>
    </div>


</div>


<!--            <script type="text/javascript">-->
<!--                alert("Увійдіть");-->
<!--                document.location.href = '/accounts/login/';-->
<!---->
<!--</script>-->


{% endif %}
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
{# <input id="worktimeable" type="text" value="{{ worktimeable }}">#}

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

{% endblock %}


</body>
</html>



