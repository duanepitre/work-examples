<?php

// ********* CONNECTION - used as an include in real scenario *********

$conn = mysqli_connect("localhost", "my_user", "my_password", "Directory"); 

if (!$conn) {
    echo "Error: Unable to connect to the database." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// ********* QUERIES & RESULTS *********

$query = "
SELECT first_name, last_name, tulane_email, imgsrc, designation 
FROM primary_data 
WHERE designation='BSM1' 
ORDER BY last_name, first_name ASC
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) != 0) {
	while ($row = mysqli_fetch_assoc($result)) {
    	echo $row["imgsrc"];
		echo $row["first_name"];
   		echo $row["last_name"]."</b><br>\n";
   		echo $row["tulane_email"];
	} 
} else {
	echo "No records were returned.";
}

mysqli_close($conn); // Close connection

?>
