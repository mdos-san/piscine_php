<?php
session_start();
include_once("function.php");
?>
<div class='cadre'>
	<?php
	if ($_GET['panier'] == "valider" && $_COOKIE['buy'])
	{
		if ($_SESSION['account'] !== NULL)
		{
			$tab = unserialize($_COOKIE['buy']);
			db_add("datas/achats", array("id" => time().$_SESSION['account'], "name" => $_SESSION['account'], "time" => time(), "valider" => 0, "panier" => $tab));
			echo "Achat terminé.";
			$tab = array();
			setcookie("buy", NULL, 0);
		}
		else
			echo "Connectez-vous ou créer un compte pour terminer l'achat.";

	}
	elseif ($_COOKIE['buy'])
	{
		$tab = unserialize($_COOKIE['buy']);
		if ($_GET['panier'] == "vider")
		{
			$tab = array();
		}
		if ($_POST['supprimer'] == "Suppremier l'article du panier")
		{
			$tab[$_POST['panierID']] = 0;
		}
		if ($_POST['reduire'] == "Reduire la quantiter de 1")
		{
			$tab[$_POST['panierID']] -= 1;
		}
		if ($_POST['ajouter'] == "Augmenter la quantiter de 1")
		{
			$tab[$_POST['panierID']] += 1;
		}
		setcookie("buy", serialize($tab), time() + 3600 * 24);
		$articles = db_get("datas/articles");
		$prices = 0;
		if ($tab && $articles)
			foreach ($tab as $k => $v) {
				foreach ($articles as $obj) {
					if ($k == $obj['id'] && $v > 0)
					{
						?>
						<div class="panier">
							<div class="info">
								<div style="margin:10px">
									<?php
									echo "<div class='title'>$obj[id]</div>";
									$cat = "";
									foreach ($obj[categorie] as $vc)
										$cat .= $vc." ";
									echo "<br />";
									echo "Categorie: ".$cat."<br />";
									echo "Quantiter: ".$v."<br />";
									echo "Prix/u: $obj[prix]€<br />";
									echo "Prix total: ".($obj[prix] * $v)."€<br />";
									$prices += ($obj[prix] * $v);
									?>
									<br />
									<form method="post" action="index.php?page=panier">
										<input type="hidden" name="panierID" value="<?php echo $k; ?>">
										<input type="submit" name="supprimer" value="Supprimer l'article du panier" />
										<input type="submit" name="reduire" value="Reduire la quantiter de 1" />
										<input type="submit" name="ajouter" value="Augmenter la quantiter de 1" />
									</form>
								</div>
							</div>
							<div class="img">
								<img src='<?php echo "$obj[url]"; ?>' alt='<?php echo "$obj[id]"; ?>' style="width:90%;">
							</div>
						</div>
						<hr style="width:100%"/>
						<?php
						break;
					}
				}
			}
		if ($prices < 1)
			echo "Pas d'article(s) dans le panier.<br />";
		else
		{
			?>
			<center>
				Prix Total: <?php echo $prices; ?>€<br />
				<a href="index.php?page=panier&panier=valider">Valider le panier</a> - <a href="index.php?page=panier&panier=vider">Vider le panier</a>
			</center>
			<?php
		}
	}
	else
		echo "Pas d'article(s) dans le panier.<br />";
	?>
</div>
