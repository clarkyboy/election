<?php

function db(){
		
		try {
		     return new PDO("mysql:host=localhost;dbname=kkelection","root","");
		    echo "Connected Successfully";
		  }
		catch(PDOException $e)
		    {
		    echo "Connection failed: " . $e->getMessage();
		    }
}

function addCandidate($fname, $mname, $lname){

		$db = db();
		$sql = "INSERT into candidates (fname, mname, lname) VALUES (?,?,?)";
		$st = $db->prepare($sql);
		$st->execute(array($fname, $mname, $lname));	
		$db = null;
}
function candidates(){

		$sql = "SELECT ca.cand_id as ID, concat(ca.fname, ' ', ca.mname, ' ', ca.lname) as Fullname FROM candidates ca INNER JOIN votetable v ON ca.cand_id = v.cand_id
			ORDER BY rand()";
		$db = db();
		$st = $db->prepare($sql);
		$st->execute();
		$grp = $st->fetchAll(); //returns and array of arrays
		return $grp;
}
function candidate(){

		$sql = "SELECT * FROM votetable";
		$db = db();
		$st = $db->prepare($sql);
		$st->execute();
		$grp = $st->fetchAll(); //returns and array of arrays
		return $grp;
}
function findCandidate($candid){
	$db = db();
	$sql = "SELECT concat(ca.fname, ' ', ca.mname, ' ', ca.lname) AS Name  from candidates ca where  cand_id = '$candid' ";
	$q = $db->query($sql);
	return $m = $q->fetchColumn();
}
function insertVote($candid, $vote){
		$db = db();
		$sql = "INSERT into votetable (cand_id, votes) VALUES (?,?)";
		$st = $db->prepare($sql);
		$st->execute(array($candid, $vote));
		$db = null;	
}
function deleteCandidate($candid){

	$sql = "DELETE FROM votetable WHERE cand_id = ?";
	$db = db();
	$st = $db->prepare($sql);
	$st->execute(array($candid));
	$db = null;
}
function countifexist($candid){

	 	$sql = "SELECT count(*) FROM votetable WHERE cand_id = ?";
		$db = db();
		$st = $db->prepare($sql);
		$st->execute(array($candid));
		$grp = $st->fetchColumn(); //returns and array of arrays
		$db = null;
		return $grp;
}
function vote($candid){
	$sql = "UPDATE votetable SET votes = votes + 1 WHERE cand_id = ?";
	$db = db();
	$st = $db->prepare($sql);
	$st->execute(array($candid));
	$db = null;
}
function rankvotes(){

		$sql = " SELECT concat(ca.fname, ' ', ca.mname, ' ', ca.lname) as Fullname, v.votes as Vote
				 FROM candidates ca LEFT JOIN votetable v ON ca.cand_id = v.cand_id
				 ORDER BY v.votes DESC
				 LIMIT 13 
				";
		$db = db();
		$st = $db->prepare($sql);
		$st->execute();
		$grp = $st->fetchAll(); //returns and array of arrays
		$db = null;
		return $grp;

}
function resetvote(){
	$sql = "UPDATE votetable SET votes = 0";
	$db = db();
	$st = $db->prepare($sql);
	$st->execute();
	$db = null;
}
function sumvotes(){

		$sql = "SELECT SUM(votes) FROM votetable";
		$db = db();
		$st = $db->prepare($sql);
		$st->execute();
		$grp = $st->fetchColumn(); //returns and array of arrays
		return $grp;
}
function get_total_all_records(){

		$sql = "SELECT SUM(*) FROM candidates";
		$db = db();
		$st = $db->prepare($sql);
		$st->execute();
		$grp = $st->fetchColumn(); //returns and array of arrays
		return $grp;

}
function ifnameexist($fullname){

		$sql = "SELECT count(concat(fname,' ', mname, ' ', lname)) as exist FROM candidates WHERE concat(fname,' ', mname, ' ', lname) = ?";
		$db = db();
		$st = $db->prepare($sql);
		$st->execute(array($fullname));
		$grp = $st->fetchColumn(); //returns and array of arrays
		return $grp;
}
?>