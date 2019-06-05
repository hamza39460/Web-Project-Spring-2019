<?php
    session_start();
    if (!isset($_SESSION["username"]))
        header("Location:index.php");
    if($_SESSION["usertype"]!="teacher")
        header("Location:index.php")
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
            $("#res").addClass("active");
        });
    </script>

</head>

<body>
    <?php
    include "Database//Database.php";
    $db = login();
    $usr = $_SESSION["username"];
    $result = $db->execSelectQuery("Select Student,Project,SubDetails,Date_,File from submissions where Teacher='$usr'");
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
                <form class="request-form" method="post" action="#" enctype="multipart/form-data" >
                    <span class="request-form-title">
                        Request Form
                    </span>
                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input tabindex="1" class="input2 has-val" id="supName" id="inputForm" type="text" name="supervisor" readonly>
                        <span class="focus-input2" data-placeholder="Supervisor"></span>
                    </div>
                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input tabindex="1" class="input2 has-val" id="projName" id="inputForm" type="text" name="proj" readonly>
                        <span class="focus-input2" data-placeholder="Project Name"></span>
                    </div>
                    <div class="wrap-input2 validate-input" data-validate="Details are required">
                        <textarea tabindex="2" id="projDetails" class="input2" name="details"></textarea>
                        <span class="focus-input2" data-placeholder="New Submission Details"></span>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file validate-input" >
                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <table class="container-login100-form-btn container-request-form-btn">
                        <tbody class="container-login100-form-btn container-request-form-btn">
                            <tr class="container-login100-form-btn container-request-form-btn">
                                <td class="container-login100-form-btn container-request-form-btn">
                                    <div class="login100-form-btn">
                                        <!-- <div class="request-form-bgbtn"></div> -->
                                        <input tabindex="5" type="submit" name="submit" value="Submit Paper" id="btnSendRequest1" class="login100-form-btn">
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
        <div class="notify"><span id="notifyType" class=""></span></div>
        <div class="limiter" style="background: #c4d1f6;">
            <div class="col-md-4 text-center container-fluid"> <h3>Submissions</h3></div>
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table100">
                        <table class="table1">
                            <thead>
                                <tr class="table100-head">
                                    <th>Student</th>
                                    <th>Project Name</th>
                                    <th>Submission Details</th>
                                    <th>Submission Date</th>
                                    <th>Download File</th>
                                </tr>
                            </thead>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tbody>
                                    <tr class="tr">
                                        <td ><?php echo $row["Student"] ?></td>
                                        <td ><?php echo $row["Project"] ?></td>
                                        <td ><?php echo $row["SubDetails"] ?></td>
                                        <td ><?php echo $row["Date_"] ?></td>
                                        <?php $std=$row["Student"];$strr ="http://localhost//web-project-spring-2019//Student//".$row["File"];?> 
                                        <td><a  href="<?php echo $strr ?>" download> <i class="fa fa-download"></i></a></td>
                                    </tr>
                                </tbody>
                            <?php
                        }
                    } else { ?>
                            <div class="limiter">
                                <div class="container-table100">
                                    <span class="login100-form-title p-b-43">No Submissions</span>
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
    if(isset($_POST["submit"])){
        $supervisor=$_POST["supervisor"];
        $proj=$_POST["proj"];
        $details=$_POST["details"];
        $fileName=$_FILES["file"]["name"];
        $temp_name  = $_FILES['file']['tmp_name'];
        $student=$_SESSION["username"];
        $target_file="users//$student//Submissions//$proj//".basename($_FILES["file"]["name"]);
        $filepath=pathinfo($target_file);
        $tempfileName=$filepath["filename"];
        $i=1;
        while(file_exists( $filepath["dirname"]."//".$tempfileName.".".$filepath['extension'])){
         $tempfileName=$filepath['filename']." ($i)";
         $i++;
        }
        $target_file="users//$student//Submissions//$proj//".$tempfileName.".".$filepath['extension'];
        echo $target_file;
        if (move_uploaded_file($temp_name, $target_file)){
            $qry="insert into flexq.submissions (Student,Teacher,Project,SubDetails,Date_,File) values ('$student','$supervisor','$proj','$details',CURRENT_DATE,'$target_file');"; 
            $db->execQuery1($qry);
            
        }
        
    }
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