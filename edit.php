<?php

$serverName = "localhost\D";
$connectionInfo = array( "Database"=>"mydatabase", "UID"=>"sa", "PWD"=>"Fl0901289105");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}
if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
    $sql = "SELECT * FROM customer where CustomerID='$id'";
    $stmt = sqlsrv_query( $conn, $sql );

    if (count($stmt) == 1 ) {
    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
    $id = $row['CustomerID'];
    $name = $row['Name'];
    $email = $row['Email'];
    $code = $row['CountryCode'];
    $budget = $row['Budget'];
    $used = $row['Used'];
  }
}

//*** Add Condition ***//
if($_POST["hdnCmd"] == "Update")
{
	$strSQL = "UPDATE customer SET ";
	$strSQL .="CustomerID = '".$_POST["txtEditCustomerID"]."' ";
	$strSQL .=",Name = '".$_POST["txtEditName"]."' ";
	$strSQL .=",Email = '".$_POST["txtEditEmail"]."' ";
	$strSQL .=",CountryCode = '".$_POST["txtEditCountryCode"]."' ";
	$strSQL .=",Budget = '".$_POST["txtEditBudget"]."' ";
	$strSQL .=",Used = '".$_POST["txtEditUsed"]."' ";
	$strSQL .="WHERE CustomerID = '".$_POST["hdnEditCustomerID"]."' ";
$stmt = sqlsrv_query( $conn, $strSQL);
header("location: show.php");
//exit();
}
?>
<html>
<head>
<title>Edit</title>
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
  <th> CustomerID</th>
	<td>
	<input type="text" name="txtEditCustomerID"  value="<?=$id;?>">
	<input type="hidden" name="hdnEditCustomerID" value="<?=$id;?>">
</td>
</tr>
<tr>
  <th> Name</th>
	<td><input type="text" name="txtEditName" value="<?=$name;?>"></td>
</tr>
<tr>
  <th> Email</th>
	<td><input type="text" name="txtEditEmail" value="<?=$email;?>"></td>
</tr>
<tr>
  <th> CountryCode</th>
	<td><input type="text" name="txtEditCountryCode" value="<?=$code;?>"></td>
</tr>
<tr>
  <th> Budget</th>
		<td><input type="text" name="txtEditBudget" value="<?=$budget;?>"></td>
</tr>
<tr>
  <th> Used</th>
	<td><input type="text" name="txtEditUsed" value="<?=$used;?>"></td>
</tr>
<tr>
	<td colspan="2">
	<input name="btnAdd" type="button" id="btnUpdate" class="btn btn-warning" value="Update" OnClick="frmMain.hdnCmd.value='Update';frmMain.submit();">
	<input name="btnAdd" type="button" id="btnCancel" class="btn btn-danger" value="Cancel" OnClick="window.location='<?=$_SERVER["PHP_SELF"];?>';">
	</td>
  </tr>

</table>
</form>
<?
sqlsrv_free_stmt( $stmt);
?>
</body>
</html>
