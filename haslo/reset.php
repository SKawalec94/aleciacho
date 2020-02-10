<?php
	include '../session.php';

	$haslo = mysqli_real_escape_string($conn, $_POST["haslo1"]);
	$pwd = password_hash($haslo, PASSWORD_DEFAULT);
	$token = $_SESSION['token'];

	$sql = "UPDATE Userzy SET haslo = '".$pwd."' WHERE token = '".$token."';";
	$result = mysqli_query($conn, $sql);

	$sql = "SELECT Klienci.email, Userzy.login FROM Klienci JOIN Userzy ON Klienci.login = Userzy.login WHERE Userzy.token = '".$token."';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$email = $row['email'];
	$login = $row['login'];

	$sql = "UPDATE Userzy SET token = NULL WHERE login = '".$login."';";
	$result = mysqli_query($conn, $sql);

	$subject = "aleciacho - dokonano zmiany hasła";
	$text = "
	<html>
	<head>
	<title>aleciacho - dokonano zmiany hasła</title>
	<style>
	.centered {
		text-align: center;
	}
	</style>
	</head>
	<body>
	<div class='centered'>
	<h2>Twoje hasło na aleciacho.eu zostało zmienione o czasie serwera: ".date('Y-m-d H:i:s').".</h2>
	</div>
	</body>
	</html>";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: <aleciacho.eu>" . "\r\n";

	mail("$email", "$subject", "$text", "$headers");

	$_SESSION["username"] = $login;
    $username = $_SESSION["username"];

    $sql = "SELECT imie FROM Klienci WHERE login='".$login."';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $_SESSION["imie"] = $row["imie"];

    $_SESSION["log_state"] = 1;
    if($username != 'admin') $_SESSION['admin'] = 0;
    else $_SESSION['admin'] = 1;

?>