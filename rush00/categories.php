<div class='cadre'>
	<a href="index.php">Voir toutes les catégories</a>
</div>
<div class='cadre' style="text-align: center;">
<?php
session_start();
include_once("function.php");
$articles = db_get("datas/articles");
echo '<h2>'.$_GET['categorie'].'</h2><hr />';
if ($articles != "")
{
	asort($articles);
	foreach ($articles as $elem)
	{
		foreach ($elem['categorie'] as $name)
		{
			if ($name == $_GET['categorie'])
			{
			?>
				<a href="index.php?page=article&article=<?php echo $elem[id]; ?>" title="<?php echo $elem[id]; ?>"><div class='article'><div class="title"><?php
				if (strlen($elem[id]) > 25)
					echo substr($elem[id], 0, 22)."...";
				else
					echo $elem[id];
				?></div><img src='<?php echo $elem[url];?>'  alt='<?php echo $elem[id];?>'><div class="title"><?php echo "$elem[prix]€"; ?></div></div></a>
			<?php
			}
		}
	}
}
?>
</div>
