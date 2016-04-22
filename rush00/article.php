<?php
session_start();
include_once("function.php");
$obj = db_get("datas/articles");
$obj = $obj[$_GET[article]];
?>
<div class='cadre'>
	<div style="text-align:left;">
	<a href="index.php">Voir toutes les catégories</a> >
		<?php
		$last = 0;
		foreach ($obj[categorie] as $vc)
		{
			if ($last > 0)
				echo ' / <a href="index.php?page=categorie&categorie='.$vc.'">'.$vc.'</a>';
			else
				echo '<a href="index.php?page=categorie&categorie='.$vc.'">'.$vc.'</a>';
			$last = 1;
		}
		?>
	</div>
</div>
<div class='cadre'>
	<div class="presentation">
		<div class="img">
			<img src='<?php echo "$obj[url]"; ?>' alt='<?php echo "$obj[id]"; ?>'>
			<h2><?php echo "$obj[prix]€"; ?></h2>
			<?php echo "<span style='font-size:16px'>".(!$tab[$obj[id]] ? "0" : $tab[$obj[id]])." dans le panier</span><br />";?>
			<form method="post" action="">
				<input type="hidden" name="article" value="<?php echo $obj[id]; ?>">
				<input type="submit" name="submit" value="Ajoutez au panier">
			</form>
			<?php
			$tab = unserialize($_COOKIE['buy']);
			echo $_SESSION["panier_msg"];
			?>
		</div>
		<div class="description">
			<?php
			$cat = "";
			foreach ($obj[categorie] as $vc)
			{
				if ($cat != "")
					$cat .= " / ".$vc;
				else
					$cat = $vc;
			}

			echo "<div class='title' style='text-align:center'>".$obj[id]."</div>";
			echo "<b>Categorie:</b> ".$cat."<br /><br />";
			echo "<b>Description:</b><br />";
			 ?>
			<div><?php
				$obj[description] = preg_replace("/\. /", ".<br />", $obj[description]);
				$obj[description] = preg_replace("/\! /", "!<br />", $obj[description]);
				$obj[description] = preg_replace("/\? /", "?<br />", $obj[description]);
				echo $obj[description];
			?></div>
		</div>
	</div>
</div>
