<?php

    require_once '../database.php';

	$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if($connection->connect_error) die ($connection->connect_error);

	$sub = $_POST["subject"];
	$query = 'SELECT DISTINCT Class FROM gradelist WHERE Subject = "' . $sub . '"';
	$result = $connection->query($query);
	if(!$result) die ($connection_error);

	$rows = $result->num_rows;

	$selectBar = '';

	for($j = 0; $j < $rows; $j++)
	{
		$result->data_seek($j);
		$value = $result->fetch_assoc()['Class'];
		$selectBar .= '<option value = "' . $value . '">' . $sub. ' '. $value .'</option>';			
	}
	$result->close();
	$connection->close();

	echo $selectBar;

?>