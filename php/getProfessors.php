<?php

    require_once '../database.php';

	$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if($connection->connect_error) die ($connection->connect_error);

	$theclass = $_POST["theclass"];
	$sub = $_POST["subject"];
	$query = 'SELECT DISTINCT Professor FROM gradelist WHERE Subject = "' . $sub . '"and Class = "' . $theclass . '"';
	$result = $connection->query($query);
	if(!$result) die ($connection_error);

	$rows = $result->num_rows;

	$selectBar = '';

	for($j = 0; $j < $rows; $j++)
	{
		$result->data_seek($j);
		$value = $result->fetch_assoc()['Professor'];
		$selectBar .= '<option value = "' . $value . '">' . $value .'</option>';				
	}
	$result->close();
	$connection->close();

	echo $selectBar;

?>