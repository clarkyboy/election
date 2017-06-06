<?php
  $page = $_SERVER['PHP_SELF'];
  $sec = "10";
  include('db.php');
  $results = rankvotes();
  $votes = sumvotes();
  $rank = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Result of Votes</title>
  <meta charset="utf-8">
   <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron" style="padding: 10px;">
    <h1>Welcome to Election Simulation</h1>      
    <p>Results of the November 2017 Elections</p>
</div>
<div class="container" style="padding: 10px;">
  <p>Total Votes Casted:  <b><?php echo $votes;?> votes</b> Reset votes? <a href="reset.php?status=1">Click Here</a></p>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Rank</th>
        <th>Name</th>
        <th>Position</th>
        <th>Partylist</th>
         <th>Votes Garnered</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($results as $res){?>
    <?php if($res['Vote'] != 0 ){?>
     <tr>
        <td><?php echo ++$rank;?></td>
       <td><?php echo $res['Name']?></td>
       <td><?php echo $res['Position']?></td>
       <td><?php echo $res['Partylist']?></td>
       <td><?php echo $res['Vote']?></td>
     </tr>
     <?php}else{?>
     <?php }}?>
    </tbody>
  </table>
</div>

</body>
</html>
