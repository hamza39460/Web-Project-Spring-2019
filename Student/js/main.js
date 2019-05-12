
(function ($) {
    "use strict";
    $("#regForm").hide();
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
    $('#signup').click(function() {
        $("#loginForm").hide();
        $("#regForm").show();
    });
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
                alert(response);
            }
        });
    });
    /*Request Btns*/
    var teacher_;
    var name_;
    var details_;
    $(".sndRequest").click(function () {
        $("#requestForm").fadeIn(500);
        var parent=$(this).closest('.tr');
        teacher_=$(parent).children(".email").text();
        
    });
    $("#btncancel").click(function () {
        $("#requestForm").fadeOut(500);
    });

    $('input[type=file]').change(function(e){
        $(this).next().html($(this).val());
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
        $("#requestForm").fadeIn(500);      
        var parent=$(this).closest('.tr');
        teacher_=$(parent).children(".email").text();
        name_=$(parent).children(".name").text();
        details_=$(parent).children(".details").text();
        $("#projName").val(name_);
        $("#projDetails").val(details_);
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
                    location.reload(true);
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
        $(".notify").addClass("active");
        $("#notifyType").addClass("success");
        $(".notify").addClass("notisuccess");
        $(".notify").removeClass("notifailure");
        $("#requestForm").hide();
         setTimeout(function(){
         $(".notify").removeClass("active");
         $("#notifyType").removeClass("success");
         $(".notify").removeClass("notisuccess");
         },1500);
    }
    function failiureNoti(Str){
        $("#notifyType").text(Str);
        $(".notify").addClass("active");
        $("#notifyType").addClass("failure");
        $(".notify").addClass("notifailure"); 
        $(".notify").removeClass("notisuccess");
        setTimeout(function(){
        $(".notify").removeClass("active");
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

    function validateEmail(usr) {
        return usr.match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/)
    };

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
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