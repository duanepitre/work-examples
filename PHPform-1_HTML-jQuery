<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Duane Pitre - PHP Form (HTML and jQuery)</title>
		<meta name="description" content="In addition to my professional experience, I bring with me a strong work ethic as well as a desire to solve problems and learn new skills. I also possess excellent interpersonal skills, strong organizational skills and enjoy collaborating with others. I pride myself on producing organized code, in order to make programs run as efficiently as possible."> 
		<meta name="keywords" content="Duane Pitre, Pitre, motivated, self-directed, teamwork, problem solving, open mind, positive, outgoing, friendly">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="http://www.freeman.tulane.edu/lib-tech/media/css/ms-req-form.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"> </script>
	</head>
	<body>  
		<div id="main">
			<h1>Media Services Request Form</h1>
			<p><em>NOTE: Media Requests cannot be processed until a room reservation has been made. Please contact your program’s office to reserve a room.</em></p>
			<p><em>* = required fields</em></p>
			<form name="mediaservicesrequestform" method="post" action="send_form_email.php" id="request"> 
				<input type="text" required name="fullname" placeholder="*Name"></input>
				<input type="email" required name="email" placeholder="*Email"></input>
				<input type="tel" required name="phone" placeholder="*Phone #"></input>
				<input type="text" name="id" placeholder="ID #"></input>
				<fieldset>
					<legend>Requested by:</legend>
					<input type="radio" name="by" value="Student">*Student</input>
					<input type="radio" name="by" value="Faculty">Faculty</input>
					<input type="radio" name="by" value="Staff">Staff</input>
					<p><em>*STUDENT REQUESTS FOR CLASS TAPINGS MUST BE APPROVED BY PROFESSOR.</em></p>
				</fieldset>
				 <input type="text" name="signature" placeholder="Approval Signature"></input>
				 <input type="text" name="signee" placeholder="Print Name of Signee"></input>
				<fieldset>
					<legend>Is this request for a Class or an Event?</legend>
					<input type="radio" name="type" value="Class">Class</input>
					<input type="radio" name="type" value="Event">Event*</input>
					<p><em>*EVENTS MAY REQUIRE CONSULTATION WITH MEDIA SERVICES STAFF MEMBER PRIOR TO APPROVAL.</em></p>
				</fieldset>
				<input type="text" required name="eventname" placeholder="*Event Name or Course ID"></input>
				<input type="text" required name="room" placeholder="*Room #"></input>
				<div id="datetime">
					<p>*Starting Date: <input type="date" required name="startdate"></input>
					*Ending Date: <input type="date" required name="enddate"></input></p>
					<p>*Starting Time: <input type="time" required name="starttime"></input>
					*Ending Time: <input type="time" required name="endtime"></input></p>
				</div>
				<fieldset id="recurring">
					<legend>Is Event Recurring?</legend>
					<input type="radio" class="recurringyes" name="recurring" value="Yes">Yes</input>
					<blockquote class="allsemester">
						ALL Semester?
						<input type="radio" name="all" value="Yes">Yes</input>
						<input type="radio" name="all" value="No">No</input>
					</blockquote>
					<input type="radio" class="recurringno" name="recurring" value="No">No</input>
				</fieldset>
				<fieldset>
					<legend>Day(s) of the Week</legend>
					<input type="checkbox" name="day[]" value="Monday">M</input>
					<input type="checkbox" name="day[]" value="Tuesday">Tu</input>
					<input type="checkbox" name="day[]" value="Wednesday">W</input>
					<input type="checkbox" name="day[]" value="Thursday">Th</input>
					<input type="checkbox" name="day[]" value="Friday">F</input>
					<input type="checkbox" name="day[]" value="Saturday">Sa</input>
					<input type="checkbox" name="day[]" value="Sunday">Su</input>
				</fieldset>
				<fieldset id="standard_equip">
					<legend>Standard Room Equipment</legend>
					<input type="checkbox" name="standard_equip[]" value="Computer Projector">Computer Projection and Navigator and DVD Playback</input><br />
					<input type="checkbox" name="standard_equip[]" value="Document Camera">Document Camera</input><br />
					<input type="checkbox" name="standard_equip[]" value="HDMI Laptop Cable">HDMI Laptop Cable*</input><br />
					<input type="checkbox" name="standard_equip[]" value="1 Wireless Lapel Microphone">1 Wireless Lapel Microphone</input><br />
					<input type="checkbox" name="standard_equip[]" value="VGA Laptop Cable">VGA Laptop Cable*</input>
					<p><em>*Only HDMI and VGA cables are available.<br />Apple users must bring their own adapters.</em></p>
				</fieldset>
				<fieldset id="special_equip">
					<legend>Special Equipment</legend>
					<p class="start">Some items may require additional setup time</p>
					<input type="checkbox" name="special_equip" value="Portable Bloomberg Terminal">Portable Bloomberg Terminal</input><br />
					<input type="checkbox" name="special_equip[]" value="Portable Projector">Portable Projector</input><br />
					<input type="checkbox" name="special_equip[]" value="Digital Still Camera">Digital Still Camera</input><br />
					<input type="checkbox" name="special_equip[]" value="Lectern">Lectern</input><br />
					<input type="checkbox" name="special_equip[]" value="Turning Point Kit">Turning Point Kit</input><br />
					<input type="checkbox" name="special_equip[]" value="Easel">Easel</input><br />
					<input type="checkbox" name="special_equip[]" value="Laptop Computer">Laptop Computer*</input><br />
					<input type="checkbox" name="special_equip[]" value="PD-150 Video Camera">PD-150 Video Camera</input><br />
					<input type="checkbox" name="special_equip[]" value="Conference Phone">Conference Phone</input><br />
					<input type="checkbox" name="special_equip[]" value="Assistance Needed">Assistance Needed</input><br />
					<input type="checkbox" name="special_equip[]" value="Flip Chart">Flip Chart</input><br />
					<input type="checkbox" name="special_equip[]" value="Laptop Navigator">Laptop Navigator</input><br />
					<input type="text" name="special_equip_lapelmics" placeholder="Extra Lapel Mics (list how many you need)"></input>
					<input type="text" name="special_equip_handmics" placeholder="Extra Hand Mics (list how many you need)"></input>
					<input type="text" name="special_equip_other" placeholder="Other"></input>			
					<p><em>*Only Staff and Faculty may request Laptop Computers</em></p>
				</fieldset>
				<p style="width: 80%; font-style: italic; line-height: 18px"><strong>If you can’t find the equipment or a service you’re interested in using, please speak with a Media Services staff member in our office, room 261, or call (504) 865-5670 or x55670.</strong></p>
				<fieldset id="recording">
					<legend>Recording Requests</legend>
					<p class="start"><strong>NOTE:</strong> Recordings may require a meeting with Media Services staff PRIOR to approval.  All non-Tulane affiliates must sign a release consenting to recording prior to event start time.  For videoconferencing needs, please see a Media Services Staff Member.  We are currently unable to guarantee a turnaround time for recording project completion.</p>
					<input type="radio" class="classrec" name="recording" value="Class Recording">Class Recording</input><br />
					<blockquote class="classrecformat">
					<strong>Format:</strong><br />
					<input type="checkbox" name="format[]" value="DVD">DVD</input>
					<input type="text" name="numdvd" placeholder="Total #"></input><br />
					<input type="checkbox" name="format[]" value="Online to Blackboard">Online to Blackboard (Professor must speak with Bill Hydrick)</input><br />
					<input type="checkbox" name="format[]" value="MediaSite">MediaSite (only avy available in certain rooms in GW2)</input></p></blockquote>
					<p>
					<input type="radio" class="nonclassrec" name="recording" value="Non-Class Recording">Non-Class Recording</input>
					<blockquote class="nonclassrecdescrip">
					<strong>Description:</strong> <input type="text" name="recdescription"></input>
					</blockquote>
					</p>
				</fieldset>
				<input type="submit" value="Submit" />
				<input type="reset" value="Reset" />
			</form>
		</div>	
	</body>
</html>	

<!---------- jQuery - List Conditionals ----------->
<script>
	$(document).ready(function() {
		// Recording Format
		$('.classrecformat').hide();
		$('.nonclassrecdescrip').hide();
		// Event Recurring
		$('.allsemester').hide();
		// Recording Format
		$('#recording .classrec').click(function() {
			$('.classrecformat').show();
		});
		$('#recording .classrec').click(function() {
			$('.nonclassrecdescrip').hide();
		});
		$('#recording .nonclassrec').click(function() {
			$('.nonclassrecdescrip').show();
		});
		$('#recording .nonclassrec').click(function() {
			$('.classrecformat').hide();
		});
		// Event Recurring
		$('#recurring .recurringyes').click(function() {
			$('.allsemester').show();
		});
		$('#recurring .recurringno').click(function() {
			$('.allsemester').hide();
		});
	});
</script>	
