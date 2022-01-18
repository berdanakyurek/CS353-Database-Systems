<?php
$conn = new mysqli("dijkstra.cs.bilkent.edu.tr:3306", "berdan.akyurek", "pqsah83r", "berdan_akyurek");
$cid = $_GET['cd'];
$sid = $_GET['sd'];

$q = "INSERT INTO apply(sid, cid) VALUES($sid, '$cid')";
//echo $q;
$ress = mysqli_query($conn, $q);

$q = "SELECT quota FROM company WHERE cid = '$cid' ";
$ress = mysqli_query($conn, $q);
$row = mysqli_fetch_array($ress);
$qt = $row['quota'];
$qt = $qt + 1;
echo $qt;

$q = "UPDATE company SET quota = $qt WHERE cid = '$cid'";

header("Location: studentmain.php");

?>