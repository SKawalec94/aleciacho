<?php
    include __DIR__ . '/../session.php';

    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $adres = $_POST['adres'];
    $kodpocztowy = $_POST['kodpocztowy'];
    $miasto = $_POST['miasto'];
    $telefon = $_POST['telefon'];

    $sql = "UPDATE Klienci SET nazwisko='".$nazwisko."', imie='".$imie."', adres='".$adres."', kodpocztowy='".$kodpocztowy."', miasto='".$miasto."', telefon='".$telefon."' WHERE login='".$_SESSION['username']."'";
    mysqli_query($conn, $sql);

    mysqli_close($conn);
?>