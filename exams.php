<!-- Mahesh Singh
CSCB20 - Web Design and Databases
Assignment 3 - Web Application and Database
Description - My task for this assignment is to write the HTML, CSS, JavaScript and PHP code for a Web app that accesses a final exam timetable database site. My app will show the exam time based on the course name, course intructor and/or date of the course exam.
Summary - This file is one of the PHP portions of the assignment. This file will use the input data sent from courses.php to choose the correct query and fill in the selection menu.
-->
<?php
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	//select the correct query based on user input data
	//only course filled in
	if ($instructor == "" and $date == ""){
		$sql = "SELECT * FROM courses NATURAL JOIN time WHERE course LIKE '%" . $course . "%'";
	//only course and intructor filled in
	} else if (!($instructor == "") and $date == "") {
		$sql = "SELECT * FROM courses NATURAL JOIN time WHERE course LIKE '%" . $course . "%' AND instructor LIKE '" . $instructor . "%'";
	//only course and date filled in
	} else if (!($date == "") and $instructor == "") {
		$sql = "SELECT * FROM courses NATURAL JOIN time WHERE course LIKE '%" . $course . "%' AND date = '" . $date . "'";
	//course, instructor and date filled in
	} else {
		$sql = "SELECT * FROM courses NATURAL JOIN time WHERE course LIKE '%" . $course . "%' AND instructor LIKE '" . $instructor . "%' AND date = '" . $date . "'";
	}
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
		$select_row =  $row["course"]." ". $row["section"] ." ". $row["instructor"];
		$display_row = $select_row . " " . $row["date"] . " " . $row["start"] . " " . $row["end"];
		//send the correct value for return based on how the user interacted with the table
		if (empty($return)){
		?>
			<option value="<?php echo $display_row ?>"><?php echo $select_row ?></option>
		<?php
		} else {
		?>
			<option value="<?php echo $return . "|" . $display_row ?>"><?php echo $select_row ?></option>
		<?php
		}
	    }
	} else {
	    	//error if nothing found
		header("HTTP/1.0 404 Not Found"); //404 error
	}
	$conn->close();
?>
