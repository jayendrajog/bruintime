<?php

    require_once '../database.php';

	$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if($connection->connect_error) die ($connection->connect_error);

	$quarter = $_POST["quarter"];
	$prof = $_POST["professor"];
	$theclass = $_POST["theclass"];
	$sub = $_POST["subject"];
	$query = 'SELECT Aplus, A, Aminus, Bplus, B, Bminus, Cplus, C, Cminus, Dplus, D, Dminus, F FROM gradelist WHERE Subject = "' . $sub . '"and Class = "' . $theclass . '" and Professor = "' . $prof. '" and Quarter = "' . $quarter . '"';
	$result = $connection->query($query);
	if(!$result) die ($connection_error);

	$grades = array();
	$row = $result->fetch_array(MYSQL_ASSOC);
	$grades[] = $row['Aplus'];
	$grades[] = $row['A'];		
	$grades[] = $row['Aminus'];	
	$grades[] = $row['Bplus'];
	$grades[] = $row['B'];
	$grades[] = $row['Bminus'];
	$grades[] = $row['Cplus'];
	$grades[] = $row['C'];
	$grades[] = $row['Cminus'];
	$grades[] = $row['Dplus'];
	$grades[] = $row['D'];
	$grades[] = $row['Dminus'];
	$grades[] = $row['F'];

	foreach($grades as $g)
	{
		echo $g . ',';
	}

	$result->close();
	$connection->close();

?>