
  function del2(id) {
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

                }
            }
        );
        }

    }
