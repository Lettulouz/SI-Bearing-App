<?php include "header.php"; ?>

    <h1>logowanie</h1>

        <?php
			if(isset($_POST['Login']))
				$Login= $_POST['Login'];
			else $Login='wartosc domyslna';
		?>

        <?php
			if(isset($_POST['Hasło']))
				$Hasło= $_POST['Hasło'];
			else $Hasło='wartosc domyslna';
		?>


    <form method="post" action="index.php">
			<input type="text" name="Login" value="<?php echo $Login;?>"></br>
            <input type="text" name="Hasło" value="<?php echo $Hasło;?>"></br>
			<input type="submit" value="Zaloguj">
		</form>


<?php include dirname(__FILE__,2) . "/footer.php"; ?>