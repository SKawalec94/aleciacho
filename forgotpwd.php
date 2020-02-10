<?php 
include('session.php');

$email = $_POST['e-mail'];

$sql = "SELECT * FROM Klienci WHERE email = '".$email."';";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) >= 1) {
	$match = 1;
	echo $match;

	$row = mysqli_fetch_assoc($result);
	$login = $row['login'];

	$token = bin2hex(random_bytes(50));

	$sql = "UPDATE Userzy SET token = '".$token."' WHERE login = '".$login."';";
	$result = mysqli_query($conn, $sql);

	$subject = "aleciacho - resetowanie hasła";
	$text = "
	<html>
	<head>
	<title>aleciacho - resetowanie hasła</title>
	<style>
	.centered {
		text-align: center;
	}
	#token {
		border: 1px solid #FF63B1;
    	padding: 16px;
    	color: white !important;
    	background: #FF63B1;
    	text-decoration: none;
    	position: relative;
    	bottom: 20px;
    	margin-top: 20px;
    	display: inline-block;
	}
	a:link, a:visited, a:hover, a:active {
		color: white;
		text-decoration: none;
	}
	a:hover {
		background: #f73d9a;
	}
	</style>
	</head>
	<body>
	<div class='centered'>
	<h2>Aby zresetować swoje hasło na aleciacho.eu, kliknij poniższy przycisk.</h2>
	<a id='token' href='".$domain."haslo/?token=".$token."'>Zresetuj hasło</a>
	</div>
	</body>
	</html>";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: <aleciacho.eu>" . "\r\n";

	mail("$email", "$subject", "$text", "$headers");
} else {
	$match = 0;
	echo $match;
}

?>