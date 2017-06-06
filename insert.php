<?php
include('connect.php');
include('db.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
			
            $fname = trim($_POST['fname']); 
            $mname = trim($_POST['mname']);
            $lname = trim($_POST['lname']);

            if(($fname != '') || ($mname != '') || ($lname != ''))
            {
                $fullname = $fname.' '.$mname.' '.$lname;
                $ifexists = ifnameexist($fullname);
                if($ifexists != 1){

                    addCandidate($fname, $mname, $lname);
                    echo "Successfully added!";

                }
                else{
                   echo "This person is already in the database!";
 
                }
            }
            else{
                echo "No Entry!";
            }
	}
	if($_POST["operation"] == "Edit")
	{
		$statement = $connection->prepare(
			"UPDATE candidates
			SET fname = :fname, mname = :mname, lname = :lname
			WHERE cand_id = :id
			"
		);
		$statement->bindParam(':fname', $_POST["fname"]);
		$statement->bindParam(':mname', $_POST["mname"]);
		$statement->bindParam(':lname', $_POST["lname"]);
		$statement->bindParam(':id', $_POST["user_id"]);
		$result = $statement->execute();
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>