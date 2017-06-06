<?php
	include('db.php');
	$partylist = partylist();
	$position = position();
	if(isset($_POST['register'])){

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$bday = $_POST['bday'];
		$address = $_POST['address'];
		$posid = $_POST['position'];
		$partyid = $_POST['partylist'];
		addCandidate($fname, $lname, $bday, $email, $address, $posid, $partyid);
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
	<body>
	<div class="jumbotron" style="padding: 10px;">
	  <h1>Welcome to Election Simulation</h1>      
	  <p>Chill, this is just a practice! Register first to run or <a href="votetable.php">Vote Here</a></p>
	</div>
	<div class="container" style="padding: 10px;">
	  <h2>Register here!</h2>
	  <form method="POST">
	   <div class="form-group">
	      <label for="firstname">First Name:</label>
	      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
	    </div>
	    <div class="form-group">
	      <label for="lastname">Last Name:</label>
	      <input type="text" class="form-control" id="lnam" placeholder="Enter Last Name" name="lname">
	    </div>
	    <div class="form-group">
	      <label for="bday">Birthday:</label>
	      <input type="date" class="form-control" id="bday" placeholder="Enter Last Name" name="bday">
	    </div>
	    <div class="form-group">
	      <label for="email">Email:</label>
	      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
	    </div>
	    <div class="form-group">
	      <label for="address">Address:</label>
	      <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
	    </div>
	     <div class="form-group">
	      <label for="position">Position:</label>
	      <select class="form-control" name="position">
	      <option class="form-control" value="#">Select Position</option>
	      <?php foreach($position as $pos) {?>
	      	<option class="form-control" value="<?php echo $pos['pos_id'];?>"><?php echo $pos['pos_name'];?></option>
	      <?php }?>
	      </select>
	    </div>
	     <div class="form-group">
	      <label for="partylist">Partylist:</label>
	      <select class="form-control" name="partylist">
	      	<option class="form-control" value="#">Select Partylist</option>
	      	<?php foreach($partylist as $party) {?>
	      	<option class="form-control" value="<?php echo $party['party_id'];?>"><?php echo $party['partylist_name'];?></option>
	      	<?php }?>
	      </select>
	    </div>
	    <input type="submit" class="btn btn-default" value="Submit" name="register">
	  </form>
	</div>
	</body>
</html>