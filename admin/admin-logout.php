<?php
include("../config/constants.php");
unset($_SESSION['admin-user']);
header("Location:" . SITEURL . "index.php");

?>