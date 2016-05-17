<?php 
	include "includes/drupal_header.inc"; 
	include "includes/config-fac.include";

	$key=$_GET["idkey"];

	// MySQL query to populate faculty profile
	$query="SELECT main_img, Prefix, Fname, Mname, Lname, NickName, Location, Phone, Email, Title, title2, description, vita, homepage, coursepage, bio, bio2, area1, area2, area3, publications1, publications2, publications3, publications4, publications5, link1, link2, link3, link4, link5, courses, title2, contribution1, contribution2, contribution3, contribution1_img, contribution2_img, contribution3_img, facebook, twitter, linkedin, memory, memory_img, education, interest1, interest2, interest3, interest1_img, interest2_img, interest3_img FROM faculty_staff WHERE recordid='$key'";
	$result = mysqli_query($conn,$query);
	
	if (mysqli_num_rows($result) != 0) {
		$row = mysqli_fetch_array($result);
		switch($row["area1"]) {
			case 'acct':
				$mainarea = "Accounting";
				break;
			case 'legal':
				$mainarea = "Business &amp; Legal Studies";
				break;
			case 'finc':
				$mainarea = "Finance";
				break;
			case 'mgmt':
				$mainarea = "Management";
				break;					
			case 'info':
				$mainarea = "Management Science";
				break;
			case 'mktg':
				$mainarea = "Marketing";
				break;		
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
		<?php
			if (mysqli_num_rows($result) != 0) {
		?>
				<section class="content faculty-detail">
					<div class="clearfix"> 
						<div class="faculty-info">
				<!-- Name/title/contact info -->
							<h1><?php echo $row["Fname"] . " " . $row["Lname"]; ?></h1>
							<h4><?php echo $row["Title"];?></h4>
		<?php				if (!empty($row["title2"])) { ?>
								<h4><?php echo $row["title2"];?></h4>
		<?php				} ?>
		<?php				if (!empty($row["description"])) { ?>
								<h4><?php echo $row["description"];?></h4>
		<?php				} ?>
							<table class="table" id="contact-info">
								<tr>
									<td>Office</td>
									<td><?php echo $row["Location"];?></td>
								</tr>
								<tr>
									<td>Phone</td>
									<td><?php echo $row["Phone"];?></td>
								</tr>
								<tr>
									<td>Email</td>
									<td><?php echo "<a href=mailto:".$row["Email"].">".$row["Email"]."</a>";?></td>
								</tr>
								<?php 
									if (!empty ($row["homepage"])) {
										echo "<tr><td>Website</td><td><a href=".$row["homepage"]." target=\"_blank\">".$row["homepage"]."</td></tr>"; 
									} 

									if (!empty ($row["vita"])) {
										echo "<tr><td>CV</td><td><a href=".$row["vita"]." target=\"_blank\">Download PDF</td></tr>"; 
									} 
								?>  
							</table>

		<?php				if ($row["facebook"] == !NULL || $row["twitter"] == !NULL || $row["linkedin"] == !NULL ) { ?>
								<div class="faculty-social">
		<?php 						if (!empty($row["facebook"])){ ?>
										<a href="<?php echo $row["facebook"]?>" target="_blank"><img border="0" src="img/assets/ico-facebook-round.png"></a>
		<?php 						}
									if (!empty($row["twitter"])){ ?>
										<a href="<?php echo $row["twitter"]?>" target="_blank"><img border="0" src="img/assets/ico-twitter-round.png"></a>
		<?php						}
									if (!empty($row["linkedin"])){ ?>
										<a href="<?php echo $row["linkedin"]?>" target="_blank"><img border="0" src="img/assets/ico-linkedin-round.png"></a>
		<?php						}  ?>
								</div>
		<?php				} ?>				
						</div>
						<div class="main-img">
							<img src="<?php echo $row["main_img"]; ?>">
						</div>
					</div> 
		 
		<?php	// "BIOGRAPHY" Section ------------------------------
					if (!empty ($row["bio2"])) { ?>
						<h2><span>Biography</span></h2>
						<p><?php echo nl2br($row["bio2"]); ?></p> 
		<?php		} ?>

		<?php	// "COURSES" Section ------------------------------
					if (!empty ($row["courses"])) { ?>
						<h2><span>Courses</span></h2>
						<p><?php echo nl2br($row["courses"]); ?></p> 
		<?php		} 
				// "CONTRIBUTIONS" Section ------------------------------
					if (!empty ($row["contribution1"])) { ?>
						<h2><span>Contributions</span></h2>
						<div class="row">
							<div class="col-sm-4">
		<?php					if (!empty ($row["contribution1_img"])) { ?>
									<img src="<?php echo $row["contribution1_img"]; ?>">
		<?php					}
								echo "<p>".nl2br($row["contribution1"])."</p>"; ?>
							</div>
							<div class="col-sm-4">
		<?php					if (!empty ($row["contribution2_img"])) { ?>
									<img src="<?php echo $row["contribution2_img"]; ?>">
		<?php					}
								echo "<p>".nl2br($row["contribution2"])."</p>"; ?>
							</div>
							<div class="col-sm-4">
		<?php					if (!empty ($row["contribution3_img"])) { ?>
									<img src="<?php echo $row["contribution3_img"]; ?>">
		<?php					}
								echo "<p>".nl2br($row["contribution3"])."</p>"; ?>
							</div>
						</div>
		<?php		} 
				// "RESEARCH" Section ------------------------------------
					if (!empty ($row["publications1"])) { ?>
						<h2><span>Research</span></h2>
		<?php			if (!empty ($row["link1"])) { ?>
							<p><a href="<?php echo $row["link1"]; ?>" target="_blank"><?php echo $row["publications1"]; ?></a>
		<?php			} else { ?>
							<p><?php echo $row["publications1"]; ?></p>
		<?php			} 
						if (!empty ($row["link2"])) { ?>
							<p><a href="<?php echo $row["link2"]; ?>" target="_blank"><?php echo $row["publications2"]; ?></a>
		<?php			} else { ?>
							<p><?php echo $row["publications2"]; ?></p>
		<?php			} 
						if (!empty ($row["link3"])) { ?>
							<p><a href="<?php echo $row["link3"]; ?>" target="_blank"><?php echo $row["publications3"]; ?></a>
		<?php			} else { ?>
							<p><?php echo $row["publications3"]; ?></p>
		<?php			} 
						if (!empty ($row["link4"])) { ?>
							<p><a href="<?php echo $row["link4"]; ?>" target="_blank"><?php echo $row["publications4"]; ?></a>
		<?php			} else { ?>
							<p><?php echo $row["publications4"]; ?></p>
		<?php			} 
						if (!empty ($row["link5"])) { ?>
							<p><a href="<?php echo $row["link5"]; ?>" target="_blank"><?php echo $row["publications5"]; ?></a>
		<?php			} else { ?>
							<p><?php echo $row["publications5"]; ?></p>
		<?php			} 	
					} ?>

		<?php	// "MEMORABLE MOMENT" Section ------------------------------------	
				if (!empty ($row["memory"])) { ?>
					<h2><span>Memorable Moment</span></h2>
					<div class="row memory">
						<p>
		<?php			if (!empty ($row["memory_img"])) { ?>
							<img src="<?php echo $row["memory_img"]; ?>"><?php echo $row["memory"]; ?>
		<?php			} else {
							echo $row["memory"];
						} ?>
						</p>
					</div>
		<?php	} ?>
				
		<?php	// "EDUCATION" Section ------------------------------------
				if (!empty ($row["education"])) { ?>
					<h2><span>Education &amp; Affiliations</span></h2>
					<p><?php echo nl2br($row["education"]); ?></p>
		<?php	} 
				 
				// "INTEREST" Section ------------------------------
				if (!empty ($row["interest1"])) { ?>
					<h2><span>Interests</span></h2>
					<div class="row">
						<div class="col-sm-4">
		<?php					if (!empty ($row["interest1_img"])) { ?>
								<img src="<?php echo $row["interest1_img"]; ?>">
		<?php					}
							echo "<p>".nl2br($row["interest1"])."</p>"; ?>
						</div>
						<div class="col-sm-4">
		<?php					if (!empty ($row["interest2_img"])) { ?>
								<img src="<?php echo $row["interest2_img"]; ?>">
		<?php					}
							echo "<p>".nl2br($row["interest2"])."</p>"; ?>
						</div>
						<div class="col-sm-4">
		<?php					if (!empty ($row["interest3_img"])) { ?>
								<img src="<?php echo $row["interest3_img"]; ?>">
		<?php					}
							echo "<p>".nl2br($row["interest3"])."</p>"; ?>
						</div>
					</div>
		<?php	} ?>
			
				</section>
		<?php	
			} // closing bracket from IF statement - if (mysqli_num_rows($result) != 0){ 
							
	// End of page's unique content 
					
	include "includes/footer_plus.inc"; ?>		
