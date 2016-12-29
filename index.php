<?php 
try{
    $dns = "mysql:host=localhost;dbname=network";
        $user = "root";
        $pass = "toor";
        $pdo = new PDO($dns,$user,$pass);
        $pdo->exec("SET CHARSET UTF8");

       
       if (isset($_POST["buton"])) {
       	$sourceip = $_POST["sourceip"];
       $sourceport = $_POST["sourceport"];
       $destinationip = $_POST["destinationip"];	
       $destinationport = $_POST["destinationport"];


       $result = $pdo->query("INSERT INTO ip_info_comes_user(SourceIp,SourcePort,DestinationIp,DestinationPort) VALUES ('$sourceip','$sourceport','$destinationip','$destinationport')");
       if ($result) {
       	echo "<script>alert('eklendi')</script>";
       }else{
       	echo "<script>alert('Hata!! Eklenmedi')</script>";
       }
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
  <h2>Engellemek istediğiniz paketleri giriniz.</h2>
  <form method="post" action="">
  <div class="form-group">
    <label for="email">Source IP</label>
    <input type="text" name="sourceip" class="form-control" id="email" > 
  </div>
  <div class="form-group">
    <label for="pwd">Source Port:</label>
    <input type="text" name="sourceport" class="form-control" id="pwd" >
  </div>
  <div class="form-group">
    <label for="pwd">Destination IP:</label>
    <input type="text" name="destinationip" class="form-control" id="pwd" >
  </div>
  <div class="form-group">
    <label for="pwd">Destination Port:</label>
    <input type="text" name="destinationport" class="form-control" id="pwd">
  </div>
  
  <button type="submit" name="buton" class="btn btn-default">Save</button>
</form>
</div>

</body>
</html>

