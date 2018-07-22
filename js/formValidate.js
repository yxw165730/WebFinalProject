$(document).ready(function() {

    $("#firstname").focus(function(){
        $("#firstname_span").show().text("Please enter your first name.").removeClass("error ok").addClass("info");
        $(this).css("border","2px solid blue");
    });

    $("#firstname").blur(function(){
        var firstname = $("#firstname").val();
        var firstname_patt1 = /[a-zA-Z]/;
        var firstname_patt2 = /[^a-zA-Z]/;
        var firstname_result1 = firstname_patt1.test(firstname);
        var firstname_result2 = firstname_patt2.test(firstname);
        if(firstname_result1 == true && firstname_result2 == false){
            $("#firstname_span").show().text("OK").removeClass("info error").addClass("ok");
            $(this).css("border","2px solid green");
        } else if(firstname == ""){
            $("#firstname_span").show().text("The first name cannot be empty.").removeClass("info ok").addClass("error");
            $(this).css("border","2px solid red");
        } else {
            $("#firstname_span").show().text("Please enter a valid first name").removeClass("info ok").addClass("error");
            $(this).css("border","2px solid red");
        }
    });

    $("#lastname").focus(function(){
        $("#lastname_span").show().text("Please enter your last name.").removeClass("error ok").addClass("info");
        $(this).css("border","2px solid blue");
    });
    $("#lastname").blur(function(){
        var lastname = $("#lastname").val();
        var lastname_patt1 = /[a-zA-Z]/;
        var lastname_patt2 = /[^a-zA-Z]/;
        var lastname_result1 = lastname_patt1.test(lastname);
        var lastname_result2 = lastname_patt2.test(lastname);
        if(lastname_result1 == true && lastname_result2 == false){
            $("#lastname_span").show().text("OK").removeClass("info error").addClass("ok");
            $(this).css("border","2px solid green");
        } else if(lastname == ""){
            $("#lastname_span").show().text("The last name cannot be empty.").removeClass("info ok").addClass("error");
            $(this).css("border","2px solid red");
        } else {
            $("#lastname_span").show().text("Please enter a valid last name").removeClass("info ok").addClass("error");
            $(this).css("border","2px solid red");
        }
    });

    $("#email").focus(function(){
        $("#email_span").show().text("Please enter a valid email address.").removeClass("error ok").addClass("info");
        $(this).css("border","2px solid blue");
    });
    $("#email").blur(function(){
        var email = $("#email").val();
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        if(email == ""){
            $("#email_span").show().text("Please enter your email address.").removeClass("info ok").addClass("error");
            $(this).css("border","2px solid red");
        } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
            $("#email_span").show().text("Please enter a valid email address.").removeClass("info ok").addClass("error");
            $(this).css("border","2px solid red");
        } else {
            $("#email_span").show().text("OK").removeClass("info error").addClass("ok");
            $(this).css("border","2px solid green");
        }
    });

    $("#password1").focus(function(){
        $("#password1_span").show().text("The password field should be at least 8 characters long.").removeClass("error ok").addClass("info");
        $(this).css("border","2px solid blue");
    });
    $("#password1").blur(function(){
        password1 = $("#password1").val();
        if(password1.length >= 8){
            $("#password1_span").show().text("OK").removeClass("info error").addClass("ok");
            $(this).css("border","2px solid green");
        } else {
            $("#password1_span").show().text("Please enter a valid password").removeClass("info ok").addClass("error");
            $(this).css("border","2px solid red");
        }
    });

    $("#password2").focus(function(){
        $("#password2_span").show().text("Please re-enter your password").removeClass("error ok").addClass("info");
        $(this).css("border","2px solid blue");
    });
    $("#password2").blur(function(){
        password2 = $("#password2").val();
        if(password2 == ""){
            $("#password2_span").show().text("Password cannot be blank.").removeClass("info ok").addClass("error");
            $(this).css("border","2px solid red");
        } else if(password1 == password2){
            $("#password2_span").show().text("OK").removeClass("info error").addClass("ok");
            $(this).css("border","2px solid green");
        } else {
            $("#password2_span").show().text("Please enter the same password.").removeClass("info ok").addClass("error");
            $(this).css("border","2px solid red");
        }
    });

});