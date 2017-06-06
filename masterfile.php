<?php
  include('db.php');
  $candidates = candidates();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Master Table</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
</head>
<body>

<div class="container">
   <h2>Candidates Table</h2>
  <p>If the party already submitted the requirements, you, the admin, can add the candidates to the vote table</p>          
  <table class="table table-condensed" id="example">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Position</th>
        <th>Partylist</th>
        <th>Email</th>
        <th>Birthdate</th>
        <th>Address</th>
        <th>Add to Vote Table</th>
        <th>Delete from Vote Table</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($candidates as $can){?>
        <tr>
          <td><?php echo $can['fname'];?></td>
          <td><?php echo $can['lname'];?></td>
          <td><?php $pos = findPosition($can['pos_id']); echo $pos;?></td>
          <td><?php $party = findParty($can['party_id']); echo $party;?></td>
          <td><?php echo $can['email'];?></td>
          <td><?php echo $can['bday'];?></td>
          <td><?php echo $can['address'];?></td>
          <td><a href="insert.php?candid=<?php echo $can['cand_id'];?>&posid=<?php echo $can['pos_id'];?>&partyid=<?php echo $can['party_id'];?>" class="btn btn-warning">+</a></td>
          <td><a href="delete.php?candid=<?php echo $can['cand_id'];?>" class="btn btn-danger">-</a></td>
       </tr>
       <?php }?>
    </tbody>
  </table>
</div>

</body>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</html>
