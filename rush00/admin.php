<?php
session_start();
include_once("function.php");
if (user_auth($_POST[login], $_POST[passwd]))
{
	$usr = db_get("users/$_POST[login]")[$_POST[login]];
	if ($usr[acces] == "admin")
		$_SESSION[is_admin] = $_POST[login];
}
if ($_SESSION[is_admin] == "")
{
	echo "<div class='cadre'>";
?>
	<form method="post" action="index.php?page=admin">
		login:<br/><input type="text" name="login" size="70"><br/>
		Password:<br/><input type="password" name="passwd" size="70"><br/>
		<input type="submit" style="width:430px;margin-top:5px">
	</form>
<?php
	echo "</div>";
}
//	------------------------------------------
//	----PAGE FOR CHANGING AN ARTICLE----------
//	------------------------------------------
else if ($_POST[submit] == "Modify the article")
{
	echo "<div class='cadre'>";
	$tab = db_get("datas/articles")[$_POST[id]];
?>
	<div class="add_article">
		<div class="title">Modify article <?php echo "$_POST[id]"?>:</div>
		<form method="post" action="">
			<input type="hidden" name="oldid" value='<?php echo "$tab[id]";?>'>
			Name:<br/><input type="text" name='id' value='<?php echo "$tab[id]";?>' size="70"><br/>
			Prix:<br/><input type="text" name='prix' value='<?php echo "$tab[prix]";?>' size="70"><br/>
			Description:<br/><input type="text" name='description' value='<?php echo "$tab[description]";?>' size="70"><br/>
			Url:<br/><input type="text" name='url' value='<?php echo "$tab[url]";?>' size="70"><br/>
			<input type="submit" name="submit" value="Send article modification" style="width:430px;margin-top:5px">
		</form>
	</form>
<?php
	echo "</div>";
}
//	------------------------------------------
//	----PAGE FOR CHANGING A CATEGORY----------
//	------------------------------------------
else if ($_POST[submit] == "Modify the category")
{
	echo "<div class='cadre'>";
	$tab = db_get("datas/categories")[$_POST[id]];
?>
	<div class="add_categorie">
		<div class="title">Modify category <?php echo "$_POST[id]"?>:</div>
		<form method="post" action="">
			<input type="hidden" name="oldid" value='<?php echo "$tab[id]";?>'>
			Name:<br/><input type="text" name='id' value='<?php echo "$tab[id]";?>' size="70"><br/>
			Url:<br/><input type="text" name='url' value='<?php echo "$tab[url]";?>' size="70"><br/>
			<input type="submit" name="submit" value="Send category modification" style="width:430px;margin-top:5px">
		</form>
	</form>
<?php
	echo "</div>";
}
//	------------------------------------------
//	----PAGE FOR CHANGING AN USER-------------
//	------------------------------------------
else if ($_POST[submit] == "Modify user")
{
	echo "<div class='cadre'>";
	$tab = db_get("users/$_POST[id]")[$_POST[id]];
?>
	<div class="add_user">
		<div class="title">Modify user <?php echo "$_POST[id]"?>:</div>
		<form method="post" action="">
			<input type="hidden" name="oldid" value='<?php echo "$tab[id]";?>' size="70">
			Name:<br/><input type="text" name='id' value='<?php echo "$tab[id]";?>' size="70"><br/>
			Password:<br/><input type="password" name='mdp' size="70"><br/>
			Access:<br/>
			<select name=acces style="width:430px;margin-top:5px">
				<option value="user">user</option>
				<option value="admin">admin</option>
			</select><br/>
			<input type="submit" name="submit" value="Send user modification" style="width:430px;margin-top:5px">
		</form>
	</form>
<?php
	echo "</div>";
}
//	------------------------------------------
//	-----MAIN PAGE OF ADMIN USERS-------------
//	------------------------------------------
else
{
	if ($_POST[submit] == "Create")
	{
		echo "<div class='cadre'>";
		if ($_POST[id] != "" && $_POST[prix] != "" && $_POST[description] != "" && $_POST[url] != "")
		{
			db_add("datas/articles", array("id" => $_POST[id], "categorie" => array($_POST[categorie]) ,"prix" => $_POST[prix], "description" => $_POST[description], "url" => $_POST[url]));
			echo "Article $_POST[id] has been created.";
		}
		else
			echo "Error, please fill all field";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Send article modification")
	{
		echo "<div class='cadre'>";
		if ($_POST[id] != "" && $_POST[prix] != "" && $_POST[description] != "" && $_POST[url] != "")
		{
			$tab = db_get("datas/articles");
			$tab[$_POST[oldid]][id] = $_POST[id];
			$tab[$_POST[oldid]][prix] = $_POST[prix];
			$tab[$_POST[oldid]][description] = $_POST[description];
			$tab[$_POST[oldid]][url] = $_POST[url];
			$tab[$_POST[id]] = $tab[$_POST[oldid]];
			if ($_POST[id] != $_POST[oldid])
				unset($tab[$_POST[oldid]]);
			file_put_contents("datas/articles", serialize($tab));
			echo "The $_POST[oldid] article has been updated.";
		}
		else
			echo "Error, please fill all field";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Delete")
	{
		echo "<div class='cadre'>";
		db_del("datas/articles", $_POST[id]);
		echo "Article $_POST[id] has been deleted.";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Add to categorie")
	{
		echo "<div class='cadre'>";
		$tab = db_get("datas/articles");
		array_push($tab[$_POST[id]][categorie], $_POST[categorie]);
		file_put_contents("datas/articles", serialize($tab));
		echo "Category $_POST[id][categorie] has been added to Article.";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Remove from categorie")
	{
		echo "<div class='cadre'>";
		$tab = db_get("datas/articles");
		$tab[$_POST[id]][categorie];
		foreach ($tab[$_POST[id]][categorie] as $key => $elem)
		{
			if ($elem == $_POST[categorie])
				unset($tab[$_POST[id]][categorie][$key]);
		}
		file_put_contents("datas/articles", serialize($tab));
		echo "The $_POST[id] category has been deleted.";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Create a categorie")
	{
		echo "<div class='cadre'>";
		if ($_POST[id] != "" && $_POST[url] != "")
		{
			db_add("datas/categories", array("id" => $_POST[id], "url" => $_POST[url]));
			echo "The $_POST[id] category has been created.";
		}
		else
			echo "Error, please fill all field";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Send category modification")
	{
		echo "<div class='cadre'>";
		if ($_POST[id] != "" && $_POST[url] != "")
		{
			$tab = db_get("datas/categories");
			$tab[$_POST[oldid]][id] = $_POST[id];
			$tab[$_POST[oldid]][url] = $_POST[url];
			$tab[$_POST[id]] = $tab[$_POST[oldid]];
			if ($_POST[id] != $_POST[oldid])
				unset($tab[$_POST[oldid]]);
			file_put_contents("datas/categories", serialize($tab));
			$article = db_get("datas/articles");
			foreach ($article as $key => $elem)
			{
				foreach ($elem[categorie] as $key2 => $cat)
				{
					if ($cat == $_POST[oldid])
						$article[$key][categorie][$key2] = $_POST[id];
				}

			}
			file_put_contents("datas/articles", serialize($article));
			echo "The $_POST[oldid] category has been updated.";
		}
		else
			echo "Error, please fill all field";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Delete a categorie")
	{
		echo "<div class='cadre'>";
		db_del("datas/categories", $_POST[id]);
		echo "Category $_POST[id] has been deleted.";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Create user")
	{
		echo "<div class='cadre'>";
		if ($_POST[id] != "" && $_POST[mdp] != "")
		{
			if (!file_exists("users/".$_POST[id]))
			{
				db_add("users/".$_POST[id], array("id" => $_POST[id], "mdp" => hash("whirlpool", $_POST[mdp]), "acces" => "user"));
				echo "The user $_POST[id] has been created.";
			}
			else
				echo "The user $_POST[id] already exist :(";
		}
		else
			echo "Error, please fill all field";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Send user modification")
	{
		echo "<div class='cadre'>";
		if ($_POST[id] != "")
		{
			$tab = db_get("users/$_POST[oldid]");
			$tab[$_POST[oldid]][id] = $_POST[id];
			if ($_POST[mdp] != "")
				$tab[$_POST[oldid]][mdp] = hash("whirlpool", $_POST[mdp]);
			$tab[$_POST[oldid]][acces] = $_POST[acces];
			$tab[$_POST[id]] = $tab[$_POST[oldid]];
			if ($_POST[id] != $_POST[oldid])
			{
				if (!file_exists("users/$_POST[id]"))
				{
					rename("users/$_POST[oldid]", "users/$_POST[id]");
					unset($tab[$_POST[oldid]]);
					file_put_contents("users/$_POST[id]", serialize($tab));
					echo "The user $_POST[oldid] has been updated";
				}
				else
					echo "The user $_POST[id] already exist :(";
			}
			else
			{
				file_put_contents("users/$_POST[id]", serialize($tab));
				echo "The user $_POST[oldid] has been updated";
			}
		}
		else
			echo "Error, please fill all field";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Delete user")
	{
		echo "<div class='cadre'>";
		unlink("users/".$_POST[id]);
		echo "The user $_POST[id] has been deleted.";
		echo "</div><br />";
	}
	if ($_POST[submit] == "Validate")
	{
		echo "<div class='cadre'>";
		$tab = db_get("datas/achats");
		foreach ($tab as $key => $elem)
		{
			if ($elem[id] == $_POST[id])
				$tab[$key][valider] = 1;
		}
		file_put_contents("datas/achats", serialize($tab));
		echo "</div><br />";
	}
?>
<div class='cadre'>
	<div class="add_article">
		<div class="title">Create an article:</div>
		<form method="post" action="">
			Name:<br /><input type="text" name="id" size="70"><br/>
			Prix:<br /><input type="text" name="prix" size="70"><br/>
			Description:<br /><input type="text" name="description" size="70"><br/>
			Url:<br /><input type="text" name="url" size="70"><br/>
			Categorie:<br /><select name="categorie" style="width:430px">
			<?php
				$cat = db_get("datas/categories");
				if (file_exists("datas/articles"))
				foreach ($cat as $elem)
				{
				?>
					<option value='<?php echo "$elem[id]"; ?>'><?php echo "$elem[id]"; ?></option>
				<?php
				}
			?>
			</select><br />
			<input type="submit" name="submit" value="Create" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="mod_article">
		<div class="title">Modify an article:</div>
		<form method="post" action="">
			Article:<br />
			<select name="id" style="width:430px">
			<?php
				$cat = db_get("datas/articles");
				if (file_exists("datas/articles"))
				foreach ($cat as $elem)
				{
				?>
					<option value='<?php echo "$elem[id]"; ?>'><?php echo "$elem[id]"; ?></option>
				<?php
				}
			?>
			</select><br />
			<input type="submit" name="submit" value="Modify the article" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="del_article">
		<div class="title">Delete an article:</div>
		<form method="post" action="">
			<select name="id" style="width:430px">
			<?php
				$obj = db_get("datas/articles");
				if (file_exists("datas/articles"))
				foreach ($obj as $elem)
				{
				?>
					<option value='<?php echo "$elem[id]"; ?>'><?php echo "$elem[id]"; ?></option>
				<?php
				}
			?>
			</select><br />
			<input type="submit" name="submit" value="Delete"  style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="add_to_categorie">
		<div class="title">Add new categorie for an article:</div>
		<form method="post" action="">
			<select name="id" style="width:325px">
			<?php
				$obj = db_get("datas/articles");
				if (file_exists("datas/articles"))
				foreach ($obj as $elem)
				{
				?>
					<option value='<?php echo "$elem[id]"; ?>'><?php echo "$elem[id]"; ?></option>
				<?php
				}
			?>
			</select>
			<select name="categorie"style="width:100px">
			<?php
				$obj = db_get("datas/categories");
				if (file_exists("datas/articles"))
				foreach ($obj as $elem)
				{
				?>
					<option value='<?php echo "$elem[id]"; ?>'><?php echo "$elem[id]"; ?></option>
				<?php
				}
			?>
			</select><br />
			<input type="submit" name="submit" value="Add to categorie" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="remove_from_categorie">
		<div class="title">Remove article from a categorie:</div>
		<form method="post" action="">
			<select name="id" style="width:325px">
			<?php
				$obj = db_get("datas/articles");
				if (file_exists("datas/articles"))
				foreach ($obj as $elem)
				{
				?>
					<option value='<?php echo "$elem[id]"; ?>'><?php echo "$elem[id]"; ?></option>
				<?php
				}
			?>
			</select>
			<select name="categorie" style="width:100px">
			<?php
				$obj = db_get("datas/categories");
				if (file_exists("datas/categories"))
				foreach ($obj as $elem)
				{
				?>
					<option value='<?php echo "$elem[id]"; ?>'><?php echo "$elem[id]"; ?></option>
				<?php
				}
			?>
		</select><br />
			<input type="submit" name="submit" value="Remove from categorie" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="add_categorie">
		<div class="title">Create a categorie:</div>
		<form method="post" action="">
			Name:<br/><input type="text" name="id" size="70"><br/>
			Url:<br/><input type="text" name="url" size="70"><br/>
			<input type="submit" name="submit" value="Create a categorie" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="mod_categorie">
		<div class="title">Modify a categorie:</div>
		<form method="post" action="">
			<select name="id" style="width:430px">
			<?php
				$obj = db_get("datas/categories");
				if (file_exists("datas/categories"))
				foreach ($obj as $elem)
				{
				?>
					<option value='<?php echo "$elem[id]"; ?>'><?php echo "$elem[id]"; ?></option>
				<?php
				}
			?>
			</select><br />
			<input type="submit" name="submit" value="Modify the category" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="del_categorie">
		<div class="title">Delete a categorie:</div>
		<form method="post" action="">
			<select name="id" style="width:430px">
			<?php
				$obj = db_get("datas/categories");
				if (file_exists("datas/categories"))
				foreach ($obj as $elem)
				{
				?>
					<option value='<?php echo "$elem[id]"; ?>'><?php echo "$elem[id]"; ?></option>
				<?php
				}
			?>
			</select><br />
			<input type="submit" name="submit" value="Delete a categorie" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="add_user">
		<div class="title">Create an user:</div>
		<form method="post" action="">
			Name:<br/><input type="text" name="id" size="70"><br/>
			Password:<br/><input type="password" name="mdp" size="70"><br/>
			<input type="submit" name="submit" value="Create user" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="mod_user">
		<div class="title">Modify an user:</div>
		<form method="post" action="">
			<select name="id" style="width:430px">
			<?php
				$obj = scandir("users");
				foreach ($obj as $key => $elem)
				{
					if ($key > 1)
					{
					?>
						<option value='<?php echo "$elem"; ?>'><?php echo "$elem"; ?></option>
					<?php
					}
				}
			?>
		</select><br />
			<input type="submit" name="submit" value="Modify user" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="del_user">
		<div class="title">Delete an user:</div>
		<form method="post" action="">
			<select name="id" style="width:430px">
			<?php
				$obj = scandir("users");
				foreach ($obj as $key => $elem)
				{
					if ($key > 1 && $_SESSION['is_admin'] != $elem){
				?>
					<option value='<?php echo "$elem"; ?>'><?php echo "$elem"; ?></option>
				<?php
					}
				}
			?>
		</select><br />
			<input type="submit" name="submit" value="Delete user" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="waiting_command">
		<div class="title">Waiting commands:</div>
		<form method="post" action="">
			<select name="id" style="width:430px">
			<?php
				$obj = db_get("datas/achats");
				if (file_exists("datas/achats"))
				foreach ($obj as $key => $elem)
				{
					if ($elem[valider] == 0)
					{
				?>
						<option value='<?php echo $elem[id];?>'><?php echo $elem[id];?></input><br/>
				<?php
					}
				}
			?>
		</select><br />
			<input type="submit" name="submit" value="Validate" style="width:430px;margin-top:5px;">
		</form>
	</div>
</div>
<br />
<div class='cadre'>
	<div class="valid_command">
		<div class="title">Valid commands:</div>
			<?php
				$obj = db_get("datas/achats");
				if (file_exists("datas/achats"))
				foreach ($obj as $key => $elem)
				{
					if ($elem[valider] == 1)
					{
						echo date("[d/m/Y H:i:s]", $elem[time]) .  " $elem[name]:";
						foreach ($elem[panier] as $p_key => $p_elem)
						{
							echo "[$p_key x $p_elem]";
						}
						echo "<br/>";
					}
				}
			?>
	</div>
</div>
<?php
}
?>
