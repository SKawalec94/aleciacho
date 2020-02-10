<?php
    include '../session.php';

    $ilosc = $_POST["ilosc"];
    $id_produktu = $_POST["pid"];
    $user = $_POST["login"];

    $sql = "DELETE FROM Koszyk WHERE (id_towaru =".$id_produktu." AND login ='".$user."');";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>