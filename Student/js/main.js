
(function ($) {
    "use strict";

    $.ajax({
        url: 'getProfile.php',
        type: 'post',
        success: function(response) {
            response=response.trim();
            if(response=="")
            $("#img1").attr("src", "images//usr.png");        
            else
            $("#img1").attr("src", response);        
        }
    });
    function loadImg(){
 
        
    }
    $("#loading_").hide();
    /*==================================================================
    [click functions]*/
    $("#sup").click(function(){
        $("#sup").addClass("active");
        $("#subReq").removeClass("active");
    });
    $("#subReq").click(function(){
        $("#sup").removeClass("active");
        $("#subReq").addClass("active");
    });
    /*[Login Btn] */
    $("#login_").click(function() {
        $("#loading_").delay(15000).show();
        var input = $('.validate-input .input100');
        var check=true
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
        if (check) {
            var username = $("#email").val().trim();
            var password = $("#pwd").val().trim();

            loginCheck(username,password);
        }
        else{
            $("#loading_").hide();
        }
        
    });
    

    /*[Signup Btn] */
    /*[Login Btn] */
    $('#login').click(function() {
        $("#regForm").hide();
        $("#loginForm").show();
    });
    $('#logoutBtn').click(function(){
        $.ajax({
            url: 'logoutPhp.php',
            type: 'post',
            success: function(response) {
                window.location.href = "index.php";
            }
        });
    });
    /*Request Btns*/
    var teacher_;
    var name_;
    var details_;
    $(".sndRequest").click(function () {
        $("#requestForm").fadeIn(100);
        var parent=$(this).closest('.tr');
        teacher_=$(parent).children(".email").text();
        
    });
    $("#btncancel").click(function () {
        $("#requestForm").fadeOut(100);
    });

    $('input[type=file]').change(function(e){
        var fileName = $(this).val().replace('C:\\fakepath\\', " ")
            //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
      });
    $('#btnSendRequest1').click(function() {
       var input = $('.validate-input .input2');
       var check=true
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
       if (check) {
            var projName = $("#projName").val();
            var projDetails = $("#projDetails").val();
            sendRequest(projName,projDetails,teacher_);
        }
    });

    $("#btnSendRequest2").click(function() {
         var input = $('.validate-input .input2');
         var check=true
         for(var i=0; i<input.length; i++) {
             if(validate(input[i]) == false){
                 showValidate(input[i]);
                 check=false;
              }
          }
         if (check) {
 
             var projName = $("#projName").val();
             var projDetails = $("#projDetails").val();
             changeRequest(projName,projDetails,teacher_);
         }
     });

    $(".dlt").click(function () {        
         var parent=$(this).closest('.tr');
         teacher_=$(parent).children(".email").text();
    });
    $(".edit").click(function () {  
        $("#requestForm").fadeIn(100);      
        var parent=$(this).closest('.tr');
        teacher_=$(parent).children(".email").text();
        name_=$(parent).children(".name").text();
        details_=$(parent).children(".details").text();
        $("#projName").val(name_);
        $("#projDetails").val(details_);
   });
    $(".sendPaper").click(function () {
        $("#requestForm").fadeIn(100);
        var parent = $(this).closest('.tr');
        teacher_ = $(parent).children(".email").text();
        name_ = $(parent).children(".name").text();
        details_ = $(parent).children(".details").text();
        $("#projName").val(name_);
        $("#supName").val(teacher_);
        
    });
    $("#ConfirmModal").click(function(){
        deleteRequest(teacher_);   
        
    });  
    /*===================================================================
    [Check credintials are correct or not]*/
        function loginCheck(username, password) {
            var msg = "";
            $.ajax({
                url: 'checkLogin.php',
                type: 'post',
                data: {
                    email: username,
                    pass: password
                },
                success: function(response) {

                    response = $.trim(response);
                    if (response == "1") {
                        $(".loader").delay(1000).fadeOut(500, function() {
                            window.location.href = "stdHomepage.php";
                        });
                    } else {
                        msg = "Invalid Username or password!";
                        $("#email").val("");
                        $("#pwd").val("");
                        $("#errormsg").text(msg);
                        $("#loading_").hide();
                    }
                }
            });
        }
    /*===================================================================
    [Send Request]*/
    function sendRequest(projName,projDetails,teacher){
        var msg = "";
        $.ajax({
            url: 'sendRequest.php',
            type: 'post',
            data: {
                name:projName,
                details:projDetails,
                teacher:teacher
            },
            success: function(response) {

                response = $.trim(response);
                if (response == "1") {
                    successNoti("Done!! Request Sent");
                } else if(response=="0")  {
                    failiureNoti("Sorry You have already Submitted the request");
                }
                else {
                    failiureNoti("Sorry You have already Submitted the request");
                }
            }
        });
    }
    /*===================================================================
    [Change Request]*/
    function changeRequest(projName,projDetails,teacher){
        var msg = "";
        $.ajax({
            url: 'changeRequest.php',
            type: 'post',
            data: {
                name:projName,
                details:projDetails,
                teacher:teacher
            },
            success: function(response) {

                response = $.trim(response);
                if (response == "1") {
                    successNoti("Done!! Request Updated");
                } else if(response=="0")  {
                    failiureNoti("Sorry Cannot Updated");
                }
                else {
                    failiureNoti("Sorry Cannot Update");
                    alert(response);
                }
            }
        });
    }
    /*===================================================================
    [delete Request]*/
    function deleteRequest(teacher){
        var msg = "";
        $.ajax({
            url: 'deleteRequest.php',
            type: 'post',
            data: {
                teacher:teacher
            },
            success: function(response) {

                response = $.trim(response);
                if (response == "1") {
                    successNoti("Done!! Request Deleted");
                    location.reload(true);
                } else if(response=="0")  {
                    failiureNoti("Sorry Cannot Delete the Request");
                }
                else {
                    failiureNoti("Sorry Cannot Delete the Request");
                }
            }
        });
    }
    function successNoti(Str){
        $("#notifyType").text(Str);
        $(".notify").addClass("aactive");
        $("#notifyType").addClass("success");
        $(".notify").addClass("notisuccess");
        $(".notify").removeClass("notifailure");
        $("#requestForm").hide();
         setTimeout(function(){
         $(".notify").removeClass("aactive");
         $("#notifyType").removeClass("success");
         $(".notify").removeClass("notisuccess");
         },1500);
    }
    function failiureNoti(Str){
        $("#notifyType").text(Str);
        $(".notify").addClass("aactive");
        $("#notifyType").addClass("failure");
        $(".notify").addClass("notifailure"); 
        $(".notify").removeClass("notisuccess");
        setTimeout(function(){
        $(".notify").removeClass("aactive");
        $("#notifyType").removeClass("failure");
        $(".notify").removeClass("notifailure");
        },1500);
    }
/*===================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
            
        })    
    })
    $('.input2').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
            
        })    
    })
  
    /*==================================================================
    [ Validate ]*/

    

    function validate(){
        
        var check = true;
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    };


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           $("#errormsg").text("");
           hideValidate(this);
        });
    });

    $("#regForm").on('submit',function(e){
        if(checkStdValid()==false)
        e.preventDefault();
    });
    function checkStdValid(){
        var input = $('.validate-input .input100');
        var check=true
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
        return check;
        
    };
    function validateEmail(usr) {
        return usr.match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/)
    };

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email'|| $(input).attr('name') == 'RollNumber') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val() == ''){
                return false;
            }
        }
    }
    

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    

})(jQuery);