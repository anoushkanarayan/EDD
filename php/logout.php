<?php 
session_set_cookie_params(0);
session_start();

$dirname = "../temp_accounts/" . $_SESSION['first_name'] . $_SESSION['last_name'] . $_SESSION['acc_num'];
array_map('unlink', glob("$dirname/*.*"));
rmdir($dirname);

session_unset();
session_destroy();
header("Location: http://innovc.io/index.html");

?>
