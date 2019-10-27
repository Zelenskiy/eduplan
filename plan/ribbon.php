<style>
    .finger {
        cursor: pointer;
    }

    .cross {
        cursor: crosshair;
    }

    .progress {
        cursor: progress;
    }


    .help {
        cursor: help;
    }
</style>
<style>
    td {
        vertical-align: top;
        horiz-align: left;
        padding-left: 5px;
        padding-right: 5px;

    }


    textarea {
        padding-top: 2px;
    }

    .div-float-button-1 {

        top: 100px;
        left: 100px;
        width: 42px;
        height: 64px;
        z-index: 2;

    }

    .btnMy {
        width: 24px;
        height: 24px;
        border-style: none;
        font-size: small;

        padding-bottom: 2px;
        background-color: #E3F2FD;

    }

    .tdNoBord {
        background-color: white;
        border-top-color: white;
        border-right-color: white;
        border-bottom-color: white;

    }

    .contentN {
        alignment: center;
    }

</style>
<script type="text/javascript">
    var oldArrea;
    var n;

    var flagForTab = true;

</script>
<a style='position: fixed; bottom: 30px; right: 1px; cursor:pointer; display:none;'
   id='Top'>
    <img src="../static/images/up.png" alt="Вверх" title="Вверх">
</a>
<a style='position: fixed; bottom: 30px; right: 1px; cursor:pointer; display:none;'
   id='Bottom'>
    <img src="../static/images/down.png" alt="Вниз" title="Вниз">
</a>

<?php
require_once ('../include/config.php');
//require_once ('../include/config.php');
$r_id = (int)$_GET['r_id'];
//$plantable = $_GET['plantable'];
$plantable = (int)$config['plantable'];
//echo '$plantable='.$plantable.'<br/>';


//$r_id = 10;
$sql = "select * from `plan_plan` where `r_id` = $r_id and `plantable_id` = $plantable order by `sort` ";
//echo '$sql='.$sql.'<br/>';
$result = mysqli_query($connection, $sql);
?>
<script type="text/javascript">
    var plantable =  <?php echo $plantable; ?>;
    // console.log('plantable =  '+plantable );
    var rtable = <?php echo $r_id; ?>;
    // console.log('r_id =  '+rtable );

</script>
<?php

if (mysqli_num_rows($result) != 0) {
    ?>
    <div id="pnl" style="background-color: #E3F2FD">

        <form id="update-form" method="post" >
            <table class="table" border="1" style="border-style: none ; border-color: white;" id="tableId"
                   onkeydown="if(event.keyCode==9) return false;">
                <?php
                $dir_no = 'hidden';
                $pur_no = 'hidden';
                ?>
                <tr name="header">
                    <td style="width: 3%;"><b>№</b></td>
                    <td <?php echo $dir_no; ?>><b>Напрям</b></td>
                    <td <?php echo $pur_no; ?>><b>Мета</b></td>
                    <td style="width: 50%;"><b>Зміст роботи</b></td>
                    <td style="width: 10%;"><b>Строки виконання</b></td>
                    <td style="width: 10%;"><b>Форма узагальнення</b></td>
                    <td style="width: 20%;"><b>Відповідальні</b></td>
                    <td style="width: 7%;"><b>Примітка</b></td>
                    <td style="width: 7%;"><b></b></td>
                    <td hidden>Сортування</td>
                    <td class="tdNoBord"></td>
                </tr>
                <?php
                $counter = 0;
                while ($r1 = mysqli_fetch_assoc($result)) {
                    $counter++;
                    $id = $r1['id'];
                    $content = $r1['content'];
                    $termin = $r1['termin'];
                    $generalization = $r1['generalization'];
                    $responsible = $r1['responsible'];
                    $note = $r1['note'];
                    $sort = $r1['sort'];
                    $show_ = $r1['show_'];
                    $direction_id = $r1['direction_id'];
                    $purpose_id = $r1['purpose_id'];
//                    $plantable_id = $r1['plantable_id'];


                    ?>
                    <!--<?php ?> -->
                    <tr id="r<?php echo $id; ?>" class="<?php echo $counter; ?>">
                        <td id="i<?php echo $id; ?>" class="contentN" name="N"
                            onclick="editField('i<?php echo $id; ?>')"
                            title="id=<?php echo $id; ?>">
                            <?php echo $counter; ?>

                        </td>
                        <td <?php echo $dir_no; ?> id="d<?php echo $id; ?>" class="content" name="direction_id">
                            <?php echo $direction_id; ?>
                        </td>
                        <td <?php echo $pur_no; ?> id="p<?php echo $id; ?>" class="content" name="purpose_id">
                            <?php echo $purpose_id; ?>
                        </td>
                        <td id="c<?php echo $id; ?>" class="content" name="content"
                            onclick="editField('c<?php echo $id; ?>')">
                            <p style="white-space: pre-line;">
                                <?php echo $content; ?>
                            </p>
                        </td>
                        <td id="t<?php echo $id; ?>" class="content" name="termin"
                            onclick="editField('t<?php echo $id; ?>')"><?php echo $termin; ?>
                        </td>
                        <td id="g<?php echo $id; ?>" class="content" name="generalization"
                            onclick="editField('g<?php echo $id; ?>')"><?php echo $generalization; ?>
                        </td>
                        <td id="v<?php echo $id; ?>" class="content" name="responsible"
                            onclick="editField('v<?php echo $id; ?>')"><?php echo $responsible; ?>
                        </td>
                        <td id="n<?php echo $id; ?>" class="content" name="note"
                            onclick="editField('n<?php echo $id; ?>')"><?php echo $note; ?>
                        </td>
                        <td hidden id="s<?php echo $id; ?>" class="content" name="sort"><?php echo $sort; ?></td>
                        <?php if ($show_ == 1) { ?>
                            <td id="h<?php echo $id; ?>" class="content" name="show"
                                onclick="editField('h<?php echo $id; ?>')"> &#10004;
                            </td>
                        <?php } else { ?>
                            <td id="h<?php echo $id; ?>" class="content" name="show"
                                onclick="editField('h<?php echo $id; ?>')"></td>
                        <?php } ?>
                        <td id="b<?php echo $id; ?>" name="N" class="contentBtn tdNoBord">
                            <button class="btnMy" id="up__<?php echo $id; ?>" type="button" title="Вгору"
                                    onclick="btnClick('up__<?php echo $id; ?>');">
                                &#8593;
                            </button>
                            <button class="btnMy" id="add_<?php echo $id; ?>" type="button" title="Додати"
                                    onclick="btnClickAdd('add_<?php echo $id; ?>');">+
                            </button>
                            <button class="btnMy" id="down<?php echo $id; ?>" type="button" title="Вниз"
                                    onclick="btnClick('down<?php echo $id; ?>');">
                                &#8595;
                            </button>
                            <p></p>
                            <button class="btnMy" id="down<?php echo $id; ?>" type="button" title="Вилучити"
                                    onclick="btnClickDel('del_<?php echo $id; ?>');">
                                -
                            </button>
                            <p></p>
                            &nbsp;<input class="chb" id="ch_b<?php echo $id; ?>" type="checkbox"/>

                        </td>

                    </tr>

                    <?php

                }

                ?>
            </table>
            <textarea hidden id="tmp_edit"></textarea>

        </form>

    </div>
    <?php
}
?>


<script type="text/javascript">

    function editField(id) {
        e = jQuery('#' + id);
        suff = id.substring(0, 1);
        id_s = id.substring(1);
        if (suff == 'h') {
            $.ajax({
                    url: '../controllers/rib_update_plan/' + id_s + '/10/',
                    type: "POST",
                    data: {show: true},
                    error: function () {
                        console.log("Щось не те");
                    },
                    success: function () {

                    }
                }
            );

            jQuery('#pl').load(s);
            return 1;
        }

        if (!flagForTab) {
            flagForTab = true;
            return false;
        }
        if ((oldArrea != undefined) && (e.attr('id') == oldArrea.attr('id'))) {
            return false;
        }


        if ((oldArrea == undefined && (suff != 'i'))) {
            //Відкриваємо textarea
            openTextarea(e);
            oldArrea = jQuery(e);
        } else if ((oldArrea == undefined) && (suff == 'i')) {
            //Нічого не робимо

        } else if (suff == 'i') {
            saveOld();
            closeOld();
            oldArrea = undefined;
        } else {
            //Закриваємо старе
            saveOld();
            closeOld();
            openTextarea(e);
            oldArrea = jQuery(e);
        }
    }


    function openTextarea(e) {
        w = jQuery(e).outerWidth(true)
        h = jQuery(e).outerHeight(true);
        id_s = jQuery(e).attr('id');
        suff = id_s.substring(0, 1);
        text = jQuery(e).text().trim();
        id_sss = '"' + jQuery(e).attr('id') + '"';
        var map1 = new Object();
        map1 = {
            'i': 'id', 'c': 'content', 't': 'termin',
            'g': 'generalization', 'v': 'responsible', 'n': 'note'
        };
        if ((suff == 'c') || (suff == 't') || (suff == 'g') || (suff == 'v') || (suff == 'n')) {
            jQuery(e).html('<textarea id="ta_edit" name="' + map1[suff] + '"' +
                ' cols="' + String(parseInt(w / 8) + 10) + '"' +
                ' rows = "' + String(parseInt(h / 28) + 2) + '"' +
                ' onkeydown="keyTextArea(event, \'' + id_s + '\'); ' +
                '    "> ' +
                text + '</textarea> ');
            //Ставимо фокус вводу і курсор в кінець
            var textarea = $('#ta_edit'),
                dat = textarea.val();
            textarea.focus().val('').val(dat);
            //------------

        } else {
            oldArrea = undefined;
        }

    }


    function saveOld() {
        console.log("value");
        var map1 = new Object();
        map1 = {
            'i': '',
            'c': '4',
            't': '5',
            'g': '6',
            'v': '7',
            'n': '8'
        };
        id = oldArrea.attr('id');

        suff = id.substring(0, 1);
        s_id = id.substring(1);
        cc = map1[suff];
        var data = jQuery("#update-form").serialize();

        jQuery.ajax({
                url: '/plan/controllers/rib_update_plan.php?s_id=' + s_id + '&cc=' + cc,
                type: "POST",
                data: data,
                error: function () {
                    // console.log("Щось не те");
                },
                success: function () {
                    // console.log("Те");
                },

            }
        );
    }

    function closeOld() {
        text = oldArrea.find('textarea').val();
        if ((text != '') && (text != undefined)) {

            text = text.trim();
        } else if (text == '') {
        }
        oldArrea.text(text);
    }


    function esc_without_save() {
        text = oldArrea.find('textarea').val();
        text = text.trim();
        oldArrea.text(text);
        oldArrea = undefined;
    }

    function tab_with_save(id_s) {
        saveOld();
        closeOld();
        suff = id_s.substring(0, 1);
        id = id_s.substring(1);
        map = {'c': 't', 't': 'g', 'g': 'v', 'v': 'n', 'n': 'i'};

        suffNew = map[suff]
        if (suffNew == 'i') {
            //Знайти наступний id та встановити suffNew = 'c'

            tr_this = jQuery('#' + id_s).parent();
            tr_next = tr_this.next();
            id_s = tr_next.find('td').attr('id').substr(1);
            suffNew = 'c'
            id = id_s
        }
        e = jQuery('#' + suffNew + id);
        openTextarea(e);
        //Ставимо фокус вводу і курсор в кінець
        //------------
        flagForTab = false
        oldArrea = jQuery(e);
    }

    function keyTextArea(e, id_s) {
        if (e.key === "Escape") {
            esc_without_save();
        } else if (e.key === "Tab") {
            tab_with_save(id_s);
        } else {


        }
        return false;
    }

    jQuery.fn.swap = function (b) {
        b = jQuery(b)[0];
        var a = this[0],
            a2 = a.cloneNode(true),
            b2 = b.cloneNode(true),
            stack = this;

        a.parentNode.replaceChild(b2, a);
        b.parentNode.replaceChild(a2, b);

        stack[0] = a2;
        return this.pushStack(stack);
    };

    function btnClickDel(id) {
        if (confirm("Вилучити запис?")) {
            suff = id.substring(0, 4);
            id = id.substring(4);
            tr_this = jQuery('#r' + id);
            data: {};
            $.ajax({
                    url: "../plan/controllers/rib_del_plan.php?id=" + id + "",
                    type: "GET",
                    cache: false,
                    data: {sort: true},
                    error: function () {
                        // console.log("Щось не те");
                    },
                    success: function () {
                        //З textarea переносимо до td
                        a = jQuery('#exampleFormControlSelect2').find(":selected").attr('id');
                        s = "ribbon.php?r_id=" + String(rtable) +"&plantable="+String(plantable);
                        jQuery('#pl').load(s);
                    }
                }
            );
        }
    }


    function btnClickAdd(id) {
        //Додати елемент знизу
        tr_this = jQuery('#' + id).parent().parent();
        tr_next = tr_this.next();

        tr_this_id = tr_this.attr('id');
        tr_next_id = tr_next.attr('id');

        suff = 's';
        this_id = tr_this_id.substring(1);
        sortThis = tr_this.children('#' + suff + this_id).text();
        th = parseFloat(sortThis.replace(',', '.'));
        if (tr_next_id != undefined) {

            next_id = tr_next_id.substring(1);
            sortNext = tr_next.children('#' + suff + next_id).text();
            ne = parseFloat(sortNext.replace(',', '.'));
        } else {
            ne = th + 2;
        }
        av = (th + ne) / 2;
        sort_ = String(av).replace('.', ',');

        tr_this.after('<tr id="newRow" style="background-color: red;">' +
            '                        <td class="contentN" name="N" style="width: 3%;color:white;">new</td>' +
            '                        <td <?php echo $dir_no; ?> class="content" name="direction_id"></td>' +
            '                        <td <?php echo $pur_no; ?> hidden class="content" name="purpose_id"></td>' +
            '                        <td  class="content" name="content"><textarea  id="contNew" cols="80" rows = "2"></textarea> </td>' +
            '                        <td  class="content" name="termin"><textarea  id="termNew"  cols="10" rows = "2"></textarea> </td>' +
            '                        <td  class="content" name="generalization"><textarea  id="genNew"  cols="10" rows = "2"></textarea> </td>' +
            '                        <td  class="content" name="responsible"><textarea  id="respNew"  cols="20" rows = "2"></textarea> </td>' +
            '                        <td  class="content" name="note"><textarea  id="noteNew"  cols="10" rows = "2"></textarea> </td>' +
            '                        <td  hidden class="content" name="sort"   id="sortNew" >' + sort_ + '</td>' +
            '                        <td  class="content" name="show"   id="showtNew" >' + '' + '</td>' +
            '                        <td  name="N" class="contentBtn tdNoBord">' +
            '                           <button class="btnMy" type="button" onclick="SaveNew();">+</button>' +
            '                           <button class="btnMy" type="button" onclick="Esc();">-</button>' +
            '                           <textarea  id="plantableNew" hidden >' + plantable + '</textarea>                ' +
            '                        </td>' +
            '                    </tr>');
        //Ставимо фокус ввода на Content
        jQuery('#contNew').focus();


    }

    function Esc(){
        jQuery('#newRow').remove();
    }


    function SaveNew() {
        content_ = jQuery('#contNew').val();
        termin_ = jQuery('#termNew').val();
        generalization_ = jQuery('#genNew').val();
        responsible_ = jQuery('#respNew').val();
        sort_ = jQuery('#sortNew').text();
        note_ = jQuery('#noteNew').val();


        $.ajax({
                url: "controllers/rib_add_plan.php",
                type: "POST",
                cache: false,

                data: {
                    content: content_,
                    termin: termin_,
                    generalization: generalization_,
                    responsible: responsible_,

                    sort: sort_,
                    note: note_,
                    plantable: plantable,
                    rtable: rtable,


                },
                error: function () {
                    console.log("Щось не те");
                },
                success: function () {

                    //З textarea переносимо до td
                    a = jQuery('#exampleFormControlSelect2').find(":selected").attr('id');



                    s = "ribbon.php?r_id=" + String(rtable) +"&plantable="+String(plantable);
                    console.log('r_id='+String(rtable));

                    jQuery('#pl').load(s);


                }
            }
        );

    }


    function btnClick(id) {
        var listId = [];

        suff = id.substring(0, 4);


        jQuery('#ch_b' + id.substring(4)).attr('checked', true);


        jQuery('tr').each(function (index, value) {
            //Проходимо по таблиці, і там, де
            if (jQuery(this).find('.chb').is(':checked')) {
                id_ = jQuery(this).find('.chb').attr('id');
                id_ = suff + id_.substring(4);

                listId.push(id_);
            }
        });
        if (suff == 'down') {
            listId.reverse();
        }


        listId.forEach(function (item, i) {

            btnClick0(item)
        });


    }


    function btnClick0(id) {


        tr_prev = jQuery('#' + id).parent().parent().prev();
        tr_this = jQuery('#' + id).parent().parent();
        tr_next = jQuery('#' + id).parent().parent().next();


        tr_this_id = tr_this.attr('id');
        tr_next_id = tr_next.attr('id');
        tr_prev_id = tr_prev.attr('id');

        id_prev = tr_prev.attr('id');
        if (id_prev != undefined) {
            id_prev = id_prev.substring(1);
        }


        id_this = tr_this.attr('id');
        if (id_this != undefined) {
            id_this = id_this.substring(1);
        }
        id_next = tr_next.attr('id');
        if (id_next != undefined) {
            id_next = id_next.substring(1);
        }
        prev_Sort = tr_prev.find('#s' + id_prev).text();
        this_Sort = tr_this.find('#s' + id_this).text();
        next_Sort = tr_next.find('#s' + id_next).text();


        oldNum = jQuery('#' + id).parent().parent().find('#i' + id_this).text();
        oldNum = oldNum.trim();


        idBtn = jQuery('#' + id).attr('id');
        if (idBtn != undefined) {
            idBtn = idBtn.substring(0, 4);
        }
        if ((idBtn == 'down')) {
            //Якщо елемент не останній

            //Міняємо поле sort місцями
            tr_next.find('#s' + id_next).text(this_Sort);
            tr_this.find('#s' + id_this).text(next_Sort);
            //Міняємо елементи місцями
            jQuery('#' + tr_this_id).swap(jQuery('#' + tr_next_id));
            // і прокрутить вгору на висоту даної комірки щоб мишка залишилася над полем, яке рухаємо

            y0 = jQuery('html').scrollTop();
            dy = jQuery('#' + id).parent().parent().next().outerHeight(true);
            destenation = y0 + dy;
            jQuery('html').animate({scrollTop: destenation}, 600);

            //Зберігаємо
            adj_for_sort(id_next, this_Sort);
            adj_for_sort(id_this, next_Sort);
        }

        if ((idBtn == 'up__')) {
            //Якщо елемент не останній

            //Міняємо поле sort місцями
            tr_prev.find('#s' + id_prev).text(this_Sort);
            tr_this.find('#s' + id_this).text(prev_Sort);
            //Міняємо елементи місцями
            jQuery('#' + tr_this_id).swap(jQuery('#' + tr_prev_id));
            // і прокрутить вниз на висоту даної комірки щоб мишка залишилася над полем, яке рухаємо

            y0 = jQuery('html').scrollTop();
            dy = jQuery('#' + id).parent().parent().prev().outerHeight(true);
            destenation = y0 - dy;
            jQuery('html').animate({scrollTop: destenation}, 600);

            //Зберігаємо
            adj_for_sort(id_prev, this_Sort);
            adj_for_sort(id_this, prev_Sort);

        }


    }

    function adj_for_sort(id, sort0) {
        // console.log(2222222222);
        jQuery.ajax({
                url: '/plan/controllers/rib_update_plan.php?s_id=' + id + '&cc=9',
                type: "POST",
                cache: false,
                data: {
                    sort: sort0
                },
                error: function () {
                    console.log("Щось не те");
                },
                success: function () {

                    // jQuery('#pnl').load('../repltable/');
                }
            }
        );
    }


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
mysqli_close($connection);
?>

