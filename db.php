<?php

function db(){
		
		try {
		     return new PDO("mysql:host=localhost;dbname=election","root","");
		    echo "Connected Successfully";
		  }
		catch(PDOException $e)
		    {
		    echo "Connection failed: " . $e->getMessage();
		    }
}
function partylist(){

		$sql = "SELECT * FROM partylist";
		$db = db();
		$st = $db->prepare($sql);
		$st->execute();
		$grp = $st->fetchAll(); //returns and array of arrays
		return $grp;
}
function position(){

		$sql = "SELECT * FROM position";
		$db = db();
		$st = $db->prepare($sql);
		$st->execute();
		$grp = $st->fetchAll(); //returns and array of arrays
		return $grp;
}
function addCandidate($fname, $lname, $bday, $email, $address, $posid, $partyid){

		$db = db();
		$sql = "INSERT into candidates (fname, lname, email, bday, address, pos_id, party_id) VALUES (?,?,?,?,?,?,?)";
		$st = $db->prepare($sql);
		$st->execute(array($fname, $lname, $email, $bday, $address, $posid, $partyid));	
		$db = null;
}
function candidates(){

		$sql = "SELECT * FROM candidates";
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
function findParty($partyid){
	$db = db();
	$sql = "SELECT partylist_name from partylist where  party_id = '$partyid' ";
	$q = $db->query($sql);
	return $m = $q->fetchColumn();
}
function findPosition($posid){
	$db = db();
	$sql = "SELECT pos_name from position where  pos_id = '$posid' ";
	$q = $db->query($sql);
	return $m = $q->fetchColumn();
}
function findCandidate($candid){
	$db = db();
	$sql = "SELECT concat(fname, ' ', lname) AS Name  from candidates where  cand_id = '$candid' ";
	$q = $db->query($sql);
	return $m = $q->fetchColumn();
}
function insertVote($candid, $posid, $partyid, $vote){
		$db = db();
		$sql = "INSERT into votetable (pos_id, cand_id, party_id, votes) VALUES (?,?,?,?)";
		$st = $db->prepare($sql);
		$st->execute(array($posid, $candid, $partyid, $vote));
		$db = null;	
}
function deleteCandidate($candid){

	$sql = "DELETE FROM votetable WHERE candid = ?";
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

		$sql = "SELECT concat(ca.fname,' ', ca.lname) as Name, pos.pos_name as Position, pt.partylist_name as Partylist, v.votes as Vote 
				FROM votetable v
				LEFT JOIN position pos ON v.pos_id = pos.pos_id
				LEFT JOIN candidates ca ON v.cand_id = ca.cand_id
				LEFT JOIN partylist pt ON v.party_id = pt.party_id
				ORDER BY v.votes DESC
				LIMIT 9
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
?>