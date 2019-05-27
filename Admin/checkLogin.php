    <?php
    
    include "Database//Database.php";
    $db = new database();
    $db->__init($_POST["email"], $_POST["pass"]);
    $db->checkLogin();
    ?>