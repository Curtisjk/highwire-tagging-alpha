function validateEmail($email) 
{
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if( !emailReg.test( $email ) ) {
		return false;
	} else {
		return true;
	}
}

/*function emailSubscribe(form)
{
	//grab the fields
	var email = document.getElementById('email').value;
	var prefs = "";
    $('#prefs:checked').each(function() {
    	prefs = prefs + ($(this).val()) + ',';
    });

	if(prefs == ""){
		throwError(1000);
	} else {
		//submit the data
		$.ajax({
			type: "POST",
			url: "ajax/subscribe.mail.php",
			data: {email: email, prefs: prefs}
		}).done(function(msg) {
			console.log(msg);
			var data = jQuery.parseJSON(msg);

			if(data.error == true){
				throwError(data.code);
			} else {
				//subscribed
				window.location.replace("thanks.php");
			}
		});
	}

}*/

function emailSubscribe(form)
{
	//grab the fields
	var email = document.getElementById('email').value;
	var result = 0;
	var updates = 0;

    $('#prefs:checked').each(function() {
    	prefs = prefs + ($(this).val()) + ',';
    });

    if($('#prefs_1').is(':checked')){
    	results = 1;
   	}

   	if($('#prefs_2').is(':checked')){
    	updates = 1;
   	}

   	if (!validateEmail(email)){
		throwError(502);
	} else if(result+updates == 0){
		throwError(1000);
	} else {
		//submit the data
		$.ajax({
			type: "POST",
			url: "ajax/subscribe.db.mail.php",
			data: {email: email, result: results, updates: updates, uid: userID}
		}).done(function(msg) {
			console.log(msg);
			var data = jQuery.parseJSON(msg);

			if(data != "Success"){
				throwError(-1);
			} else {
				//subscribed
				window.location.replace("thanks.php");
			}
		});
	}
}

function throwError(error){
	//set the text
	$('#errorBody').empty();
	$('#errorHeader').empty();
	$('#errorHeader').text("Error");

	if(error == 502){
		$('#errorBody').text("You have entered an invalid email address. Please correct the form and re-submit.");
	} else if(error == 1000){
		$('#errorBody').text("You have not chosen any opt-in options. Please correct the form and re-submit.");
	} else {
		$('#errorBody').text("Error: "+error+" - please email c.kennington@lancaster.ac.uk with details of this error");
	}
	
	//set the modal
	$('#errorModal').modal();
}