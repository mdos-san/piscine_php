<?php
	session_start();
	if ($_GET[login] != "")
		$_SESSION[login] = $_GET[login];
	if ($_GET[passwd] != "")
		$_SESSION[passwd] = $_GET[passwd];
?>
<html><body>
<form method="get" action="index.php">
	Identifiant: <input type="text" name="login" value="<?php echo "$_SESSION[login]"; ?>"/>
	<br/>
	Mot de passe: <input type="text" name="passwd" value="<?php echo "$_SESSION[passwd]"; ?>"/>
	<input type="submit" value="Ok">
</form>
</html></body>
