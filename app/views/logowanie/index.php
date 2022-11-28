<?php include "header.php"; ?>

    <h1>logowanie</h1>



    <form method="post" action="/si-project-php/public/logowanie/index/">
			login: <input type="text" name="login" /></br> <br/>
            hasło: <input type="text" name="haslo" /></br> <br/>
			<input type="submit" value="Zaloguj">
	</form>

	<?php
        
		if(isset($_POST['login']))
		{
			if($_POST['login'] != "")
			{
				echo 'login: ';
				echo $data['login'];
				echo " <br/>";
			}
		}

		
		if(isset($_POST['haslo']))
		{
			if($_POST['haslo'] != "")
			{
				echo 'hasło: ';
				echo $data['haslo'];
				echo " <br/>";
			}
		}
		
	?>



<?php include dirname(__FILE__,2) . "/footer.php"; ?>