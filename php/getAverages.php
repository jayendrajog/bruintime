<?php

    require_once '../database.php';


	$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if($connection->connect_error) die ($connection->connect_error);

	$query = "SELECT Subject, Aplus, A, Aminus, Bplus, B, Bminus, Cplus, C, Cminus, Dplus, D, Dminus, F FROM gradelist";
	$result = $connection->query($query);
	if(!$result) die ($connection_error);


	$numrows = $result->num_rows;
	/* Array to hold the average GPAs for every major */
	$avg_grades = array();
	/* Array to hold average GPAs for every class*/
	$cur_grades = array();
	$curSubject = ""; 
	for($j = 0; $j < $numrows; ++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		/* if the subject changes*/
		if($row['Subject'] != $curSubject)
		{
			$avg_grades[(array_sum($cur_grades)/count($cur_grades))] =  $curSubject;
			unset($cur_grades);
			$cur_grades = array();
			$curSubject = $row['Subject'];
		}
		$total_students = $row['Aplus'] + $row['A'] + $row['Aminus'] + 
						  $row['Bplus'] + $row['B'] + $row['Bminus'] +
						  $row['Cplus'] + $row['C'] + $row['Cminus'] +
						  $row['Dplus'] + $row['D'] + $row['Dminus'] + $row['F'];
		$total_grade_points = $row['Aplus'] * 4 + 
							  $row['A'] * 4 + 
							  $row['Aminus'] * 3.7 + 
							  $row['Bplus']* 3.3 +
							  $row['B']*3 +
							  $row['Bminus']*2.7 +
							  $row['Cplus']*2.3 + 
							  $row['C']*2 +
							  $row['Cminus']*1.7 +
							  $row['Dplus']*1.3 +
							  $row['D']*1 +
							  $row['Dminus']*0.7;
		$cur_grades[] = ($total_grade_points/$total_students);
	}

	asort($avg_grades);
	$tabledata = '';
	foreach ($avg_grades as $GPA => $major)
	{
		$tabledata .= '<tr><td>' . $GPA  . '</td> <td>' . $major . '</td></tr>';
	}

	$result->close();
	$connection->close();

	echo $tabledata;

?>