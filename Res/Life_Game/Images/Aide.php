<?php
ob_start();
print_r($_SERVER);
file_put_contents('OK',ob_get_clean());
header('Location:LG9.png');
?>