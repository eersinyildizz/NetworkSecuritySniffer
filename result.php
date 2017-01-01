<?php 
Header("Refresh: 1;");

try{
    $dns = "mysql:host=localhost;dbname=network";
        $user = "root";
        $pass = "toor";
        $pdo = new PDO($dns,$user,$pass);
        $pdo->exec("SET CHARSET UTF8");

$choice = $pdo->query("SELECT * FROM ip_info ORDER BY id DESC");
$row = $choice->fetchAll(PDO::FETCH_CLASS);


       

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
  <h2>Blocked Packet List</h2>           
  <table class="table table-hover">
     <a href="/network/index.php"> <button type="button" class="btn btn-info btn-lg">Add New Block Packets</button></a>
    <thead>
      <tr>
        <th>id</th>
        <th>Source Ip</th>
        <th>Source Port</th>
        <th>Destination Ip</th>
        <th>Destination Port</th>
        <th>Time</th>
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
        <td><?=$ro->CreatedTime?></td>	
      </tr><?php
    }
    ?>
    </tbody>
  </table>
</div>

</body>
</html>
