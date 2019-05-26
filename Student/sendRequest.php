<?php
session_start();
$name=$_POST["name"];
$details=$_POST["details"];
$teacher=$_POST["teacher"];
$student=$_SESSION["username"];
include "Database//Database.php";
$db = login();
$db->execQuery("insert into requests values ('$student','$teacher','$name','$details');");
mkdir("users//$email//Submissions//$name");
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