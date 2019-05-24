<?php
session_start();
$name=$_POST["name"];
$details=$_POST["details"];
$student=$_POST["student"];
$teacher=$_SESSION["username"];
include "Database//Database.php";
$db = login();

$qry="insert into supervision values ('$student','$teacher','$name','$details'); \n";
$qry1="delete from requests where teachers='$teacher' AND Student='$student';";
$qries=array($qry,$qry1);
$db->execMultiQuery($qries);
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