<!DOCTYPE html>
<html>
<!-- Mahesh Singh
CSCB20 - Web Design and Databases
Assignment 3 - Web Application and Database
Description - My task for this assignment is to write the HTML, CSS, JavaScript and PHP code for a Web app that accesses a final exam timetable database site. My app will show the exam time based on the course name, course intructor and/or date of the course exam.
Summary - This file is one of the PHP portions of the assignment. This is the first point of contact with the Web app. Users will input a partial course name, a partial instructor name and/or the exact date of any utsc exam.
-->
	<?php $return = $_REQUEST["return"] ?>
	<?php include "top.html" ?>
	<?php
		$size = 0; //default size
		//user has not interacted with the table yet
		if (empty($return)){
			$temp = [" "," "," "," "," "," "," "];
			$row[0] = $temp;
		//only one row therefore no split
		} else if(substr_count($return,"|") == 0){
			$row[0] = explode(" ",$return);
		//split up rows
		} else {
			$row = (explode("|", $return)); 
			$size = count($row) - 1;
			//split rows into their sections
			while($size >= 0){
				$row[$size] = (explode(" ",$row[$size]));
				$size = $size - 1;
			}
			$size = count($row) - 1; //set size to prepare to display content
		}
		//generate all the rows in the table based on user input
		while($size >= 0){ 
		?>
					<tr>
						<td><?php echo $row[$size][0] ?></td>
						<td><?php echo $row[$size][1] ?></td>
						<td><?php echo $row[$size][2] . " " . $row[$size][3] ?></td>
						<td><?php echo $row[$size][4] ?></td>
						<td><?php echo $row[$size][5] ?></td>
						<td><?php echo $row[$size][6] ?></td>					
					</tr>
		<?php
			$size = $size - 1;
		}
		?>
				</table>
			</div>
		</div>
		<div id="search">
			<p id="search_title">Search Exams</p>
			<form id="myForm" action="https://cmslab.utsc.utoronto.ca/courses/cscb20w17/singhm83/a3/search.php" method="GET">
				<input type="text" name="course" placeholder="course name">
				<input type="text" name="instructor" placeholder="instructor name">
				<input type="text" name="date" placeholder="yyyy-mm-dd">
				<input type="submit" value="Search">
				<?php
				//the user has already added an element to their exam schedule
				if (empty($return) == False){
				?>
				<input type="hidden" name="return" value="<?php echo $return ?>">
				<?php } ?>
				<select>
					<option disabled selected value>Select A Course</option>
				</select>
			</form>
		</div>
	<?php include "bottom.html" ?>
	<?php include "myexams.js" ?>
	</body>
</html>
