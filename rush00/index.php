<?php
session_start();
date_default_timezone_set("Europe/Paris");
if(!file_exists("users") || !file_exists("datas"))
{
	die("L'installation n'a pas été fait, ou a rencontré un problème, merci de relancer \"install.php\"");
}
ob_start();
$_SESSION["panier_msg"] = "";
?>
<html>
	<head>
		<title>E-Buy - Les Achats Intelligents</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="rush.css">
	</head>
	<body>
		<div class="header">
			<div class="top">
				<a href="index.php?page=panier">
					<span style="position:absolute; right:35px;">
						<?php
							if ($_GET['page'] == "article" && $_POST['submit'] == "Ajoutez au panier" && $_POST['article'] != null)
							{
								if ($_COOKIE['buy'] != NULL)
									$tab = unserialize($_COOKIE['buy']);
								$tab[$_POST['article']] += 1;
								setcookie("buy", serialize($tab), time() + 3600 * 24);
								$_SESSION["panier_msg"] = "Article ajouter au panier!";
							}
							if ($_COOKIE['buy'])
							{
								$tab = unserialize($_COOKIE['buy']);
								$count = 0;
								foreach ($tab as $key => $value) {
									$count += $value;
								}

								if ($count > 1)
									echo "Voir le Panier (".$count." articles)";
								elseif ($count == 1)
									echo "Voir le Panier (1 article)";
								else
									echo "Voir le Panier";
							}
							else
								echo "Voir le Panier";
						?>
					</span>
					<img src="imgs/panier.png" style="height:100%; position:absolute; right:10px;" />
				</a>
				<img src="imgs/france.png" style="height:100%; position:absolute;" />
				<span style="margin-left:25px">Livraison dans toute la France.</span>
			</div>
			<div class="logo">
				<a href="index.php"><img src="imgs/logo.png" style="height:90%; margin-top:6px; margin-left:20px" /></a>
			</div>
			<div class="content">
				<br />
				<form method="get" action="index.php" style="padding-left:7px">
					<span class="title">Recherche</span><br />
					<input type="hidden" name="page" value="search">
					<input type="text" name="search" value="" style="margin-bottom:5px;" size="70"/><br />
					<input type="submit" name="submit" value="Rechercher" style="width:200px;margin-left:5px;"/>
				</form>
			</div>
			<div class="account">
				<?php include_once("account.php"); ?>
			</div>
		</div>
		<div class="middle">
			<?php include_once("page.php"); ?>
		</div>
		<div class="fooder">
			© copyright - E-Buy - mdos-san mgallo - 2016
		</div>
	</body>
</html>
<?php ob_end_flush(); ?>
