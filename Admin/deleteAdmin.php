<?php
session_start();
$admin=$_POST["admin"];
include "Database//Database.php";
$db = login();
$db->execQuery("delete from admin where ID='$admin';");
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