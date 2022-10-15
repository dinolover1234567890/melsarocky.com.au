<?php

if (isset($_POST['submit'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$bookingtype = $_POST['bookingtype'];
		$date = $_POST['date'];
		$time = $_POST['time'];		
		$passangers = $_POST['passangers'];
	
		$mailTo = 'ben@akrigg.com.au,webadmin@melsarocky.com.au';
		$headers = "From: ". $name;
		$subject = "MELSA Rockhampton Booking/Event Request";
	
	
		mail($mailTo, $subject,
			 
"
MELSA ROCKHAMPTON EVENT BOOKING REQUEST:


Contact Person First Name:    $firstname 
Contact Person Last Name: 	  $lastname
Contact Email:                $email
Phone:                        $phone

EVENT DETAILS
Booking / Event Date:         $date
Booking / Event Time:         $time
Time Required:                
Booking / Event Type:         $bookingtype
Number Of Passangers:         $passangers


"
);
		
	
	header("location: submit.html");
		
}

?>