<?php
	$page = $_SERVER['PHP_SELF'];
    $sec = "3600";
	include('db.php');
	$candidates = candidates();
?>
<html>
	<head>
		<title>Election Roster</title>
		<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/multiselect.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
		<div class="container box">
			<h1 align="center">Candidates Hub</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<!-- <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add New Recipient</button> -->
					<a id="add_button" data-toggle="modal" data-target="#userModal" href="#"><img src="img/add-item.png" width="40" height="40"> Add Candidate</a>
					&nbsp; &nbsp; &nbsp;
					<a data-toggle="modal" data-target="#voteModal" href="#"><img src="img/check.png" width="50" height="50"> Vote Here!</a>&nbsp;
					&nbsp;
					&nbsp;
					<a href="results.php"><img src="img/result.png" width="40" height="40"> View Results</a>&nbsp;
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="35%">First Name</th>
							<th width="35%">Middle Name</th>
							<th width="35%">Last Name</th>
							<th width="10%">Edit</th>
							<th width="10%">Vote Table</th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>


<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">
					<label>First Name</label>
					<input type="text" name="fname" id="fname" class="form-control" />
					<br />
					<label>Middle Name</label>
					<input type="text" name="mname" id="mname" class="form-control" />
					<br />
					<label>Last Name</label>
					<input type="text" name="lname" id="lname" class="form-control" />
					<br />
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

 <div class="modal fade" id="voteModal" role="dialog">
				    <div class="modal-dialog modal-sm">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Check only 13 candidates</h4>
				        </div>
				        <div class="modal-body">
				          <div class="multiselect form-control">
				          <form  method="POST" action="vote.php">
				          <?php foreach($candidates as $can) {?>
				           <input type="checkbox" id="check" name="candidates[]" value="<?php echo $can['ID'];?>" onchange="checkboxes()">
				           <?php echo $can['Fullname'].'<br />';?>
				           <?php }?> 
				          </div>
				          <div id="error"></div>
				        </div>
				        <div class="modal-footer">
				        <center>
				         <input type="submit" name="vote" class="btn btn-success" value="Vote" />
				         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				         </center>
				         </form>
				        </div>
				      </div>
				    </div>
				  </div> <!-- End of Modal -->
	</body>
</html>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add User");
		$('#action').val("Add");
		$('#operation').val("Add");
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":true,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var firstName = $('#fname').val();
		var middleName = $('#mname').val();
		var lastName = $('#lname').val();
		if(firstName != '' && middleName != '' && lastName != '')
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Both Fields are Required");
		}
	});
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#fname').val(data.fname);
				$('#mname').val(data.mname);
				$('#lname').val(data.lname);
				$('.modal-title').text("Edit User");
				$('#user_id').val(user_id);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
function checkboxes()
{
    
    var count = document.querySelectorAll('input[type="checkbox"]:checked').length
    if(count >= 13){
    	$('#error').text("You already chosen 13 candidates. Please click vote button!");
    }
    else{
    	$('#error').text(document.querySelectorAll('input[type="checkbox"]:checked').length + " " +"Votes");
    }
}
</script>
