
 <?php
	
	$user = "root";
	$password = "";

	$conn = new mysqli('p:host=localhost:3306;dbname=eroberer_noenemies_nostorage', $user, $password);
	if (!$conn) {
	   $m = oci_error();
	   echo $m['message'], "\n";
	   exit;
	}

	function parseSQLUpdateString ($tableName, $column, $newValue, $searchedCol, $searchedValue) {
		$sqlString = $conn -> prepare("UPDATE ? SET ? = ? WHERE ? = ?");
		$sqlString -> bind_param('ssiss', $tablename, $column, $newValue, $searchedCol, $searchedValue);
		$sqlString = $conn -> real_escape_string($sqlString);
		
		return $sqlString;
	}

	function parseSQLSelectString ()

 ?>
