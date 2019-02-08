
 <?php
	
	$user = "root";
	$password = "";

	$conn = new mysqli_connect('p:host=localhost:3306;dbname=eroberer_noenemies_nostorage', $user, $password);
	if (!$conn) {
	   $m = oci_error();
	   echo $m['message'], "\n";
	   exit;
	}
	else {
	   print "Connected";
	}

 ?>
