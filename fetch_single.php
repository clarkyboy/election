<?php
include('connect.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM candidates
		WHERE cand_id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["fname"] = $row["fname"];
		$output["mname"] = $row["mname"];
		$output["lname"] = $row["lname"];
	}
	echo json_encode($output);
}
?>