<?php

    require_once '../database.php';

	$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if($connection->connect_error) die ($connection->connect_error);

	$prof = $_POST["professor"];
	$theclass = $_POST["theclass"];
	$sub = $_POST["subject"];
	$query = 'SELECT DISTINCT Quarter FROM gradelist WHERE Subject = "' . $sub . '"and Class = "' . $theclass . '" and Professor = "' . $prof. '"';
	$result = $connection->query($query);
	if(!$result) die ($connection_error);

	$rows = $result->num_rows;

	$selectBar = '';

	for($j = 0; $j < $rows; $j++)
	{
		$result->data_seek($j);
		$value = $result->fetch_assoc()['Quarter'];
		$selectBar .= '<option value = "' . $value . '">' . $value .'</option>';				
	}
	$result->close();
	$connection->close();

	echo $selectBar;

?>