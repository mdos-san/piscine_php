<?php
session_start();
include_once("function.php");
if ($_SESSION['account'] !== NULL)
{
	?>
	<div class='cadre'>
		<div class='member' style="width:20%;">
			<a href="index.php?page=account">Modifier compte</a><br />
			<a href="index.php?page=account&account=historique">Historique</a><br />
			<a href="index.php?page=account&account=delete">Supprimer compte</a><br />
			<?php echo $_SESSION["login_delete_msg"]; ?>
		</div>
		<div class='member' style="width:75.5%;">
			<?php
			$tab = db_get("users/".$_SESSION['account'])[$_SESSION['account']];
			if ($_GET['account'] == 'historique')
			{
				echo "<span class='title'>En Attente:</span><br />";
				$achat = db_get("datas/achats");
				if ($achat)
					foreach ($achat as $key => $value)
					{
						if($value['name'] == $_SESSION['account'] && $value["valider"] == 0)
						{
							$count = 0;
							foreach ($value['panier'] as $key2 => $value2) {
								$count += $value2;
							}
							if ($count > 1)
								echo $count." articles commandé le ".date("d/m/Y à H:i", $value['time'])."<br />";
							else
								echo $count." article commandé le ".date("d/m/Y à H:i", $value['time'])."<br />";
						}
					}
				echo "<hr style='width:90%' />";
				echo "<span class='title'>Historique:</span><br />";
				if ($achat)
					foreach ($achat as $key => $value)
					{
						if($value['name'] == $_SESSION['account'] && $value["valider"] == 1)
						{
							$count = 0;
							foreach ($value['panier'] as $key2 => $value2) {
								$count += $value2;
							}
							if ($count > 1)
								echo $count." articles commandé le ".date("d/m/Y à H:i", $value['time'])."<br />";
							else
								echo $count." article commandé le ".date("d/m/Y à H:i", $value['time'])."<br />";
						}
					}
			}
			else
			{
				?>
				<span class='title'>Modifier Client</span><br />
				<form method="post" action="index.php?page=account" style="padding-left:7px">
					<span class="font-weight: bold;">Ancien Mot de passe:</span><br />
					<input type="password" name="oldpwd" value="" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
					<span class="font-weight: bold;">Nouveau mot de passe:</span><br />
					<input type="password" name="passwd" value="" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
					<span class="font-weight: bold;">Confirmer le mot de passe:</span><br />
					<input type="password" name="passwd2" value="" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
					<span class="font-weight: bold;">E-Mail:</span><br />
					<input type="text" name="mail" value="<?php echo $tab['mail']; ?>" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
					<span class="font-weight: bold;">Adresse:</span><br />
					<input type="text" name="adresse" value="<?php echo $tab['adresse']; ?>" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
					<span class="font-weight: bold;">Code postal et Ville:</span><br />
					<input type="text" name="postal" value="<?php echo $tab['postal']; ?>" style="margin-bottom:5px; margin-left:7px" size="50" placeholder="75017 Paris"/><br />
					<span class="font-weight: bold;">Téléphone fixe:</span><br />
					<input type="text" name="tel" value="<?php echo $tab['tel']; ?>" style="margin-bottom:5px; margin-left:7px" size="50" placeholder="0123456789"/><br />
					<span class="font-weight: bold;">Téléphone portable:</span><br />
					<input type="text" name="ptel" value="<?php echo $tab['ptel']; ?>" style="margin-bottom:5px; margin-left:7px" size="50" placeholder="0612345789"/><br />

					<input type="submit" name="submit" value="Modifier le Compte" style="width:120px" />
				</form>
				<?php
				echo "<span>".$_SESSION["login_modifie_msg"]."</span>";
			}
			?>
		</div>
	</div>
	<?php
}
else
{
	?>
	<div class='cadre' style="height:420px">
		<div style="width:50%; position: absolute; margin-left:50px">
			<span class='title'>Nouveau Client</span><br />
			<form method="post" action="index.php?page=account" style="padding-left:7px">
				<span class="font-weight: bold;">*Nom et Prénom:</span><br />
				<input type="text" name="login" value="<?php echo $_POST['login']; ?>" style="margin-bottom:5px; margin-left:7px" size="50" placeholder="Nom Prenom"/><br />
				<span class="font-weight: bold;">*Mot de passe:</span><br />
				<input type="password" name="passwd" value="" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
				<span class="font-weight: bold;">*Confirmer le mot de passe:</span><br />
				<input type="password" name="passwd2" value="" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
				<span class="font-weight: bold;">*E-Mail:</span><br />
				<input type="text" name="mail" value="<?php echo $_POST['mail']; ?>" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
				<span class="font-weight: bold;">Adresse:</span><br />
				<input type="text" name="adresse" value="<?php echo $_POST['adresse']; ?>" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
				<span class="font-weight: bold;">Code postal et Ville:</span><br />
				<input type="text" name="postal" value="<?php echo $_POST['postal']; ?>" style="margin-bottom:5px; margin-left:7px" size="50" placeholder="75017 Paris"/><br />
				<span class="font-weight: bold;">Téléphone fixe:</span><br />
				<input type="text" name="tel" value="<?php echo $_POST['tel']; ?>" style="margin-bottom:5px; margin-left:7px" size="50" placeholder="0123456789"/><br />
				<span class="font-weight: bold;">Téléphone portable:</span><br />
				<input type="text" name="ptel" value="<?php echo $_POST['ptel']; ?>" style="margin-bottom:5px; margin-left:7px" size="50" placeholder="0612345789"/><br />
				<span class="">* : champs obligatoire</span><br />
				<input type="submit" name="submit" value="Nouveau Compte" style="width:120px" />
			</form>
			<?php echo "<span>".$_SESSION["login_create_msg"]."</span>" ?>
		</div>
		<div class="vr" style="height:400px; position: absolute; height:90%; left:50%"></div>
		<div style="width:50%; position: absolute; right:0px; margin-right:-50px">
			<span class='title'>Déjà Client</span><br />
			<form method="post" action="index.php?page=account" style="padding-left:7px">
				<span class="font-weight: bold;">Nom et Prénom:</span><br />
				<input type="text" name="login" value="<?php echo $_POST['login']; ?>" style="margin-bottom:5px; margin-left:7px" size="50" placeholder="Nom Prenom"/><br />
				<span class="font-weight: bold;">Mot de passe:</span><br />
				<input type="password" name="passwd" value="" style="margin-bottom:5px; margin-left:7px" size="50"/><br />
				<input type="submit" name="submit" value="Connexion" style="width:120px" />
			</form>
			<?php echo "<span>".$_SESSION["login_connect_msg"]."</span>" ?>
		</div>
	</div>
	<?php
}
?>
