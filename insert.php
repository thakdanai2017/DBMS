<?php

$serverName = "localhost\D";
$connectionInfo = array( "Database"=>"mydatabase", "UID"=>"sa", "PWD"=>"Fl0901289105");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}
//*** Add Condition ***//
if($_POST["hdnCmd"] == "Add")
{
$sql = "INSERT INTO customer (CustomerID,Name,Email,CountryCode,Budget,Used) VALUES (?, ?, ?, ?, ?,?)";
$CusID = $_POST["txtAddCustomerID"];
$params = array($_POST["txtAddCustomerID"], $_POST["txtAddName"],$_POST["txtAddEmail"],$_POST["txtAddCountryCode"],$_POST["txtAddBudget"],$_POST["txtAddUsed"]);
$stmt = sqlsrv_query( $conn, $sql, $params);

header("location: http://localhost/show.php");
//exit();
}
?>
<html>
<head>
<title>insert</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<form name="frmMain" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
<input type="hidden" name="hdnCmd" value="">
<table class="table table-light">
  <tr>
  <th>CustomerID</th>
  <td><input type="text" name="txtAddCustomerID"></td>
</tr>
<tr>
  <th>Name</th>
  <td><input type="text" name="txtAddName"></td>
</tr>
<tr>
  <th>Email</th>
  <td><input type="text" name="txtAddEmail"></td>
</tr>
<tr>
  <th>CountryCode</th>
  <td><input type="text" name="txtAddCountryCode" ></td>
</tr>
<tr>
  <th>Budget</th>
  <td><input type="text" name="txtAddBudget"></td>
</tr>
<tr>
  <th>Used</th>
  <td><input type="text" name="txtAddUsed"></td>
</tr>
<tr>
  <td colspan="2">
  <input name="btnAdd" type="button" id="btnAdd" class="btn btn-success" value="Add" OnClick="frmMain.hdnCmd.value='Add';frmMain.submit();">
  <input name="btnAdd" type="button" id="btnCancel" class="btn btn-danger" value="Cancel" OnClick="window.location='<?=$_SERVER["PHP_SELF"];?>';">
</tr>







</div></td>
</tr>
</table>
</form>
<?
sqlsrv_free_stmt( $stmt);
?>
</body>
</html>
