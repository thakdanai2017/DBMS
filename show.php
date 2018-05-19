<?php
$serverName = "localhost\D";
$connectionInfo = array( "Database"=>"mydatabase", "UID"=>"sa", "PWD"=>"Fl0901289105");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

if($_GET["Action"] == "Del")
{
$strSQL = "DELETE FROM customer ";
$strSQL .="WHERE CustomerID = '".$_GET["CusID"]."' ";
$stmt = sqlsrv_query( $conn, $strSQL);
//header("location:$_SERVER[PHP_SELF]");
//exit();
}

$sql = "SELECT * FROM customer ";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}
?>
<html>
<head>
<title>Home</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>

  <center><a class="btn btn-success" href="http://localhost/insert.php">เพิ่มลูกค้า</a></center>
  <div class="container">
<table class="table table-light">
  <tr>
  <th> <div align="center">CustomerID </div></th>
  <th> <div align="center">Name </div></th>
  <th> <div align="center">Email </div></th>
  <th> <div align="center">CountryCode </div></th>
  <th> <div align="center">Budget </div></th>
  <th> <div align="center">Used </div></th>
  <th colspan="2"> <div align="center">Operation </div></th>
</tr>
<?php
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
?>
<tr>
<td > <div align="center"><?php echo $row['CustomerID'];?></div></td>
<td > <div align="center"><?php echo $row['Name'];?></div></td>
<td > <div align="center"><?php echo $row['Email'];?> </div></td>
<td > <div align="center"><?php echo $row['CountryCode'];?> </div></td>
<td > <div align="center"><?php echo $row['Budget'];?> </div></td>
<td > <div align="center"><?php echo $row['Used'];?> </div></td>
<td > <div align="center"><a class="btn btn-warning" href="edit.php?edit=<?php echo $row['CustomerID']; ?>">Edit</a></div></td>
<td align="center"><a class="btn btn-danger" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?Action=Del&CusID=<?=$row["CustomerID"];?>';}">Delete</a></td>
</tr>
<?php }

sqlsrv_free_stmt( $stmt);
?>
</body>
</html>
