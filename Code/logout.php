<?php
session_start();
session_unset();
session_destroy();


echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
?>
