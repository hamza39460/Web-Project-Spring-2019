<!DOCTYPE html>
<html>

<head>
  <title>Welcome</title>
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
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
</head>
<script>
</script>
<body>
<div class="notify"><span id="notifyType" class=""></span></div>
<div id="requestForm" class="bg-request" style="display:none">
        <div class="container-request">
            <div class="wrap-request">
                <form class="request-form">
                    <span class="request-form-title">
                        Request Form
                    </span>
                    <div class="wrap-input2 validate-input" data-validate="Name is required">
                        <input tabindex="1" class="input2" id="projName" id="inputForm" type="text" name="name">
                        <span class="focus-input2" data-placeholder="Project Name"></span>
                    </div>
                    <div class="wrap-input2 validate-input" data-validate="Details are required">
                        <textarea tabindex="2" id="projDetails" class="input2" name="Details"></textarea>
                        <span class="focus-input2" data-placeholder="Details"></span>
                    </div>
                    <table class="container-login100-form-btn container-request-form-btn">
                        <tbody class="container-login100-form-btn container-request-form-btn">
                            <tr class="container-login100-form-btn container-request-form-btn">
                            <td class="container-login100-form-btn container-request-form-btn">
                                <div class="login100-form-btn">
                                        <!-- <div class="request-form-bgbtn"></div> -->
                                        <input tabindex="5"  type="button" value="Send Your Message" id="btnSendRequest1" class="login100-form-btn">
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
   ?>
    <table class="table table-bordered table-striped table-hover" class="table1">
        <thead>
            <th>Email</th>
            <th>Name</th>
            <th>Rating <span class="lnr lnr-star"></span> <span class="lnr lnr-star"></span> <span class="lnr lnr-star"></span> <span class="lnr lnr-star"></span> <span class="lnr lnr-star"></span></th>
            <th>Specialization</th>
            <th>Send Request</th>
        </thead>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tbody>
                    <tr class="tr">
                        <td class="email" ><?php echo $row["ID"] ?></td>
                        <td><?php echo $row["Name"] ?></td>
                        <td><?php echo $row["Rating"] ?></td>
                        <td><?php echo $row["Specialization"] ?></td>
                        <td><span class="sndRequest"> <i class="lnr lnr-envelope"></i></span></td>
                    </tr>
                </tbody>
            <?php
        }
    } else {
        echo (" <span class=\"login100-form-title p-b-43\">Sorry No Supervisor found</span>");
    }
    ?>
     <script src="js/main.js"></script>
</body>

</html>