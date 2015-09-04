<?php	

  require_once '../database.php';

	/* Get mysql connect information from external file and connect*/
	$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if($connection->connect_error) die ($connection->connect_error);

	/* Get the column containing the subjects from the table */
	$query = 'SELECT DISTINCT Subject FROM gradelist ORDER BY Subject';
	$result = $connection->query($query);

	if(!$result) die ($connection_error);

	/* Keep track of the number of rows in the column; necessary for iterating */
	$rows = $result->num_rows;

	/* selectBar keeps track of the html code for the select Bar*/
	$selectBar = '';

	for($j = 0; $j < $rows; $j++)
	{
		$result->data_seek($j);
		$value = $result->fetch_assoc()['Subject'];
		$selectBar .= '<option value = "' . $value . '">' . $value .'</option>';		
	}

	$result->close();
	$connection->close();

	echo $selectBar;

?>
