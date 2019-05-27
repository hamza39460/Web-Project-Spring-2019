<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
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

    <!--===============================================================================================-->

</head>

<body class="loader" style="background-color: #000000;">
    <div class="notify"><span id="notifyType" class=""></span></div>
    <!--LOGIN Form-->
    <!--Registration Form-->
    <div class="limiter" id="regForm">
        <!--LOGIN Container-->
        <div class="container-login100">
        <div class="notify"><span id="notifyType" ></span></div>    
            <div class="wrap-login100">

                <!-- FORM-->
                <form id="regForm" style="padding-top:50px" method="post" action="#" enctype="multipart/form-data" class="login100-form validate-form">
                    <div class="container" style="display:center;text-align:center;padding-bottom:8px">
                        <i class="fas fa-user-graduate" style="font-size:120px;"></i>
                    </div>
                    <span style="padding-bottom:30px" class="login100-form-title p-b-43">
                        Signup to continue
                    </span>
                    <div class="text-center p-b-10">
                        <a href="index.php" class="txt2" id="signup">
                            or Login.
                        </a>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Valid Name is Required">
                        <input class="input100" id="Name" type="text" name="name">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Name</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" id="email" type="text" name="email">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Valid Name is Required">
                        <input class="input100" id="specialization" type="text" name="specialization">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Specialization</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" id="pwd" type="password" name="pass">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>
                    <div class="custom-file validate-input" data-validate="Choose Profile Pic">
                        <input type="file" name="profilePic" id="profilePic" class="input100 custom-file-input" accept="image/*" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose Profile Pic</label>
                    </div>
                    <div class="container-login100-form-btn" style="margin-top:8px">
                        <input type="submit" value="Sign Up" class="login100-form-btn" id="login_" name="reg">
                    </div>

                </form>

                <!--LOGIN IMG-->
                <div class="login100-more" style="background-image: url('images/bg-01.jpg');">
                </div>
                <!--Registration Form-->

            </div>
        </div>
    </div>

    <?php
    include "Database//Database.php";
    if (isset($_POST["reg"])) {
        $img = $_FILES['profilePic']["name"];
        $temp_name  = $_FILES['profilePic']['tmp_name'];
        $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["pass"];
        $specialization = $_POST["specialization"];
        $uploadOk = 1;
        $db = new database();
        $db->startDBConnection();
        $db = $db->getConnection();
        $str = "CREATE user '$email'@localhost identified by '$password';\n";
        echo
            $rs = mysqli_query($db, $str);
        if ($rs) {
            mkdir("users//$email");
            mkdir("users//$email//Publications");
            $target_file = "users//$email//";
            $target_file = $target_file . $_POST["email"] . "." . $imageFileType;
            if (move_uploaded_file($temp_name, $target_file)) {

                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            $str = "GRANT all PRIVILEGES on flexq.* to '$email'@'localhost'";
            $rs = mysqli_query($db, $str);
            echo "alert('$str')";

            $str = "Insert into flexq.teachers Values ('$email','$name','$specialization','$target_file');";
            echo $str;
            $rs = mysqli_query($db, $str);
            if ($rs) {
                ?>
                <script>
                    $("#notifyType").text("Account Created Successfully");
                    $(".notify").addClass("aactive");
                    $("#notifyType").addClass("success");
                    $(".notify").addClass("notisuccess");
                    $(".notify").removeClass("notifailure");
                    $("#requestForm").hide();
                    setTimeout(function() {
                        $(".notify").removeClass("aactive");
                        $("#notifyType").removeClass("success");
                        $(".notify").removeClass("notisuccess");
                        window.location.href = "index.php";
                    }, 1500);
                </script>
            <?php

        }
    } else {
        ?>
            <script>
                 $("#notifyType").text("User Already Exiss");
                $(".notify").addClass("aactive");
                $("#notifyType").addClass("failure");
                $(".notify").addClass("notifailure");
                $(".notify").removeClass("notisuccess");
                 setTimeout(function() {
                     $(".notify").removeClass("aactive");
                     $("#notifyType").removeClass("failure");
                     $(".notify").removeClass("notifailure");
                     window.location.href = "reg.php";
                 }, 1500);
            </script>
        <?php
    }
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