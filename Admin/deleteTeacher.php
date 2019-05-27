<?php
session_start();
$teacher=$_POST["teacher"];
include "Database//Database.php";
$db = login();
$db->execQuery("delete from teachers where ID='$teacher';");
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