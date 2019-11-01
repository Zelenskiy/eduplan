   function del(id) {
        console.log(id);
        if (confirm('Вилучити запис?')){
            $.ajax({
                url: "controllers/replace_del_teacher.php" + String(id) + "/",
                type: "POST",
                cache: false,
                data: { sort:id},
                error: function () {
                    console.log("Щось не те");
                },
                success: function () {
                    jQuery('#pnl').load('../repltable/');
                }
            }
        );
        }

    }
