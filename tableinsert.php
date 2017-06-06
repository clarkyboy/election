<?php
	include('db.php');

	$candid = $_GET['candid'];
	$vote = 0;
	$ifexist = countifexist($candid);

	if(isset($_GET['candid'])){
		if($ifexist == 1){
			echo "Candidate Already Added";
			header('Location: index.php');
		}else{
			insertVote($candid, $vote);
			echo "Added Successfully!";
			header('Location: index.php');
		}
		
		
	}
?>