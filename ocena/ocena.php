<?php
    include '../session.php';

    $komentarz = $_POST['komentarz'];
    $ocena = $_POST['ocenka'];
    $id_towaru = $_POST['id_towaru'];

    $sql = "INSERT INTO Komentarze (data, komentarz, ocena, id_towaru, login)
    VALUES (NOW(),'".$komentarz."', ".$ocena.", ".$id_towaru.", '".$username."')";
	$result = mysqli_query($conn, $sql);
	
?>