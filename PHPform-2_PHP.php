<?php
  $email_to = "dpitre1@tulane.edu"; 
  $email_subject = "Media Services Request Form";
  $email_from = $_POST['email'];
	
  function died($error) {
    // error code
    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br /><br />";
    echo $error."<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    die();
  }
  
  $error_message = "";
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
	if(!preg_match($email_exp,$email_from)) {
		$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
	}
  
  $string_exp = "/^[A-Za-z .'-]+$/";
 
	if(strlen($error_message) > 0) {
	  died($error_message);
	}
// Email test formatting
  $email_message = "Form details below...\n\n";
 
function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    if(!empty($_POST['fullname'])) {
		$email_message .= "Name: ".clean_string($_POST['fullname'])."\n";
	}
    if(!empty($_POST['email'])) {
		$email_message .= "Email: ".clean_string($_POST['email'])."\n";
	}
    if(!empty($_POST['phone'])) {
		$email_message .= "Phone #: ".clean_string($_POST['phone'])."\n";
	}
	if(!empty($_POST['id'])) {
		$email_message .= "ID #: ".clean_string($_POST['id'])."\n";
	}
	if(!empty($_POST['by'])) {
		$email_message .= "Requested by: ".clean_string($_POST['by'])."\n";
	}
	if(!empty($_POST['type'])) {
		$email_message .= "This request is for a(n): ".clean_string($_POST['type'])."\n";
	}
	if(!empty($_POST['eventname'])) {
		$email_message .= "Event Name or Course ID: ".clean_string($_POST['eventname'])."\n";
	}
	if(!empty($_POST['room'])) {
		$email_message .= "Room #: ".clean_string($_POST['room'])."\n";
	}
	if(!empty($_POST['startdate']) && !empty($_POST['enddate'])) {
		$email_message .= "Date: ".clean_string($_POST['startdate'])." - ".clean_string($_POST['enddate'])."\n";
	}
	if(!empty($_POST['starttime']) && !empty($_POST['endtime'])) {
		$email_message .= "Time: ".clean_string($_POST['starttime'])." - ".clean_string($_POST['endtime'])."\n";
	}
	if(!empty($_POST['recurring'])) {
		if ($_POST['recurring'] == 'Yes') {
			$email_message .= "Is Event Recurring? ".clean_string($_POST['recurring'])."  /  ";
			$email_message .= "All Semester? ".clean_string($_POST['all'])."\n";
		} else {
			$email_message .= "Is Event Recurring? No \n";	
		}
	}
	if(!empty($_POST['day'])) {
		$days = $_POST['day'];
		$email_message .= "Day(s) of the Week: ".implode(", ", $days)."\n";
	}
	if(!empty($_POST['standard_equip'])) {
		$standard_equip = $_POST['standard_equip']; // via standard_equip[] array in form
		$email_message .= "Standard Room Equipment: ".implode(", ", $standard_equip)."\n";
	}
	if (!empty($_POST['special_equip']) || !empty($_POST['special_equip_lapelmics']) || !empty($_POST['special_equip_handmics']) || !empty($_POST['special_equip_other'])) {
		
		$email_message .= "Special Equipment: ";
		
		if(!empty($_POST['special_equip'])) {
			$special_equip = $_POST['special_equip']; // via special_equip[] array in form
			$email_message .= implode(", ", $special_equip);
			$spacer_pre = ", ";  
		}  else {
			$spacer_pre = null;
		} 
		if(!empty($_POST['special_equip_lapelmics'])) {
			$email_message .= $spacer_pre.clean_string($_POST['special_equip_lapelmics'])." Extra Lapel Mics";
		}
		if(!empty($_POST['special_equip_handmics'])) {
			$email_message .= ", ".clean_string($_POST['special_equip_handmics'])." Extra Hand Mics";
		}
		if(!empty($_POST['special_equip_other'])) {
			$email_message .= ", ".clean_string($_POST['special_equip_other']);
		}	
		$email_message .= "\n";
	}
	if(!empty($_POST['recording'])) {
		$email_message .= "Recording Request: ".clean_string($_POST['recording']);
		
		if ($_POST['recording'] == "Class Recording") {
		
			if(!empty($_POST['format'])) {
				$format = $_POST['format'];
				$email_message .= "  -  ";
				$x = 0;
				while ($x < count($format)) {
					if ($format > 1 && $x < count($format) - 1) {
						$separator = ", ";
					} else {
						$separator = null;
					}
					$email_message .= $format[$x];
					if($format[$x] == "DVD" && !empty($_POST['numdvd'])) {
						$email_message .= " (".clean_string($_POST['numdvd']).")";
					}
					$email_message .= $separator;
					$x++;
				}
			}	
		} elseif ($_POST['recording'] == "Non-Class Recording") {
			
			if(!empty($_POST['recdescription'])) {
				$email_message .= "  -  ".clean_string($_POST['recdescription']);
			}
		}
	}		
   
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  

?>
<!-- include success html here -->
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="http://www.freeman.tulane.edu/lib-tech/media/css/ms-req-form.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="main">
			<p>Thank you for your submission.<br />You will receive a detailed confirmation via email when your request is processed.</p>
		</div>  
	</body>
</html>	
