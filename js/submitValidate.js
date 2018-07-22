function validate() {
    if($("#firstname_span").text() != "OK" || $("#lastname_span").text() != "OK" || $("#email_span").text() != "OK" || $("#password1_span").text() != "OK") { 
        alert("Please enter the correct information.");
    } else if ($("#password2_span").text() != "OK") {
        alert("The password doesn't match.");
    } else {
        var xmlhttp = new XMLHttpRequest();
        var url = "submitValidate.php";
        var email = $("#email").val();
        var params = "email=".concat(email);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(xmlhttp.responseText == ""){
                    registerNewUser();
                }else {
                    alert("Sorry, this email has been used!");
                }
            }
        };
        xmlhttp.send(params);
    }
}
function registerNewUser(){
    //    alert("hello new user!");
    var xmlregister = new XMLHttpRequest();
    var urlregister = "submitRegister.php";
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var username = firstname.concat(" ").concat(lastname);
    var email = $("#email").val();
    var password = $("#password1").val();
    var params = "username=".concat(username).concat("&email=").concat(email).concat("&password=").concat(password);
    //    alert(params);
    xmlregister.open("POST", urlregister, true);
    xmlregister.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlregister.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(xmlregister.responseText == 1){
                alert("Register succeed! Click OK to login!");
                window.location = 'login.php';
            }else {
                alert("Sorry, failed! Click OK to redirect to login page!");
                window.location = 'login.php';
            }
        }
    };
    xmlregister.send(params);
}