<?php
include('connect.php');
include('db.php');
$query = '';
$output = array();
$query .= "SELECT * FROM candidates ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE fname LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR lname LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY cand_id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row["cand_id"];
	$sub_array[] = $row["fname"];
	$sub_array[] = $row["mname"];
	$sub_array[] = $row["lname"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["cand_id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["cand_id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$sub_array[] = '<a href = "tableinsert.php?candid='.$row["cand_id"].'" class="btn btn-warning btn-xs update">Add to Votetable</a>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>