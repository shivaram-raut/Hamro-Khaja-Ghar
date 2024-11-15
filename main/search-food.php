<?php
include("../config/constants.php");

if(isset($_POST['searched-food'])){
    $searched_food = $_POST['searched-food'];

    $_SESSION['searched_food'] = $searched_food;

  header("Location:".SITEURL."main/food-menu.php?searched-food=".$searched_food);

}
else{
  header("Location:".SITEURL."main/food-menu.php");

}

?>