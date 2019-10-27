<?php

$_SESSION['loggedin'] = false;
$_SESSION['username'] = '';
session_start();
session_unset();
session_destroy();
?>
<script type="text/javascript">
    document.location = '/';

</script>
