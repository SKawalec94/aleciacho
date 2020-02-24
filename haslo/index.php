<?php
    include '../session.php';
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
            <li class="breadcrumb-item"><a href="<?php echo $domain; ?>">Strona główna</a></li>
            <li class="breadcrumb-item active">Resetowanie hasła</li>
        </ol>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <div class="col-12 col-md-10 col-lg-8">
            <div class="register-panel">
                <form id="resetuj_haslo" method="POST">
                    <h2>Wpisz nowe hasło do swojego konta</h2>
                    <div class="pudelko">
                        <label for="haslo1">Wpisz nowe hasło:</label>
                        <input id="haslo1" class="form-control" type="password" name="haslo1" required>
                        <label for="haslo2">Powtórz hasło:</label>
                        <input id="haslo2" class="form-control" type="password" name="haslo2" required>
                        <label id="zle"></label></p>
                    </div>
                    <div class="pudelko">
                        <input class="form-control pink click" type="submit" name="resetuj" value="Potwierdź">
                        <?php $_SESSION['token'] = $_GET['token']; ?>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-1 col-lg-2"></div>
    </div>
</div>
<?php

require_once('../footer.php');

?>

<script>
$(document).ready(function (){

    $('#resetuj_haslo').submit(function(event) {
        if($('#haslo2').val() != $('#haslo1').val())
        {
            $('#haslo1').val("");
            $('#haslo2').val("");
            $('#zle').text("Hasła nie są ze sobą zgodne!").css("color", "red");
            event.preventDefault();
        }

        event.preventDefault();
        $.ajax({
                url: 'reset.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    location.replace('<?php echo $domain; ?>');
                }
            });
    });

});

</script>
</body>
</html>
