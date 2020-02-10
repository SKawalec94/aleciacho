<?php
include '../session.php';

$login = $_SESSION["username"];
$id_towaru = $_POST["PID"];
$ilosc = $_POST["ilosc"];

$sql = "INSERT INTO Koszyk (login, id_towaru, ilosc) VALUES ('".$login."',".$id_towaru.",".$ilosc.")";
mysqli_query($conn, $sql);

?>