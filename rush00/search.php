<?php
session_start();
include_once("function.php");
?>
<div class='cadre' style="text-align:center">
	<h2>Resultat de la Recherche</h2>
	<form method="get" action="index.php" style="padding-left:7px">
		<input type="hidden" name="page" value="search">
		<input type="text" name="search" value="<?php echo $_GET['search']; ?>" style="margin-bottom:5px;" size="120"/>
		<input type="submit" name="submit" value="Rechercher" style="width:200px;margin-left:5px;"/>
	</form>
	<?php
	if ($_GET['search'] != "")
	{
		echo "<hr /><h2 style='text-align:left'>Catégorie trouvé:</h2>";
		$tab = db_get("datas/categories");
		asort($tab);
		if ($tab)
			foreach ($tab as $elem)
			{
				if (preg_match_all("/".strtolower($_GET['search'])."/", strtolower($elem['id'])))
				{
					?>
					<a href="index.php?page=categorie&categorie=<?php echo $elem[id]; ?>" title="<?php echo $elem[id]; ?>"><div class='categorie'><div class='title'><?php echo $elem[id]; ?></div><img src='<?php echo $elem[url];?>'  alt='<?php echo $elem[id];?>'></div></a>
					<?php
				}
			}
		echo "<hr /><h2 style='text-align:left'>Article trouvé:</h2>";
		$obj = db_get("datas/articles");
		asort($obj);
		if ($obj)
			foreach ($obj as $key => $elem)
			{
				if (preg_match_all("/".strtolower($_GET['search'])."/", strtolower($elem['id'])))
				{
					?>
					<a href="index.php?page=article&article=<?php echo $elem[id]; ?>" title="<?php echo $elem[id]; ?>"><div class='categorie'><div class='title'><?php
						if (strlen($elem['id']) > 25)
							echo substr($elem['id'], 0, 22)."...";
						else
							echo $elem['id'];
					?></div><img src='<?php echo $elem[url];?>'  alt='<?php echo $elem[id];?>'><br /><?php echo "<b>$elem[prix]€</b>"; ?></div></a>
					<?php
				}
				else
				{
					foreach ($elem[categorie] as $vc)
					{
						if (preg_match_all("/".strtolower($_GET['search'])."/", strtolower($vc)))
						{
							?>
							<a href="index.php?page=article&article=<?php echo $elem[id]; ?>" title="<?php echo $elem[id]; ?>"><div class='categorie'><div class='title'><?php
								if (strlen($elem['id']) > 25)
									echo substr($elem['id'], 0, 22)."...";
								else
									echo $elem['id'];
							?></div><img src='<?php echo $elem[url];?>'  alt='<?php echo $elem[id];?>'><br /><?php echo "<b>$elem[prix]€</b>"; ?></div></a>
							<?php
						}
					}
				}
			}
	} else
		echo "<h3>Aucun resultat a été trouvé...</h3>";
	?>
</div>
