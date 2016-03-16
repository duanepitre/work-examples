<?php 

	include "includes/config-fac.include"; // DB connection
	$idkey=$_POST["idkey"]; // 'recordid' (primary key)

// Image Processing Script

	// Deleting image
	if(!empty($_POST['img_delete'])) {
		$imgs_to_be_deleted = $_POST['img_delete'];
		$x = 0;
		while ($x < count($imgs_to_be_deleted)) {
			// Delete img from Freeman server ... which it currently does not allow. Just leaving this here...
 		 	/* $query_get_path = "SELECT ".$imgs_to_be_deleted[$x]." FROM faculty_staff WHERE Email='".$_POST["emailid"]."'";
			$path = mysqli_query($conn,$query_get_path);
			$row = mysqli_fetch_assoc($path);
			unlink($row[$imgs_to_be_deleted[$x]]); */ 
			
			// Delete img path from DB
			$query_delete_path = "UPDATE faculty_staff SET ".$imgs_to_be_deleted[$x]." = NULL WHERE Email='".$_POST["emailid"]."'";
			mysqli_query($conn,$query_delete_path);	
			$x++;
		}
	}	

	// Adding image
	$user_uploaded_files = array($_FILES['contribution1'], $_FILES['contribution2'], $_FILES['contribution3'], $_FILES['interest1'], $_FILES['interest2'], $_FILES['interest3']); 
	$x = 0; 
	while ($x < count($user_uploaded_files)) {  // Looping through array containing uploaded images
	
		if ($user_uploaded_files[$x]['size'] != 0) { 
		
			switch ($user_uploaded_files[$x]) {
				case $user_uploaded_files[0]:
					$input_name = 'contribution1';
					break;
				case $user_uploaded_files[1]:
					$input_name = 'contribution2';
					break;
				case $user_uploaded_files[2]:
					$input_name = 'contribution3';
					break;
				case $user_uploaded_files[3]:
					$input_name = 'interest1';
					break;
				case $user_uploaded_files[4]:
					$input_name = 'interest2';
					break;
				case $user_uploaded_files[5]:
					$input_name = 'interest3';
					break;				
			}
			
			$allowed_filetypes = array('.jpg', '.jpeg', '.png'); // These will be the types of file that will pass the validation.
			$max_filesize = 3097152; // Maximum filesize in BYTES (currently 3MB).
			$upload_path = '../faculty/images/user-uploads/'; // The place the files will be uploaded to (currently a 'files' directory).
		 
			$filename = $user_uploaded_files[$x]['name']; // Get the name of the file (including file extension).
			/* echo '<div>'.print_r ($user_uploaded_files[$x]['name']).'</div>';  */ 
			$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
			$tulaneusername = $_POST["emailid"];
			$new_file_name = $tulaneusername."_".$input_name."_img".$ext;
			
			// Check if the filetype is allowed.
			if (!in_array($ext,$allowed_filetypes)) {
				echo "The file you attempted to upload is not allowed.";
			} 
		 
			// Now check the filesize.
			if (filesize($user_uploaded_files[$x]['tmp_name']) > $max_filesize) {
				echo "The file you attempted to upload is too large.";
			}

			// Check if we can upload to the specified path.
			if (!is_writable($upload_path)) {
				echo "You cannot upload to the specified directory.";
			}

			// Upload the file to your specified path.
			if (move_uploaded_file($user_uploaded_files[$x]['tmp_name'],$upload_path . $new_file_name)) {
				$query = "UPDATE faculty_staff SET ".$input_name."_img='" . "http://business.tulane.edu/faculty/images/user-uploads/" . $new_file_name. "' WHERE Email='".$_POST["emailid"]."'";
				mysqli_query($conn,$query);
			} else {
				echo 'There was an error during the file upload.  Please try again.'; // It failed :(.
			}
		}	
		$x++;
	}    
	
// DB query to update text
	include "includes/char_escape_profile.inc"; // Code to escape special characters in $_POST - add new "keys" to inc file when needed
	$query = "UPDATE faculty_staff SET contribution1='$_contribution1', contribution2='$_contribution2', contribution3='$_contribution3', interest1='$_interest1', interest2='$_interest2', interest3='$_interest3'  WHERE recordid='$idkey'";
	mysqli_query($conn,$query);
	
// DB query to display set images	
	$query2 = "SELECT contribution1, contribution2, contribution3, interest1, interest2, interest3, contribution1_img, contribution2_img, contribution3_img, interest1_img, interest2_img, interest3_img FROM faculty_staff WHERE recordid='$idkey'";
	$result = mysqli_query($conn,$query2);
	$row = mysqli_fetch_assoc($result);
	
// HTML -----------------------------------
	include "includes/headernav.php";
	include "includes/faculty-sidenav.php";
 ?>	
	<main>
		<div class="intro">
			<h3>Contributions &amp; Interests Update</h3>
		</div>
		<div class="category-col">
			<div class="category">
				<h4>Contribution 1</h4>
				<p><?php echo $row["contribution1"]; ?><br />
				<?php if (!empty ($row["contribution1_img"])) { ?>
					Current Image:<br>
					<img src="<?php echo $row["contribution1_img"]; ?>">
				<?php } ?> 
				</p>
			</div>
			<div class="category">
				<h4>Contribution 2</h4>
				<p><?php echo $row["contribution2"]; ?><br />
				<?php if (!empty ($row["contribution2_img"])) { ?>
					Current Image:<br>
					<img src="<?php echo $row["contribution2_img"]; ?>">
				<?php } ?> 
				</p>
			</div>
			<div class="category">
				<h4>Contribution 3</h4>
				<p><?php echo $row["contribution3"]; ?><br />
				<?php if (!empty ($row["contribution3_img"])) { ?>
					Current Image:<br>
					<img src="<?php echo $row["contribution3_img"]; ?>">
				<?php } ?> 
				</p>
			</div> 
		</div>
		<div class="category-col">
			<div class="category">
				<h4>Interest 1</h4>
				<p><?php echo $row["interest1"]; ?><br />
				<?php if (!empty ($row["interest1_img"])) { ?>
					Current Image:<br>
					<img src="<?php echo $row["interest1_img"]; ?>">
				<?php } ?> 
				</p>
			</div>
			<div class="category">
				<h4>Interest 2</h4>
				<p><?php echo $row["interest2"]; ?><br />
				<?php if (!empty ($row["interest2_img"])) { ?>
					Current Image:<br>
					<img src="<?php echo $row["interest2_img"]; ?>">
				<?php } ?> 
				</p>
			</div>
			<div class="category">
				<h4>Interest 3</h4>
				<p><?php echo $row["interest3"]; ?><br />
				<?php if (!empty ($row["interest3_img"])) { ?>
					Current Image:<br>
					<img src="<?php echo $row["interest3_img"]; ?>">
				<?php } ?> 
				</p>
			</div>
		</div>
	</main>
	
	</div> <!-- closing div from header -->
	</div> <!-- find what opening div this belongs to	as well ... seems the structure of some of these pages is a bit chaotic ... these closing divs are necessary for the footer to act correctly -->	
	
	<?php include "includes/footer_new.inc"; ?>
