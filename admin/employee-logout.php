<?php
include("../config/constants.php");
unset($_SESSION['user-employee']);
header("Location:" . SITEURL . "index.php");

?>