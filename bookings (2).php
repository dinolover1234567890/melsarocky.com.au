
<!doctype html>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bookings</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style>
	body {
		background-color: #2D2D2D /* the background colour for the webpage if soming is not coving it */
	}
	</style>
</head>

<body>
	<div id="container"> <!--website sizing and limits -->
	
		<div class="banner3"><!--top background image-->
		
<div class="navbar"> 
			<div class="text"><img src="images/LOGOSMALL.gif" width="300px" height="300" class="logo" alt="Green Train with writing around it saying melsa INC rockhampton"/> <!--logo in the top left corner-->
				<div class="text"></div>
				<h1>Model Engineer And <br> Live Steamers Association <br> Rockhampton INC</h1>
			</div> <!--text next to logo in top left corner-->
			<ul>
				<li><a href="index.html">Home</a></li> <!--Writing on the buttons in the top right corner-->
				<li><a href="Contacts.html">Contacts</a></li><!--Writing on the buttons in the top right corner-->
				<li><a href="History.html">History</a></li><!--Writing on the buttons in the top right corner-->
				<li><a href="bookings.html">Bookings</a></li><!--Writing on the buttins in the top right corner-->
			</ul>
		
			<div class="content2">
			<h1> Bookings </h1> <!--the title in the middle of the image at the top of the page-->
			<p> Make a privite booking </p> <!--small writing under the title in the middle of the 
<!--image at the top of the page-->
	</div>
	</div>
		</div>
<div id="content5">
<h1>Booking Info</h1>
  <p>At MELSA Rockhapton we offer Private bookings for birthday partys and private functions. 
  The standed running time for our privite bookings is 2 hours which is $170 please note that we do offer different running 
  time if your would like a different running time please contact Ian, our club pesident his contact can be found on the contacts page.
  Please note we do open the toilets and run the trains for the duration of the booking but we don't cater for the funcation and we can not guarantee 
  power or water for your funcation. If you would like to make a booking you can contact either Ian or fillout the 
  form below
	</p>
		</div>
		
		
	
	 <form  id="form2" action="Bookingeventsprocess.php" method="post"> <!--form that holds the code for the form-->
	<table align="center" width="500px"> <!--table that allows for posistioning-->
		<th colspan="4" align="center"><h1>Booking Form</h1></th>
		<tr>
			<td><p>First Name: </p></td>
			<td><input id="firstname" name="firstname" placeholder="Your First Name"></td>
		</tr>
		<tr>
			<td><p>Last Name: </p></td>
			<td><input id="lastname" name="lastname" placeholder="Your Last Name"></td>
		</tr>
		<tr>
			<td><p>Email: </p></td>
			<td><input type="email" name="email" id="email" placeholder="Your Email"></td>
		</tr>
		<tr>
			<td><p>Phone Number: </p></td>
			<td><input id="phone" name="phone" placeholder="Your Phone Number"></td>
		</tr>
		<tr>
			  <td><p>Booking Type: </p></td>
				<td><select id="bookingtype" name="bookingtype">
				<option value="birthday">Birthday Party</option>
				<option value="playgroup">Playgroup</option>
				<option value="private">Private Function</option></td>
				</select>
		</tr>
		<tr>
			<td><p>Booking Date: </p></td>
			<td><input type="date" name="date" id="date"></td>
		</tr>
		<tr>
			<td><p>Booking Time: </p></td>
			<td><input type="time" name="time" id="time"></td>
		</tr>
		<tr>
			<td><p>Number of Passengers: </p></td>
			<td><input type="number" name="passangers" id="passengers" placeholder="25"></td>
		</tr>
		 <tr>
		 	<td><button align="centre" type="submit" name="submit">Submit</button></td>
		 </tr>
	</table> <!--closing the table-->
</form> <!--the closing for the form-->
	

		<div id="calander">
		<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Australia%2FBrisbane&mode=AGENDA&src=bWVsc2Fyb2NreUBnbWFpbC5jb20&color=%230B8043" style="border:solid 1px #777" width="500" height="400" frameborder="0" scrolling="no"></iframe>
	</div>
	</div>
<script>
</script>
</body>
</html>