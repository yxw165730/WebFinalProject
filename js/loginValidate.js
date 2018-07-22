function loginValidate() {
    if($("#login_email").val().length == 0) { 
        alert("Please enter your email.");
        return false;
    } else if ($("#login_password").val().length == 0) {
        alert("Please enter your password.");
        return false;
    } else {
        return true;
    }
}