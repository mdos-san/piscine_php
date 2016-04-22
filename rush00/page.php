<?php
include_once("function.php");
if (!$_GET['page'])
{?>
	<div class="promo" style="text-align: center;">
		<h2>Article Aléatoire</h2><hr />
		<?php
		$tab = db_get("datas/articles");
		if ($tab)
		{
			shuffle($tab);
			$i = 0;
			foreach ($tab as $elem)
			{
				?>
				<a href="index.php?page=article&article=<?php echo $elem[id]; ?>" title="<?php echo $elem[id]; ?>"><div class='categorie'><div class='title'><?php
					if (strlen($elem['id']) > 25)
						echo substr($elem['id'], 0, 22)."...";
					else
						echo $elem['id'];
				?></div><img src='<?php echo $elem[url];?>'  alt='<?php echo $elem[id];?>'><br /><?php echo "<b>$elem[prix]€</b>"; ?></div></a>
				<?php
				$i++;
				if ($i > 3)
					break;
			}
		}?>
	</div>

<?php } ?>

<div class ="content">
	<?php
	if ($_GET['page'] == "account")
		include_once("memberspace.php");
	elseif ($_GET['page'] == "search")
		include_once("search.php");
	elseif ($_GET['page'] == "panier")
		include_once("panier.php");
	elseif ($_GET['page'] == "categorie" && $_GET['categorie'] != "")
		include_once("categories.php");
	elseif ($_GET['page'] == "article" && $_GET['article'] != "")
		include_once("article.php");
	elseif ($_GET['page'] == "admin" && $_SESSION['account'] !== NULL)
		include_once("admin.php");
	else
	{
		?>
		<div class='cadre' style="text-align: center;">
			<h2>Categorie</h2>
			<hr />
			<?php
				$tab = db_get("datas/categories");
				if ($tab)
				{
					asort($tab);
					foreach ($tab as $elem)
					{?>
					<a href="index.php?page=categorie&categorie=<?php echo $elem[id]; ?>" title="<?php echo $elem[id]; ?>"><div class='categorie'><h3><?php echo $elem[id]; ?></h3><img src='<?php echo $elem[url];?>'  alt='<?php echo $elem[id];?>'></div></a>
					<?php
					}
				}?>
		</div>
		<?php
	}
	?>
</div>
