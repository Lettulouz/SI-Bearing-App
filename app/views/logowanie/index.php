<?php include "header.php"; ?>

    <h1>logowanie</h1>

        <?php
        
        /*
			if(isset($_POST['login']))
				$login= $_POST['login'];
			else $login='';

			if(isset($_POST['haslo']))
				$haslo= $_POST['haslo'];
			else $haslo='';
            <?=$data['message']?>

           */ 
		?>


    <?=$data['login']?>
    <?=$data['haslo']?>


    <form method="post" action="/si-project-php/public/logowanie/test2/.$login.$haslo ">
			login: <input type="text" name="login" /></br> <br/>
            hasło: <input type="text" name="haslo" /></br> <br/>
			<input type="submit" value="Zaloguj">
		</form>


<?php include dirname(__FILE__,2) . "/footer.php"; ?>