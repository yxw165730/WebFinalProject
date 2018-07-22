function showData() {
        
    var click = 0;
    var v1 = document.getElementById("category").value;
    var v2 = document.getElementById("price").value;
    if (v1 == "" || v2 == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        //xmlhttp.open("GET","babynames.php?q="+v1,true);
        xmlhttp.open("GET","filter.php?q=" + v1 + "&p=" + v2, true);
        //xmlhttp.open("GET","babynames.php?v1="+v1 + "&v2=" +v2,true);
        //xmlhttp.open("GET","babynames.php?q="+v1+"p="+v2,true);
        xmlhttp.send();
        click = 1;
    }
    
    if(click == 1){
         document.getElementById("defaultMenu").style.display="none";
    }
    
    
}
