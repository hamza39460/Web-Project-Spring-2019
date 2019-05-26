<?php
session_start();
$student=$_POST["student"];
$teacher=$_SESSION["username"];
include "Database//Database.php";
$db = login();
$db->execQuery("delete from requests where teachers='$teacher' AND Student='$student';");
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