<?php
  include('db.php');
  $candidates = candidate();
  $count = 0;
    if(isset($_POST['vote'])){
      if(isset($_POST['President'])){
        $president = $_POST['President'];
        vote($president);
        $count++;
      }if(isset($_POST['VPI'])){
        $vice_i = $_POST['VPI'];
        vote($vice_i);
        $count++;
      }if(isset($_POST['VPE'])){
        $vice_e = $_POST['VPE'];
        vote($vice_e);
        $count++;
      }if(isset($_POST['Sec'])){
        $sec = $_POST['Sec'];
        vote($sec);
        $count++;
      }if($_POST['TI']){
        $internal = $_POST['TI'];
        vote($internal);
        $count++;
      }if($_POST['TE']){
        $external = $_POST['TE'];
        vote($external);
        $count++;
      }if($_POST['Au']){
        $au = $_POST['Au'];
        vote($au);
        $count++;
      }if($_POST['PI']){
        $internal = $_POST['PI'];
        vote($internal);
        $count++;
      }if($_POST['PE']){
        $external = $_POST['PE'];
        vote($external);
        $count++;
      }else{
       echo '<script type="text/javascript">alert("No Entry")</script>';
    }
      echo '<script type="text/javascript">alert("' . $count . ' positions are filled and votes are casted")</script>';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Vote Now!</title>
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
<div class="jumbotron" style="padding: 10px;">
    <h1>Welcome to Election Simulation</h1>      
    <p>Chill, this is just a practice! Vote here!</p>
</div>
<div class="container" style="padding: 10px;">
<h4> Choose Wisely!</h4> 
<table class="table table-condensed">
  <form method="POST" class="form-group">
  <thead>
    <th>Position</th>
    <th>Democrats Partylist</th>
    <th>Republicans Partylist</th>
  </thead>
    <tbody>
      <tr>
        <td>President</td>
          <?php foreach($candidates as $can ){?>
           <?php if($can['pos_id'] == 1){?>
           <td><input type="radio" name="President" value="<?php echo $can['cand_id'];?>"><?php $name = findCandidate($can['cand_id']); echo $name;?></td>
          <?php }}?>
      </tr>
      <tr>
        <td>Vice President Internal</td>
          <?php foreach($candidates as $can ){?>
           <?php if($can['pos_id'] == 2){?>
           <td><input type="radio" name="VPI" value="<?php echo $can['cand_id'];?>"><?php $name = findCandidate($can['cand_id']); echo $name;?></td>
          <?php }}?>
      </tr>
      <tr>
        <td>Vice President External</td>
          <?php foreach($candidates as $can ){?>
           <?php if($can['pos_id'] == 3){?>
           <td><input type="radio" name="VPE" value="<?php echo $can['cand_id'];?>"><?php $name = findCandidate($can['cand_id']); echo $name;?></td>
          <?php }}?>
      </tr>
      <tr>
        <td>Secretary</td>
          <?php foreach($candidates as $can ){?>
           <?php if($can['pos_id'] == 4){?>
           <td><input type="radio" name="Sec" value="<?php echo $can['cand_id'];?>"><?php $name = findCandidate($can['cand_id']); echo $name;?></td>
          <?php }}?>
      </tr>
      <tr>
        <td>Treasurer Internal</td>
          <?php foreach($candidates as $can ){?>
           <?php if($can['pos_id'] == 5){?>
           <td><input type="radio" name="TI" value="<?php echo $can['cand_id'];?>"><?php $name = findCandidate($can['cand_id']); echo $name;?></td>
          <?php }}?>
      </tr>
       <tr>
        <td>Treasurer External</td>
          <?php foreach($candidates as $can ){?>
           <?php if($can['pos_id'] == 6){?>
           <td><input type="radio" name="TE" value="<?php echo $can['cand_id'];?>"><?php $name = findCandidate($can['cand_id']); echo $name;?></td>
          <?php }}?>
      </tr>
       <tr>
        <td>Auditor</td>
          <?php foreach($candidates as $can ){?>
           <?php if($can['pos_id'] == 7){?>
           <td><input type="radio" name="Au" value="<?php echo $can['cand_id'];?>"><?php $name = findCandidate($can['cand_id']); echo $name;?></td>
          <?php }}?>
      </tr>
      <tr>
        <td>PRO Internal</td>
          <?php foreach($candidates as $can ){?>
           <?php if($can['pos_id'] == 8){?>
           <td><input type="radio" name="PI" value="<?php echo $can['cand_id'];?>"><?php $name = findCandidate($can['cand_id']); echo $name;?></td>
          <?php }}?>
      </tr>
      <tr>
        <td>PRO External</td>
          <?php foreach($candidates as $can ){?>
           <?php if($can['pos_id'] == 9){?>
           <td><input type="radio" name="PE" value="<?php echo $can['cand_id'];?>"><?php $name = findCandidate($can['cand_id']); echo $name;?></td>
          <?php }}?>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><input type="submit" name="vote" class="btn btn-danger" value="Vote">
            <a href="results.php" class="btn btn-info">Results</a>
        </td>
      </tr>
    </tbody>
  </form>
</table>
</div>
</body>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</html>
