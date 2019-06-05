<?php
session_start();
if (!isset($_SESSION["username"]))
    header("Location:index.php");
if($_SESSION["usertype"]!="student")
    header("Location:index.php");
?>
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
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <script>
        $(document).ready(function() {
            $("#subReq").addClass("active");
            loadImg();
        });
    </script>
    <title>Requests</title>
</head>

<!-- <body id="supervisors_"> -->

<script>

</script>
<?php
include "Database//Database.php";
$db = login();
$usr = $_SESSION["username"];
$result = $db->execSelectQuery("Select teachers,Name,Details from Requests where Student='$usr'");
?>
<div class="notify"><span id="notifyType" class=""></span></div>
<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Are you sure?</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                <i class="fa fa-times fa-4x animated rotateIn"></i>
            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">
                <input id="ConfirmModal" type="button" value="Yes" data-dismiss="modal" href="" class="login100-form-btn">
                <input id="CancelModal" type="button" value="No" data-dismiss="modal" class="login100-form-btn">
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-----------Request Form----------->
<div id="requestForm" class="bg-request" style="display:none">
    <div class="container-request">
        <div class="wrap-request">
            <form class="request-form">
                <span class="request-form-title">
                    Request Form
                </span>
                <div class="wrap-input2 validate-input" data-validate="Name is required">
                    <input tabindex="1" class="input2 has-val" id="projName" id="inputForm" type="text" name="name">
                    <span class="focus-input2" data-placeholder="Project Name"></span>
                </div>
                <div class="wrap-input2 validate-input" data-validate="Details are required">
                    <textarea tabindex="2" id="projDetails" class="input2 has-val" name="Details"></textarea>
                    <span class="focus-input2" data-placeholder="Details"></span>
                </div>
                <table class="container-login100-form-btn container-request-form-btn">
                    <tbody class="container-login100-form-btn container-request-form-btn">
                        <tr class="container-login100-form-btn container-request-form-btn">
                            <td class="container-login100-form-btn container-request-form-btn">
                                <div class="login100-form-btn">
                                    <!-- <div class="request-form-bgbtn"></div> -->
                                    <input tabindex="5" type="button" value="Submit Changes" id="btnSendRequest2" class="login100-form-btn">
                                </div>
                            </td>
                            <td class="container-login100-form-btn container-request-form-btn">
                                <div class="login100-form-btn">
                                    <input tabindex="6" type="button" value="Cancel" id="btncancel" class="login100-form-btn">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
include "navBar.html";
if (mysqli_num_rows($result) > 0) {
    ?>
<div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100">
                    <table class="table1">
                        <thead>
                            <tr class="table100-head">
                                <th>Teachers</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th>Edit</th>
                                <th>Delete Request</th>
                            </tr>
                        </thead>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <tbody>
                                <tr class="tr">
                                    <td class="email"><?php echo $row["teachers"] ?></td>
                                    <td class="name"><?php echo $row["Name"] ?></td>
                                    <td class="details"><?php echo $row["Details"] ?></td>
                                    <td><span class="edit"> <i class="fa fa-pencil-square-o"></i></span></td>
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
<html>