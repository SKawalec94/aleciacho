<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="LoginPopUpWindow" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    <div class="modal-body">
		        <div class="login-pop">
                    <form id="pwdrstform" method="post">
                        <label for="e-mail">Podaj swój adres e-mail:</label>
                        <input type="text" class="form-control" name="e-mail" placeholder="Adres email">
                        <input type="submit" class="form-control click pink" style="margin-top: 20px;" value="Zresetuj hasło">
                        <button id="pwdrstcancel" class="form-control click">Anuluj</button>
                    </form>
		       		<form id="logowanie" method="POST">
                        <label for="user">Login:</label>
		       			<input type="text" name="user" class="form-control">
                        <label for="password">Hasło:</label>
		                <input type="password" name="password" class="form-control">
		                <input type="hidden" name="log" value="1">
                        <input type="submit" class="form-control click pink" style="margin-top: 20px;" value="Zaloguj się">
                        <a href=<?php echo $domain; ?>"rejestracja/">Utwórz konto</a><a id="pwdrst" href="#">Nie pamiętasz hasła?</a>
		            </form>
		        </div>
		    </div>  
		</div>
	</div>
</div>

<div id="myNav" class="overlay">
	<div class="overlay-content">
        <div class="flex-container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <?php
                    if(!(isset($_SESSION['log_state']))) $_SESSION['log_state'] = 0;
                    switch ($_SESSION['log_state'])
                    {
                        case 1:
                            echo '
                                <div class="mob-cats">
                                    <a href="'.$domain.'konto">Moje konto</a>
                                    <a href="'.$domain.'koszyk">Koszyk</a>
                                </div>
                                <form id="wylogowanie_mobilne" method="POST">
                                    <input type="hidden" name="log" value="0">
                                    <input type="submit" class="form-control click" value="Wyloguj">
                                </form>';
                            break;

                        case 0:
                            echo '<form id="mpwdrstform" method="post">
                                <label for="e-mail">Podaj swój adres e-mail:</label>
                                <input type="text" class="form-control" name="e-mail" placeholder="Adres email">
                                <input type="submit" class="form-control click" style="margin-top: 0.75rem;margin-bottom: 0.5rem;" value="Zresetuj hasło">
                                <button id="mpwdrstcancel" class="form-control click">Anuluj</button>
                            </form>
                            <form id="logowanie_mobilne" method="post">
                                <input type="text" class="form-control" name="user" placeholder="login">
                                <input type="password" class="form-control" name="password" placeholder="hasło">
                                <input type="hidden" name="log" value="1">
                                <input type="submit" class="form-control" value="Zaloguj się" style="margin-top: 0.75rem; margin-bottom: 0.5rem;">
                                <input type="button" id="rejestruj-mob" class="form-control" name="rejestracja" value="Utwórz konto">
                              </form>
                              <a id="mpwdrst" href="#">Nie pamiętasz hasła?</a>';
                            break;
                    }
                    ?>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
        <hr style="margin-top: 1em; margin-bottom: 1em;">
        <div class="mob-cats">
            <a href=<?php echo $domain; ?>"?cat=ciasta">Ciasta</a>
            <a href=<?php echo $domain; ?>"?cat=ciastka">Ciastka</a>
            <a href=<?php echo $domain; ?>"?cat=babeczki">Babeczki</a>
            <a href=<?php echo $domain; ?>"?cat=torty">Torty</a>
        </div>
	</div>
</div>

<nav class="navbar navbar-expand navbar-dark">
    <div class="collapse navbar-collapse justify-content-around" id="navbar">
        <a id="navlogo" class="navbar-nav navbar-brand" href="https://aleciacho.eu/">
            <img id="ikonka" src=<?php echo $domain; ?>"ikony/cupcake3.png" alt="Logo">AleCiacho!
        </a>

        <div id="kategorie" class="navbar-nav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-large nav-cat" href=<?php echo $domain; ?>"?cat=ciasta">Ciasta</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-large nav-cat" href=<?php echo $domain; ?>"?cat=ciastka">Ciastka</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-large nav-cat" href=<?php echo $domain; ?>"?cat=babeczki">Babeczki</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-large nav-cat" href=<?php echo $domain; ?>"?cat=torty">Torty</a>
                </li>
            </ul>
        </div>

        <div id="user-area" class="navbar-nav">
            <li class="nav-item">
<?php

			switch ($_SESSION['log_state'])
			{
				case 1:
					echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Witaj, '.$_SESSION["username"].'</a>
			            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                        if(!($admin)) echo '<a class="dropdown-item form-control" href="'.$domain.'konto">Moje konto</a>';
                    else echo '<a class="dropdown-item form-control" href="'.$domain.'admin">Panel administratora</a>';
                    echo '
			                <a class="dropdown-item form-control" href="'.$domain.'koszyk">Koszyk</a>
			                <form id="wylogowanie" method="POST">
			                    <a id="logout" class="dropdown-item click">
			                    <input type="hidden" name="log" value="0">Wyloguj się</a>
			                </form>
			            </div>';
					break;
				
				case 0:
					echo '<a class="btn btn-large nav-cat" data-toggle="modal" data-target="#loginModal" style="color: white;">
							<i class="fas">&#xf2bd;</i> Zaloguj się</a>';
					break;
			}

?>

			</li>
        </div>
        <div id="submenu" style="display: none;" class="navbar-nav">
            <button class="hamburger hamburger--elastic" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function () {
        <?php if($admin) echo "$('.dropdown-menu').css('margin-left', '-40px');"; ?>

        $('#pwdrstform').hide();
        $('#mpwdrstform').hide();

        $('#pwdrst').click(function(){
            $('#logowanie').fadeOut('slow', function(){
                $(this).hide();
                $('#pwdrstform').fadeIn('slow', function(){
                    $(this).show();
                });
            });
        });

        $('#mpwdrst').click(function(){
            $('#logowanie_mobilne').fadeOut('slow', function(){
                $(this).hide();
                $('#mpwdrstform').fadeIn('slow', function(){
                    $(this).show();
                });
            });
        });

        $('#pwdrstcancel').click(function(e){
        	e.preventDefault();
            $('#pwdrstform').fadeOut('slow', function(){
                $(this).hide();
                $('#logowanie').fadeIn('slow', function(){
                    $(this).show();
                });
            });
        });

        $('#mpwdrstcancel').click(function(e){
            e.preventDefault();
            $('#mpwdrstform').fadeOut('slow', function(){
                $(this).hide();
                $('#logowanie_mobilne').fadeIn('slow', function(){
                    $(this).show();
                });
            });
        });

        $('#pwdrstform').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo $domain; ?>forgotpwd.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
            }).done(function(match){
            	if(match==0) $('#pwdrstform').before('<span>Użytkownik z podanym adresem email nie istnieje.</span>');
            	else if(match==1) $('#pwdrstform').before('<span style="color: green;">Na podany adres email wysłano link do zresetowania hasła.</span>');
            });
        });

        $('#mpwdrstform').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: 'https://aleciacho.eu/forgotpwd.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
            }).done(function(match){
                if(match==0) $('#mpwdrstform').before('<span>Użytkownik z podanym adresem email nie istnieje.</span>');
                else if(match==1) $('#mpwdrstform').before('<span style="color: green;">Na podany adres email wysłano link do zresetowania hasła.</span>');
            });
        });


        $('form#logowanie').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo $domain; ?>login.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                //success: function () {
                //    location.reload(true);
                //}
            }).done(function(denied){
                if(denied==1) $('#logowanie').before('<span>Podano nieprawidłowy login lub hasło.</span>');
                if(denied==0) location.reload(true);
            });
        });

        $('form#logowanie_mobilne').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo $domain; ?>login.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    location.reload(true);
                }
            });
        });

        $('a#logout').click(function () {
            $(this).trigger('submit');
        })

        $('form#wylogowanie').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo $domain; ?>login.php',
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

        $('form#wylogowanie_mobilne').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo $domain; ?>login.php',
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

        if(/Mobi|Android/i.test(navigator.userAgent))
        {
            $('#navbar').removeClass('justify-content-around').addClass('justify-content-between');
            $('#kategorie').css('display', 'none');
            $('#user-area').css('display', 'none');
            $('#submenu').css('display', 'flex');
            $('#login').css('display', 'flex');

            $('#ikonka').css('width', '36px').css('height', '34px').css('top', '-4px').css('left', '4px');
            $('.navbar-brand').css('font-size', '1.4rem');

            $('.koszyk').css('width', '45px').css('height', '45px').css('bottom', '15px').css('right', '10px');
            $('.stan_koszyka').css('width', '24px').css('height', '24px').css('bottom', '46px').css('right', '42px').css('font-size', 'medium');
            $('.admin').css('width', '45px').css('height', '45px').css('bottom', '75px').css('right', '10px');
            $('.moj-koszyk').css('transform', 'translateY(-5px)').css('font-size', '28px');
            $('.moj-admin').css('transform', 'translateY(-5px)').css('font-size', '28px');

            var state = 0;
            var catMenu = 0;
            var logMenu = 0;

            $('.hamburger').click(function(){
                if(state == 1) {
                    $(this).removeClass('is-active');
                    $('#myNav').css('height', '0%');
                    state = 0;
                }
                else {
                    $(this).addClass('is-active');
                    $('#myNav').css('height', 'calc(100% - 35px)').css('margin-top', '38px');
                    state = 1;
                }
            });

            $('#rejestruj-mob').click(function(){
                location.replace("<?php echo $domain; ?>rejestracja/");
            });



        }

        $('#rejestruj').click(function(){
            location.replace("<?php echo $domain; ?>rejestracja/");
        });
    });
</script>