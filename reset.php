<?php
	
	include('db.php');
	$status = $_GET['status'];

	if(isset($status)){

		if($status == 1)
		{
			resetvote();
			header('Location: results.php');
		}
		else{
			header('Location: results.php');
		}
	}

?>