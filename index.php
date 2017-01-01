<?php 
try{
    $dns = "mysql:host=localhost;dbname=network";
        $user = "root";
        $pass = "toor";
        $pdo = new PDO($dns,$user,$pass);
        $pdo->exec("SET CHARSET UTF8");

 $choice = $pdo->query("SELECT * FROM ip_info_comes_user ORDER BY id DESC");
        $row = $choice->fetchAll(PDO::FETCH_CLASS);
        
       
       if (isset($_POST["buton"])) {
       	$sourceip = $_POST["sourceip"];
       $sourceport = $_POST["sourceport"];
       $destinationip = $_POST["destinationip"];	
       $destinationport = $_POST["destinationport"];


       $result = $pdo->query("INSERT INTO ip_info_comes_user(SourceIp,SourcePort,DestinationIp,DestinationPort) VALUES ('$sourceip','$sourceport','$destinationip','$destinationport')");
       $choice = $pdo->query("SELECT * FROM ip_info_comes_user ORDER BY id DESC");
        $row = $choice->fetchAll(PDO::FETCH_CLASS);

       if ($result) {

       	echo "<script>alert('eklendi')</script>";
       }else{
       	echo "<script>alert('Hata!! Eklenmedi')</script>";
       }


       }
       if (isset($_REQUEST["deleteitem"])) {
        $delItem = $_REQUEST["deleteitem"];
         $sil = $pdo->exec("DELETE FROM ip_info_comes_user WHERE id='$delItem'");
         $choice = $pdo->query("SELECT * FROM ip_info_comes_user ORDER BY id DESC");
        $row = $choice->fetchAll(PDO::FETCH_CLASS);

       }
       

}catch(PDOException $e){
echo "Error:".$e.getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Network Security</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>




<div class="container">
  <h2>Blocked Packages</h2>           
  <table class="table table-hover">
    <thead>
      <tr>
        <th>id</th>
        <th>Source Ip</th>
        <th>Source Port</th>
        <th>Destination Ip</th>
        <th>Destination Port</th>
        <th>Operations</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($row as $ro) {
    ?>
      <tr>
        <td><?=$ro->id?></td>
        <td><?=$ro->SourceIp?></td>
        <td><?=$ro->SourcePort?></td>
        <td><?=$ro->DestinationIp?></td>
        <td><?=$ro->DestinationPort?></td>
        <td><a href="index.php?deleteitem=<?=$ro->id?>">
          <span class="glyphicon glyphicon-trash"></span>
        </a> </td>  
      </tr><?php
    }
    ?>
    </tbody>
   <a href="/network/result.php"> <button type="button" class="btn btn-info btn-lg">See Block Packets</button></a>
  </table>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add New Block Packets</button>
</div>


<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Block Packets</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="email">Source IP</label>
            <input type="text" name="sourceip" class="form-control" value="-" id="email" > 
          </div>
          <div class="form-group">
            <label for="pwd">Source Port:</label>
            <input type="text" name="sourceport" class="form-control" value="-" id="pwd" >
          </div>
          <div class="form-group">
            <label for="pwd">Destination IP:</label>
            <input type="text" name="destinationip" class="form-control" value="-" id="pwd" > 
          </div>
          <div class="form-group">
            <label for="pwd">Destination Port:</label>
            <input type="text" name="destinationport" class="form-control" value="-" id="pwd">
          </div>
      </div>
      <div class="modal-footer">
      <button type="submit" name="buton" class="btn btn-default">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>

</body>
</html>

