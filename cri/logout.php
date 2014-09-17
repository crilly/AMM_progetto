<?php
session_start(); 
include("config.php");
session_destroy();
print("<script> location.replace('index.php'); </script>");
   
?>
   