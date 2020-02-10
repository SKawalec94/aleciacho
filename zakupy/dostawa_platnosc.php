<?php
include __DIR__ . '/../session.php';

if(isset($_POST['sposobPlatnosciID']))
{
	$platnoscid = $_POST['sposobPlatnosciID'];

	$sql = "SELECT * FROM Platnosc WHERE id = ".$platnoscid;
	mysqli_query($conn,$sql);
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$typ = $row['typ'];
	$typ2 = $row['typ2'];
	$koszt = $row['koszt'];

	$array = array($typ, $typ2, $koszt);
	echo implode(",", $array);
	exit();
} else if(isset($_POST['sposobDostawyID']))
{
	$dostawaid = $_POST['sposobDostawyID'];
	$sql = "SELECT * FROM Dostawa WHERE id = ".$dostawaid;
	mysqli_query($conn,$sql);
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$typ = $row['typ'];
	$koszt = $row['koszt'];

	$array = array($typ, $koszt);
	echo implode(",", $array);
	exit();
}

?>