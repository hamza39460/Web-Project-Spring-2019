<!DOCTYPE html>
<html>

<head>
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <script>
        $(document).ready(function() {
            $("#hmp").addClass("active");
        });
    </script>

</head>

<body>
    <?php
    session_start();
    include "navBar.html";
    if (!isset($_SESSION["username"]))
        header("Location:index.php");
    include "Database//Database.php";
    $db = login();
    $usr = $_SESSION["username"];
    $result = $db->execSelectQuery("Select Student,Name,Details from Supervisions where teachers='$usr'");
    if (mysqli_num_rows($result) > 0) {
        ?>
        <div class="notify"><span id="notifyType" class=""></span></div>
        <div class="limiter">
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table100">
                        <table class="table1">
                            <thead>
                                <tr class="table100-head">
                                    <th>Student</th>
                                    <th>Project Name</th>
                                    <th>Details</th>
                                    <th>Confirm</th>
                                    <th>Delete Supervision</th>
                                </tr>
                            </thead>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tbody>
                                    <tr class="tr">
                                        <td class="email"><?php echo $row["Student"] ?></td>
                                        <td class="name"><?php echo $row["Name"] ?></td>
                                        <td class="details"><?php echo $row["Details"] ?></td>
                                        <td><span class="add"> <i class="fa fa-check"></i></span></td>
                                        <td><span class="dlt"> <i data-toggle="modal" data-target="#modalConfirmDelete" class="fa fa-trash-o"></i></span></td>
                                    </tr>
                                </tbody>
                            <?php
                        }
                    } else { ?>
                            <div class="limiter">
                                <div class="container-table100">
                                    <span class="login100-form-title p-b-43">No Requests Submitted</span>
                                </div>
                            </div>
                                <?php
                            }

                            ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Functions-->
    <?php
    function login()
    {
        $db = new database();
        $db->__init($_SESSION["username"], $_SESSION["pwd"]);
        $db->startDBConnection();
        return $db;
    }
    ?>
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</body>

</html>