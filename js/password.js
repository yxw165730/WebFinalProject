window.onload = function() {
    var strength = {
        0: "Worst",
        1: "Bad",
        2: "Weak",
        3: "Good",
        4: "Strong"
    };
    var password = document.getElementById('password1');
    var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');
//    alert(text.innerHTML);
//    text.innerHTML = "Hello world!";
//            alert("hello1!");
    password.addEventListener('input', function() {
        var val = password.value;
//        alert("hello2!");
        var result = zxcvbn(val);
//        alert("hello3!");
//        Update the password strength meter
        meter.value = result.score;
//                alert("hello4!");
//        Update the text indicator
        if (val !== "") {
            text.innerHTML = "Strength: " + strength[result.score]; 
        } else {
            text.innerHTML = "";
        }
    });
}