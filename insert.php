<?php
	include('db.php');

	$candid = $_GET['candid'];
	$posid = $_GET['posid'];
	$partyid = $_GET['partyid'];
	$vote = 0;
	$ifexist = countifexist($candid);

	if(isset($_GET['candid'])){
		if($ifexist == 1){
			echo '<script type="text/javascript">alert("Candidate Already Added")</script>';
			header('Location: insert.php');
		}else{
			insertVote($candid, $posid, $partyid, $vote);
			echo '<script type="text/javascript">alert("Added Successfully")</script>';
			header('Location: masterfile.php');
		}
		
		
	}
?>