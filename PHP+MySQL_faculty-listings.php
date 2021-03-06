<?php 
	include "includes/header.inc"; 
	include "includes/config-fac.inc"; // connect to db
	
	// define Faculty Area variables for SQL queries ... $_GET array is passed via secondary nav links
	$area1 = $_GET["area"];
	$area2 = $_GET["area"];	
	$area3 = $_GET["area"];
	
	// define h1 variable ... $area1, $area2, & $area3 are defined via the $_GET value passed from the secondary nav links
	if ($area1 == "acct" OR $area2 == "acct" OR $area3 == "acct") {
			$area_listing = 'Accounting';
	} elseif ($area1 == "legal" OR $area2 == "legal" OR $area3 == "legal") {
			$area_listing = 'Business &amp; Legal Studies';
	} elseif ($area1 == "finc" OR $area2 == "finc" OR $area3 == "finc") {
			$area_listing = 'Finance';
	} elseif ($area1 == "mgmt" OR $area2 == "mgmt" OR $area3 == "mgmt") {
			$area_listing = 'Management';
	} elseif ($area1 == "info" OR $area2 == "info" OR $area3 == "info") {
			$area_listing = 'Management Science';
	} elseif ($area1 == "mktg" OR $area2 == "mktg" OR $area3 == "mktg") {
			$area_listing = 'Marketing';
	} else {
		$area_listing = NULL;
	}
	
	// SQL queries to populate fac position sub-sections in listing
	$query_tenure = "
	SELECT main_img, Fname, Lname, NickName, recordid 
	FROM faculty_staff 
	WHERE (designation='full-time') AND (area1='".$area1."' OR area2='".$area2."' OR area3='".$area3."') AND (position='Tenured' OR position='Tenure_Track')
	ORDER BY Lname ASC";
	$result_tenure = mysqli_query($conn,$query_tenure);

	$query_practice = "
	SELECT main_img, Fname, Lname, NickName, recordid  
	FROM faculty_staff 
	WHERE (designation='full-time') AND (area1='".$area1."' OR area2='".$area2."' OR area3='".$area3."') AND (position='Professor_of_Practice') 
	ORDER BY Lname ASC";
	$result_practice = mysqli_query($conn,$query_practice);

	$query_visiting = "
	SELECT main_img, Fname, Lname, NickName, recordid  
	FROM faculty_staff 
	WHERE (designation='full-time') AND (area1='".$area1."' OR area2='".$area2."' OR area3='".$area3."') AND (position='Visiting_Professor') 
	ORDER BY Lname ASC";
	$result_visiting = mysqli_query($conn,$query_visiting);

	$query_instructor = "
	SELECT main_img, Fname, Lname, NickName, recordid  
	FROM faculty_staff 
	WHERE (designation='full-time') AND (area1='".$area1."' OR area2='".$area2."' OR area3='".$area3."') AND (position='Instructor') 
	ORDER BY Lname ASC";
	$result_instructor = mysqli_query($conn,$query_instructor);

	$query_lecturer = "
	SELECT main_img, Fname, Lname, NickName, recordid  
	FROM faculty_staff 
	WHERE (designation='full-time') AND (area1='".$area1."' OR area2='".$area2."' OR area3='".$area3."') AND (position='Lecturer') 
	ORDER BY Lname ASC";
	$result_lecturer = mysqli_query($conn,$query_lecturer);

	$query_adjunct = "
	SELECT main_img, Fname, Lname, NickName, recordid  
	FROM faculty_staff 
	WHERE (designation='adjunct' OR designation='facstaff') AND (area1='".$area1."' OR area2='".$area2."' OR area3='".$area3."') 
	ORDER BY Lname ASC";
	$result_adjunct = mysqli_query($conn,$query_adjunct);
	
	$query_emeritus = "
	SELECT main_img, Fname, Lname, NickName, recordid  
	FROM faculty_staff 
	WHERE designation='emeritus' AND (area1='".$area1."' OR area2='".$area1."' OR area3='".$area1."') 
	ORDER BY Lname ASC";
	$result_emeritus = mysqli_query($conn,$query_emeritus);
	
	$result_positions_array = array($result_tenure, $result_practice, $result_visiting, $result_instructor, $result_lecturer, $result_adjunct, $result_emeritus); // array composed of results from queries above. Therefore $result_positions_array is a multidimensional array
	
	// Function that checks the orientation of each faculty photo
	function orientationCheck($photoOrientation) {
		list($photowidth, $photoheight) = getimagesize($photoOrientation);
		if ($photoheight > $photowidth) {
			echo "img-crop_portrait"; // add Portrait class
		} else {
			echo "img-crop_landscape"; // add Landscape class
		}
	} 
?>	
	<!-- Breadcrumb to match Drupal portion of site -->	
	<div class="main-container container" style="min-height: 700px">
		<header id="page-header" role="banner"> </header>
		<div class="row">
			<section class="col-sm-12">
				<ol class="breadcrumb">
					<li><a href="https://freeman.tulane.edu">Home</a></li>
					<li><a href="http://freeman.tulane.edu/faculty-research">Faculty &amp; Research</a></li>
					<li class="active"><?php echo $area_listing; ?></li>
				</ol> 
				<div class="region region-content">	
				
	<!-- Unique page content -->									
		<main class="fac-listings">
			<h1><?php echo $area_listing; ?></h1>		
	<?php  
			$x = 0;	
			while ($x < count($result_positions_array)) { // one loop per "faculty position" query/result that is an element in the $result_positions_array
			
				if (mysqli_num_rows($result_positions_array[$x]) > 0) {
					// define $h3 variable to set <h3> faculty position title for each area
					switch($x) { 
						case '0': $h3 = "Full-Time Tenured and Tenure Track"; break;
						case '1': $h3 = "Professors of Practice"; break;
						case '2': $h3 = "Visiting Professors"; break;
						case '3': $h3 = "Instructor"; break;								
						case '4': $h3 = "Lecturer"; break;					
						case '5': $h3 = "Adjunct"; break;
						case '6': $h3 = "Emeritus"; break;
					}
	?>			
					<h3><?php echo $h3;?></h3>
					
	<?php 			// generates the block of code below through each record in query result 
					while ($row = mysqli_fetch_assoc($result_positions_array[$x])) { 
					?>
						<div class="<?php orientationCheck($row["main_img"]); ?>">
							<div class="text-overlay">
								<?php  echo $row["Fname"]." ";
								if ($row["NickName"] != 0) {
									echo "\"".$row["NickName"]."\" ";
								}
								echo $row["Lname"]; ?><br />
								<span class="seebio">
									<a href="faculty-profile.php?idkey=<?php echo $row["recordid"] ?>">See Bio ></a>
								</span>
							</div>
							<div class="img-overlay"></div>
							<img src="<?php echo $row["main_img"]?>"> 
						</div>
	<?php				
					} 
	?>
					<div style="clear: both"></div>
	<?php			mysqli_free_result ($result_positions_array[$x]);

				} 
				$x++;
			}		
			mysqli_close($conn); 
											
	// End of page's unique content		
	include "includes/footer_plus.inc"; ?>		
