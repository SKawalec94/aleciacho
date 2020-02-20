<?php
    if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
        exit;
    }

	session_start();

    define('DB_SERVER', 'eu-cdbr-west-02.cleardb.net');
    define('DB_USERNAME', 'bd94273cab1fb9');
    define('DB_PASSWORD', '4f5dc87b');
    define('DB_DATABASE', 'heroku_beef761ec3e9daa');
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    mysqli_set_charset($conn,"utf8");

	if(!(isset($_SESSION['username'])))
	    $_SESSION['username'] = "";

	$username = $_SESSION['username'];
	if($username != 'admin') $admin = 0;
	else $admin = 1;

	if($_SESSION['username'] == "") {
	    $_SESSION['log_state'] = 0;
	    $_SESSION['suma_koszyka'] = 0;
    }
	else {
	    $_SESSION['log_state'] = 1;
    }

	if($_SESSION['username'] != "") {
        $sql = "SELECT SUM(ilosc) AS suma_koszyka FROM Koszyk WHERE login='".$username."'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $_SESSION['suma_koszyka'] = $row['suma_koszyka'];
    } else {
        $_SESSION['suma_koszyka'] = 0;
    }
?>