<?php
include_once("../header.php");
if($functions->signOut())
{
    header("Location: login.php");
    exit();
}
?>
