<?php
session_start();
include_once("function.php");
$_SESSION["login_connect_msg"] = "";
$_SESSION["login_create_msg"] = "";
$_SESSION["login_modifie_msg"] = "";
$_SESSION["login_delete_msg"] = "";
if ($_GET['page'] == "account")
{
	if ($_GET['account'] == 'delete' && $_SESSION['account'] !== NULL)
	{
		$tab = db_get("users/".$_SESSION['account'])[$_SESSION['account']];
		if ($tab['acces'] == 'user')
		{
			unlink("./users/".$_SESSION['account']);
			user_logout();
		}
		else
			$_SESSION["login_delete_msg"] = "Vous devez vous retirer votre acces d'admin pour supprimer votre compte!";
	}
	elseif ($_POST['submit'] == "Connexion")
	{
		if (!user_auth($_POST['login'], $_POST['passwd']))
		{
			$_SESSION["login_connect_msg"] = "Echec de connexion, mauvais login ou mot de passe.";
		}
	}
	else if ($_POST['submit'] == "Nouveau Compte")
	{
		if ($_POST['login'] != "" && $_POST['passwd'] != "" && $_POST['mail'] != "")
		{
			if (!file_exists('users/'.$_POST['login']))
			{
				if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
				{
					if ($_POST['passwd'] == $_POST['passwd2'])
					{
						$adresse = $_POST['adresse'];
						$postal = $_POST['postal'];
						$tel = "";
						$ptel = "";
						if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['tel']))
							$tel = $_POST['tel'];
						if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['ptel']))
							$ptel = $_POST['ptel'];
						if (!db_add("users/".$_POST['login'], array("id" => $_POST['login'], "mdp" => hash("whirlpool", $_POST['passwd']), "mail" => $_POST['mail'], "acces" => "user", "adresse" => $adresse, "postal" => $postal, "tel" => $tel, "ptel" => $ptel)))
							$_SESSION["login_create_msg"] = "Echec de création de compte, Contacter l'administrateur du site!";
						else
						{
							$_SESSION['account'] = $_POST['login'];
							$_SESSION['acces'] = "user";
							$_SESSION["login_create_msg"] = "Votre compte à bien été créé!";
						}
					}
					else
						$_SESSION["login_create_msg"] = "Echec de création de compte, la confirmation du mot de passe n'est pas valide!";
				}
				else
					$_SESSION["login_create_msg"] = "Echec de création de compte, le mail n'a pas un format valide.";
			}
			else
				$_SESSION["login_create_msg"] = "Echec de création de compte, ce compte existe déjà";
		}
		else
			$_SESSION["login_create_msg"] = "Echec de création de compte, l'un des champs n'a pas été rempli.";
	}
	else if ($_POST['submit'] == "Modifier le Compte" && $_SESSION['account'] !== NULL)
	{
		$tab = db_get("users/".$_SESSION['account'])[$_SESSION['account']];
		$mail = $tab['mail'];
		$adresse = $tab['adresse'];
		$postal = $_POST['postal'];
		$tel = $tab['tel'];
		$ptel = $tab['ptel'];
		if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
			$mail = $_POST['mail'];
		if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['tel']))
			$tel = $_POST['tel'];
		if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['ptel']))
			$ptel = $_POST['ptel'];
		$mdp = $tab['mdp'];
		if ($_POST['oldpwd'] != "" && $_POST['passwd'] != "")
		{
			if ($_POST['passwd'] == $_POST['passwd2'])
			{
				$old = hash("whirlpool", $_POST['oldpwd']);
				if ($old == $tab['mdp'])
					$mdp = hash("whirlpool", $_POST['passwd']);
				else
					$_SESSION["login_modifie_msg"] = "Votre mot de passe n'est pas valide!";
			}
			else
				$_SESSION["login_modifie_msg"] = "La confirmation du mot de passe n'est pas valide!";
		}
		if (!db_add("users/".$_SESSION['account'], array("id" => $_SESSION['account'], "mdp" => $mdp, "mail" => $mail, "acces" => $tab['acces'], "adresse" => $adresse, "postal" => $postal, "tel" => $tel, "ptel" => $ptel)))
			$_SESSION["login_modifie_msg"] = "Echec de création de compte, Contacter l'administrateur du site!";
		elseif ($_SESSION["login_modifie_msg"] == "")
			$_SESSION["login_modifie_msg"] = "Votre compte à bien été modifié!";
	}
}
if ($_GET['page'] == "logout" && $_SESSION['account'] !== NULL)
{
	user_logout();
}

if ($_SESSION['account'] !== NULL)
{
	echo '<span class="title"> Bonjour '.$_SESSION['account'].',</span><br />';
	echo '<a href="index.php?page=account"><div class="link">Voir le compte</div></a>';
	if ($_SESSION['acces'] == 'admin')
		echo '<a href="index.php?page=admin"><div class="link">Administration</div></a>';
	echo '<a href="index.php?page=logout"><div class="link">Se deconnecter</div></a>';
} else {
	?>
		<span class="title">Connexion</span><br />
		<form method="post" action="index.php?page=account" style="padding-left:7px">
			<span class="font-weight: bold;">Nom et Prénom:</span><br />
			<input type="text" name="login" value="" style="margin-bottom:5px; margin-left:7px" size="39" placeholder="Nom Prenom"/><br />
			<span class="font-weight: bold;">Mot de passe:</span><br />
			<input type="password" name="passwd" value="" style="margin-bottom:5px; margin-left:7px" size="39"/><br />
			<input type="submit" name="submit" value="Connexion" style="width:120px"/> - <input type="submit" name="create" value="Nouveau Compte" style="width:120px" />
		</form>
<?php } ?>
