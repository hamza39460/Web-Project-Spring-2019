<?php
session_start();
$name=$_POST["name"];
$details=$_POST["details"];
$teacher=$_POST["teacher"];
$student=$_SESSION["username"];
include "Database//Database.php";
$db = login();
$db->execQuery("update requests set Name='$name',Details='$details' where Student='$student' AND teachers='$teacher'");
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