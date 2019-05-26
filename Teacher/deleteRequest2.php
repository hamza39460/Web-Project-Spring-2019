<?php
session_start();
$teacher=$_POST["teacher"];
$student=$_SESSION["username"];
include "Database//Database.php";
$db = login();
$db->execQuery("delete from supervision where teacher='$teacher' AND Student='$student';");

    ?>
 <?php
    function login()
    {
        $db = new database();
        $db->__init($_SESSION["username"], $_SESSION["pwd"]);
        $db->startDBConnection();
        return $db;
    }
    ?>