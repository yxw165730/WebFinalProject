$(function(){
    $(".carid").mousedown(function(){
        var formData = {
			'carid' 				: $(this).text()
		};
//        console.log('carid:'+$(this).text());
        $.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'showcar.php', // the url where we want to POST
			data 		: formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true
		})
        // using the done promise callback
        .done(function(data) {
            if (data != "fail") {
                //code
                console.log(data);
                $("#upload_form").attr("carid", data.id);
                if (data.pic_path!=null) {
                    var n = (data.pic_path).indexOf("carpics");
                    var picpath = (data.pic_path).substring(n); 
                    $("#carpic_modal").attr("src",picpath);
                }
                else{
                    $("#carpic_modal").attr("src","");
                }
                
                $("#make_modal").val(data.make);
                $("#model_modal").val(data.model);
                $("#year_modal").val(data.year);
                $("#color_modal").val(data.color);
                $("#mileage_modal").val(data.mileage);
                $("#price_modal").val(data.price);
                $("#status_modal").val(data.status);
                //$("#update_time_modal").val(data.make);
                $("#description").text(data.comment);
                
            }
            else{
                alert("Sorry! Database has some issue, please check later");
            }
            //console.log(data); 
        })
        // using the fail promise callback
        .fail(function(data) {
            console.log(data);
        });
        
        $("#modal-content-show").show();
        $("#modal-content-edit").hide();
    });
    
    $("#modal-edit-btn").click(function(){
        $("#fileToUpload").val("");
        $("#make_edit").val($("#make_modal").val());
        $("#model_edit").val($("#model_modal").val());
        $("#year_edit").val($("#year_modal").val());
        $("#color_edit").val($("#color_modal").val());
        $("#mileage_edit").val($("#mileage_modal").val());
        $("#price_edit").val($("#price_modal").val());
        $("#status_edit").val($("#status_modal").val());
        $("#description_edit").text($("#description").text());
        $("#upload_form").attr( "usage", "edit" );
        $("#modal-content-show").hide();
        $("#modal-content-edit").show();
    });
    
    $("#addvehicle").click(function(event){
        event.preventDefault();
        $("#make_edit").val("");
        $("#model_edit").val("");
        $("#year_edit").val("");
        $("#color_edit").val("");
        $("#mileage_edit").val("");
        $("#price_edit").val("");
        $("#status_edit").val("");
        $("#description_edit").text("");
        $("#upload_form").attr( "usage", "add" );
        $("#modal-content-show").hide();
        $("#modal-content-edit").show();
    });
    // process the form
	/*$('form#year').submit(function(event) {
        
		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var formData = {
			'year' 				: $( "#myselect option:selected" ).text(),
            'lallaa'            : 'asdasd'
		};
		//alert(formData['lallaa']);
        //console.log(formData);
		// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'babyname.php', // the url where we want to POST
			data 		: formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true
		})
			.done(function(data) {
            console.log(data);
				if ( ! data.success) {
					alert('oops! something happened');
				} else {
					alert("success!");
				}
			})
			.fail(function(data) {
				alert('oops! something happened');
			});

		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});*/
//    $(document).on('submit','#upload_form',function(e){
//        e.preventDefault();
//
//        $form = $(this);
//
//        uploadImage($form);
//
//    });
    $( "#upload_form" ).submit(function( event ) {
        //console.log("ready to submit2");
//      alert( "Handler for .submit() called." );
        event.preventDefault();
        $form = $(this);
        uploadImage($form);
    });
                              
    $( "#upload_submit" ).click(function() {
        //console.log("ready to submit");
      $( "#upload_form" ).submit();
    });
    
    function uploadImage($form){
        //var formdata = new FormData();//
//        var formData = new FormData($form[0]);
//        var formData = new FormData();
////        formData.append('userpic', $("fileToUpload").files[0], 'chris.jpg');
//        formData.append('image', $('input[id=fileToUpload]')[0].files[0]); 
        var formData = new FormData($form[0]);
        formData.append('carid', $form.attr("carid"));
        formData.append('usage', $form.attr("usage"));
        formData.append('make', $("#make_edit").val());
        formData.append('model', $("#model_edit").val());
        formData.append('year', $("#year_edit").val());
        formData.append('color', $("#color_edit").val());
        formData.append('mileage', $("#mileage_edit").val());
        formData.append('price', $("#price_edit").val());
        formData.append('status', $("#status_edit option:selected").text());
        formData.append('description', $("#description_edit").val());
for (var [key, value] of formData.entries()) { 
          console.log(key, value);
        }
        
//        var formData = new FormData();
//
//formData.append("username", "Groucho");
//formData.append("accountnum", 123456); // number 123456 is immediately converted to a string "123456"

var request = new XMLHttpRequest();
request.upload.addEventListener('progress',function(e){
    var percent = Math.round(e.loaded/e.total * 100);
    console.log("percentage:"+percent);
    $("#progress").width((percent)+ "%");
    document.getElementById("myprogressp").innerHTML = percent +"%";
    
//    $("#progress").document.getElementById("p").innerHTML(percent);
});
//progress completed load next event
request.addEventListener('load',function(e){
    alert("finished!");
    //$form.find('.progress-bar').addClass('progress-bar-success').html('upload completed....');
});
request.open("POST", "hanleupload.php");
request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){
        
        var return_data = request.responseText;
        console.log("return_data!"+return_data);
        returnMsg = JSON.parse(return_data);
        if(returnMsg.success == undefined){
            returnMsg = JSON.parse(eval(return_data));
        }
        
        if(returnMsg.success==false){
            var error = 'error';
            if (returnMsg.errors.empty) {
                error = returnMsg.errors.empty;
            }
            else if (returnMsg.errors.upload) {
                error = returnMsg.errors.upload;
            }
            else if (returnMsg.errors.database) {
                error = returnMsg.errors.database;
            }
            alert("error!"+error);
//                    $('#upper-group').addClass('has-error'); // add the error class to show red input
//				    $('#upper-group').append('<div class="help-block">' + error + '</div>');
        }
        else{
            console.log("success!");
	        window.location.href="http://www.beemaxauto.com/auto_admin/automange.php";
        }      
    }
}
request.send(formData);
        
//        //formdata.append('picid', $form.attr("picid"));
//        var request = new XMLHttpRequest();
//        //process event...
//        request.upload.addEventListener('process',function(e){
//            var percent = Math.round(e.loaded/e.total * 100);
//            console.log("percentage:"+percent);
//        });
//        //progress completed load next event
//        request.addEventListener('load',function(e){
//            //$form.find('.progress-bar').addClass('progress-bar-success').html('upload completed....');
//        });
//        request.open('post','hanleupload.php');
//        request.setRequestHeader("Content-type","multipart/form-data");
//        //request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//        request.onreadystatechange = function(){
//            if(request.readyState == 4 && request.status == 200){
//                
//                var return_data = request.responseText;
//                alert("success!"+return_data);
//                console.log("success!"+return_data);
//                returnMsg = JSON.parse(return_data);
//                if(returnMsg.success == undefined){
//                    returnMsg = JSON.parse(eval(return_data));
//                }
//                
//                if(returnMsg.success==false){
//                    var error = 'error';
//                    if (returnMsg.errors.empty) {
//                        error = returnMsg.errors.empty;
//                    }
//                    else if (returnMsg.errors.upload) {
//                        error = returnMsg.errors.upload;
//                    }
//                    else if (returnMsg.errors.database) {
//                        error = returnMsg.errors.database;
//                    }
////                    $('#upper-group').addClass('has-error'); // add the error class to show red input
////				    $('#upper-group').append('<div class="help-block">' + error + '</div>');
//                }
//                else{
//                    console.log("success!");
////                    $('#upper-group').append('<div class="alert alert-success">' + returnMsg.msg + '</div>');
////				    window.location.href="http://120.26.71.129/VRSite/projectlist1.php";
//                }
//            }
//        }
//        for (var [key, value] of formData.entries()) { 
//          console.log(key, value);
//        }
//        request.send(formData);
    }
    
    function setDeleteAction() {
        if(confirm("Are you sure want to delete these cars?")) {
            document.frmUser.action = "delete_car.php";
            document.frmUser.submit();
        }
    }
  
});