<?php
	include __DIR__ . '/../session.php';

    if($_SESSION['log_state'] == 1){
        header('Location: https://aleciacho.eu/');
        exit();
    }

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$haslo = mysqli_real_escape_string($conn, $_POST["haslo1"]);
	$login = mysqli_real_escape_string($conn, $_POST["login"]);
	$email = $_POST["email"];

    $pwd = password_hash($haslo, PASSWORD_DEFAULT);

    $sql0 = "SELECT login FROM Userzy WHERE login = '".$login."'";
    $result = mysqli_query($conn, $sql0);
    if(mysqli_num_rows($result) >= 1){
        ?>
            <script>alert("Podana nazwa użytkownika jest zajęta, wybierz inną.");</script>
        <?php
    } else {
        $sql = "INSERT INTO Userzy (login, haslo) VALUES ('".$login."','".$pwd."');";
        $sql .= "INSERT INTO Klienci (email, login) VALUES ('".$email."', '".$login."');";

        mysqli_multi_query($conn, $sql);

        mysqli_close($conn);

        $subject = "Witamy w aleciacho!";
		$text = "
		<html>
		<head>
		<title>Witamy w aleciacho!</title>
		<style>
		.centered {
			text-align: center;
		}
		</style>
		</head>
		<body>
		<div class='centered'>
		<h1>Cześć, ".$login."!</h1>
		<p>Witamy w naszej słodkiej społeczności i życzymy pysznych wrażeń! :)</p> 
		</div>
		</body>
		</html>";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: <aleciacho.eu>" . "\r\n";

		mail("$email", "$subject", "$text", "$headers");

        $_SESSION["username"] = $login;
        $_SESSION["imie"] = $imie;
        $_SESSION["log_state"] = 1;
        header('Location: ../index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pl-PL">
<?php
    require_once __DIR__ . '/../head.php';
?>
<body>

<?php
    require_once __DIR__ . '/../navbar.php';
?>

<div class="row okruszki">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="https://aleciacho.eu/">Strona główna</a></li>
            <li class="breadcrumb-item active">Rejestracja</li>
        </ol>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <div class="col-12 col-md-10 col-lg-8">
            <div class="row">
                <div class="col-md-1 col-lg-2"></div>
                <div class="register-panel col-12 col-md-10 col-lg-8">
                    <form id="rejestracja" method="POST">
                        <h2>Zarejestruj się na AleCiacho.eu</h2>
                        <div class="pudelko">
                            <label for="login">Login:</label>
                            <input class="form-control" type="text" name="login" required>
                        </div>
                        <div class="pudelko">
                            <label for="haslo1">Hasło:</label>
                            <input class="form-control" id="haslo1" type="password" name="haslo1" required>
                            <label for="haslo2">Powtórz hasło:</label>
                            <input class="form-control" id="haslo2" type="password" name="haslo2" required>
                            <span id="zle"></span>
                        </div>
                        <div class="pudelko">
                            <label for="email">Adres e-mail:</label>
                            <input class="form-control" type="text" name="email" required>
                        </div>
                        <div class="pudelko">
                            <input class="form-control pink click" type="submit" name="zarejestruj" value="Utwórz konto">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-lg-2"></div>
    </div>
</div>

<script>
$(document).ready(function (){

    $('#rejestracja').submit(function(event) {
    if($('#haslo2').val() != $('#haslo1').val())
    {
        $('#haslo1').val("");
        $('#haslo2').val("");
        $('#zle').text("Hasła nie są ze sobą zgodne!").css("color", "red");
        event.preventDefault();
    }
    });

});

</script>

<?php

require_once('../footer.php');

?>
</body>
</html>
